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
     * Recommend items (movies, tours, events) for a specific user.
     *
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function recommendForUser(User $user)
    {
        // Step 1: Get the user's past bookings
        $bookings = $user->bookings;

        // Step 2: Extract categories from past bookings
        $categories = [];
        foreach ($bookings as $booking) {
            $item = $booking->bookable; // Get the associated Movie, Tour, or Event
            if ($item && isset($item->category)) {
                $categories[] = $item->category;
            } elseif ($item && isset($item->genre)) {
                $categories[] = $item->genre;
            }
        }

        // Step 3: Count category occurrences to find preferences
        $categoryCounts = array_count_values($categories);
        arsort($categoryCounts); // Sort by frequency
        $preferredCategory = array_key_first($categoryCounts);

        // Step 4: Collect already-booked item IDs to exclude them
        $bookedItemIds = $bookings->pluck('bookable_id')->toArray();

        // Step 5: Recommend items based on the preferred category
        $recommendations = collect();
        if ($preferredCategory) {
            // Recommend movies (exclude already-booked movies)
            $recommendations = $recommendations->merge(
                Movie::where('genre', $preferredCategory)
                    ->whereNotIn('id', $bookedItemIds)
                    ->get()
            );

            // Recommend tours (exclude already-booked tours)
            $recommendations = $recommendations->merge(
                Tour::where('category', $preferredCategory)
                    ->whereNotIn('id', $bookedItemIds)
                    ->get()
            );

            // Recommend events (exclude already-booked events)
            $recommendations = $recommendations->merge(
                Event::where('category', $preferredCategory)
                    ->whereNotIn('id', $bookedItemIds)
                    ->get()
            );
        }

        return $recommendations;
    }
    public function recommendViaRatings(){
        
    }
}