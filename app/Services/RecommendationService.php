<?php

namespace App\Services;

use App\Models\User;
use App\Models\Movie;
use App\Models\Tour;
use App\Models\Event;
use App\Models\Screening;
use Illuminate\Support\Collection;

class RecommendationService
{
    /**
     * Recommend items (movies, tours, events) using content-based filtering, excluding already booked items.
     *
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    
    public function recommendForUser(User $user)
    {
        // Step 1: Get the user's past bookings with their bookable items, eager loading to prevent N+1 issues
        $bookings = $user->bookings()->with('bookable')->get();

        // Debug: Log or dump bookings to verify data
        \Log::info('User Bookings for User ID ' . $user->id . ':', $bookings->toArray());

        // Step 2: Extract features (categories/genres) from past bookings
        $userPreferences = [];
        $bookedMovieIds = []; // Track movie IDs from screenings to exclude movies
        foreach ($bookings as $booking) {
            $item = $booking->bookable;
            if ($item) {
                // Handle different types of bookable items
                if ($item instanceof Screening) {
                    $movie = $item->movie;
                    if ($movie) {
                        $features = $this->extractFeatures($movie); // Extract from Movie
                        $bookedMovieIds[] = $movie->id; // Track movie ID for exclusion
                    } else {
                        continue; // Skip if no movie is associated
                    }
                } elseif (in_array(get_class($item), [\App\Models\Movie::class, \App\Models\Tour::class, \App\Models\Event::class])) {
                    $features = $this->extractFeatures($item);
                    if ($item instanceof Movie) {
                        $bookedMovieIds[] = $item->id; // Track movie ID for exclusion
                    }
                } else {
                    continue; // Skip unsupported types
                }

                foreach ($features as $feature) {
                    $feature = (string) $feature; // Ensure it's a string
                    $userPreferences[$feature] = ($userPreferences[$feature] ?? 0) + 1;
                }
            }
        }

        if (empty($userPreferences)) {
            return collect(); // No preferences found, return empty
        }

        // Debug: Log user preferences to verify
        \Log::info('User Preferences:', $userPreferences);
        \Log::info('Booked Movie IDs:', array_unique($bookedMovieIds));

        // Step 3: Normalize user preference vector
        $userPreferenceVector = $this->normalizeVector($userPreferences);

        // Step 4: Get all available items and filter out already booked items
        $allItems = collect()->merge(Movie::all())->merge(Tour::all())->merge(Event::all());
        $bookedItemIds = $bookings->pluck('bookable_id')->unique()->toArray();
        $bookedItemTypes = $bookings->pluck('bookable_type')->unique()->map(function ($type) {
            return class_exists($type) ? $type : '\\' . ltrim($type, '\\');
        })->unique()->toArray();

        // Track booked movie IDs from screenings
        $bookedMovieIds = array_unique($bookedMovieIds);

        // Debug: Log booked item IDs and types to verify
        \Log::info('Booked Item IDs:', $bookedItemIds);
        \Log::info('Booked Item Types:', $bookedItemTypes);

        $recommendations = [];

        foreach ($allItems as $item) {
            $itemClass = get_class($item);
            $itemId = $item->id;

            // Skip items the user has already booked (check both screenings and movies)
            $isBooked = $bookings->where('bookable_id', $itemId)->whereIn('bookable_type', [$itemClass, 'App\Models\\' . class_basename($itemClass)])->isNotEmpty();
            
            // For Movies, also check if the movie ID is in bookedMovieIds
            if ($item instanceof Movie && in_array($itemId, $bookedMovieIds)) {
                $isBooked = true;
            }

            if ($isBooked) {
                continue;
            }

            // Verify item type is valid
            if (!in_array($itemClass, [\App\Models\Movie::class, \App\Models\Tour::class, \App\Models\Event::class])) {
                continue;
            }

            $itemFeatures = $this->extractFeatures($item);
            $itemFeatureVector = $this->normalizeVector(array_count_values(array_map('strval', $itemFeatures)));
            $similarity = $this->cosineSimilarity($userPreferenceVector, $itemFeatureVector);

            if ($similarity > 0) {
                $recommendations[] = [
                    'item' => $item,
                    'image_url' => $this->getImageUrl($item),
                    'score' => $similarity
                ];
            }
        }

        // Step 5: Sort recommendations by similarity score and return top 10
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);

        // Debug: Log recommendations to verify
        \Log::info('Recommendations:', $recommendations);

        // Return only the items (as objects) without the scores
        return collect(array_slice($recommendations, 0, 10))->map(fn($rec) => [
            'item' => $rec['item'],
            'image_url' => $rec['image_url']
        ]);
    }

    /**
     * Extract features from an item (category, genre, etc.).
     *
     * @param $item
     * @return array
     */
    public function extractFeatures($item)
    {
        $features = [];

        // Extract features for Movies
        if ($item instanceof \App\Models\Movie) {
            $genres = explode(',', str_replace(' ', '', $item->genre ?? '')); // Handle comma-separated genres
            $features = array_merge($features, array_filter(array_map('trim', $genres)));
        }

        // Extract features for Screenings (via associated Movie)
        if ($item instanceof \App\Models\Screening) {
            $movie = $item->movie;
            if ($movie) {
                $genres = explode(',', str_replace(' ', '', $movie->genre ?? ''));
                $features = array_merge($features, array_filter(array_map('trim', $genres)));
            }
        }

        // Extract features for Tours
        if ($item instanceof \App\Models\Tour) {
            $features[] = (string) ($item->category ?? '');
        }

        // Extract features for Events
        if ($item instanceof \App\Models\Event) {
            $features[] = (string) ($item->category ?? '');
        }

        return array_filter($features);
    }

    /**
     * Normalize vector for cosine similarity calculation.
     *
     * @param array $vector
     * @return array
     */
    public function normalizeVector(array $vector)
    {
        $magnitude = sqrt(array_sum(array_map(fn($val) => $val ** 2, $vector)));
        return $magnitude > 0 ? array_map(fn($val) => $val / $magnitude, $vector) : [];
    }

    /**
     * Compute cosine similarity between two vectors.
     *
     * @param array $vectorA
     * @param array $vectorB
     * @return float
     */
    private function cosineSimilarity(array $vectorA, array $vectorB)
    {
        $dotProduct = array_sum(array_map(fn($key) => ($vectorA[$key] ?? 0) * ($vectorB[$key] ?? 0), array_keys($vectorA)));
        $magnitudeA = sqrt(array_sum(array_map(fn($val) => $val ** 2, $vectorA)));
        $magnitudeB = sqrt(array_sum(array_map(fn($val) => $val ** 2, $vectorB)));
        return ($magnitudeA * $magnitudeB) ? $dotProduct / ($magnitudeA * $magnitudeB) : 0;
    }
    private function getImageUrl($item)
{
    if ($item instanceof \App\Models\Movie) {
        return $item->poster_url ? asset('storage/' . $item->poster_url) : null;
    } elseif ($item instanceof \App\Models\Tour || $item instanceof \App\Models\Event) {
        return $item->image ? asset('storage/' . $item->image) : null;
    }
    return null;
}
}