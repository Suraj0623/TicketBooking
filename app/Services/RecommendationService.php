<?php
namespace App\Services;

use App\Models\User;
use App\Models\Movie;
use App\Models\Tour;
use App\Models\Event;
use Illuminate\Support\Collection;

class RecommendationService
{
    /**
     * Recommend items (movies, tours, events) using content-based filtering.
     *
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function recommendForUser(User $user)
{
    // Step 1: Get the user's past bookings
    $bookings = $user->bookings;

    // Step 2: Extract features (categories/genres) from past bookings
    $userPreferences = [];
    foreach ($bookings as $booking) {
        $item = $booking->bookable;
        if ($item) {
            $features = $this->extractFeatures($item);
            foreach ($features as $feature) {
                $feature = (string) $feature; // Ensure it's a string
                $userPreferences[$feature] = ($userPreferences[$feature] ?? 0) + 1;
            }
        }
    }

    if (empty($userPreferences)) {
        return collect(); // No preferences found, return empty
    }

    // Step 3: Normalize user preference vector
    $userPreferenceVector = $this->normalizeVector($userPreferences);

    // Step 4: Get all available items and compute similarity scores
    $items = collect()->merge(Movie::all())->merge(Tour::all())->merge(Event::all());
    $recommendations = [];

    foreach ($items as $item) {
        if ($bookings->where('bookable_id', $item->id)->where('bookable_type', get_class($item))->isNotEmpty()) {
            continue;
        }

        $itemFeatures = $this->extractFeatures($item);
        $itemFeatureVector = $this->normalizeVector(array_count_values(array_map('strval', $itemFeatures)));
        $similarity = $this->cosineSimilarity($userPreferenceVector, $itemFeatureVector);

        if ($similarity > 0) {
            // Ensure $item is passed as an object
            $recommendations[] = ['item' => $item, 'score' => $similarity];
        }
    }

    // Step 5: Sort recommendations by similarity score and return top 10
    usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);

    // Return only the items (as objects) without the scores
    return collect(array_slice($recommendations, 0, 10))->map(fn($rec) => $rec['item']);
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
        $features[] = (string) ($item->genre ?? '');
    }

    // Extract features for Screenings
    if ($item instanceof \App\Models\Screening) {
        $movie = $item->movie; // Assuming there's a relationship `movie()` in the Screening model
        if ($movie) {
            $features[] = (string) ($movie->genre ?? '');
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
}
