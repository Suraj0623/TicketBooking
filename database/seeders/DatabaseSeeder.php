<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;
use App\Models\Tour;
use App\Models\Event;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and users (already handled by existing seeders)
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        // Fetch or create a test user for recommendations
        $user = User::where('email', 'test@example.com')->first();

        if (!$user) {
            // Create a test user if not already seeded
            $user = User::create([
                'FirstName' => 'John',
                'LastName' => 'Doe',
                'email' => 'test@example.com',
                'mobileNumber' => '1234567890',
                'password' => bcrypt('password'),
                'preferences' => json_encode(['genres' => ['action', 'adventure'], 'locations' => ['New York']]),
            ]);
        }

        // Create movies with genres
        $movie1 = Movie::create([
            'title' => 'Action Movie',
            'description' => 'An exciting action movie.',
            'genre' => 'action',
            'release_date' => now(),
            'poster_url' => 'https://example.com/action-movie.jpg',
        ]);

        $movie2 = Movie::create([
            'title' => 'Comedy Movie',
            'description' => 'A hilarious comedy movie.',
            'genre' => 'comedy',
            'release_date' => now(),
            'poster_url' => 'https://example.com/comedy-movie.jpg',
        ]);

        // Create tours with categories
        // $tour1 = Tour::create([
        //     'name' => 'Adventure Tour',
        //     'description' => 'Explore the wild.',
        //     'image' => 'https://example.com/adventure-tour.jpg',
        //     'packageName' => 'Basic Adventure',
        //     'ticket_price' => 500,
        //     'duration' => '5 days',
        //     'highlights' => 'Nature, Wildlife',
        //     'avg_rating' => 4.5,
        //     'total_rating' => 100,
        //     'category' => 'adventure',
        // ]);

        // $tour2 = Tour::create([
        //     'name' => 'Cultural Tour',
        //     'description' => 'Experience local culture.',
        //     'image' => 'https://example.com/cultural-tour.jpg',
        //     'packageName' => 'Cultural Experience',
        //     'ticket_price' => 300,
        //     'duration' => '3 days',
        //     'highlights' => 'History, Traditions',
        //     'avg_rating' => 4.7,
        //     'total_rating' => 80,
        //     'category' => 'cultural',
        // ]);

        // Create events with categories
        $event1 = Event::create([
            'title' => 'Concert Event',
            'description' => 'Live music concert.',
            'total_seats' => 1000,
            'event_date' => now(),
            'venue' => 'Central Park',
            'ticket_price' => 200,
            'category' => 'concert',
        ]);

        $event2 = Event::create([
            'title' => 'Sports Event',
            'description' => 'Exciting sports match.',
            'total_seats' => 500,
            'event_date' => now(),
            'venue' => 'Stadium',
            'ticket_price' => 150,
            'category' => 'sports',
        ]);

        // // Create bookings for the user
        Booking::create([
            'user_id' => $user->id,
            'bookable_type' => 'App\Models\Movie',
            'bookable_id' => $movie1->id,
            'seats_booked' => 2,
            'total_price' => 200,
            'payment_status' => 'paid',
        ]);

        // Booking::create([
        //     'user_id' => $user->id,
        //     'bookable_type' => 'App\Models\Tour',
        //     'bookable_id' => $tour1->id,
        //     'seats_booked' => 1,
        //     'total_price' => 500,
        //     'payment_status' => 'paid',
        // ]);
    }
}