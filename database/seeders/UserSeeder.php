<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['roleName' => 'admin']);

        // Create a user with the role 'admin'
        $user = User::create([
            'FirstName' => 'Suraj',
            'LastName' => 'Admin',
            'email' => 'admin@example.com',
            'mobileNumber' => '9851516263',
            'password' => Hash::make('123456789'),
        ]);

        // Assign the 'admin' role to the user in the pivot table
        $user->roles()->attach($adminRole->id);
    }
}
