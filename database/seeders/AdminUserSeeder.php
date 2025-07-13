<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Make sure to import your User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
 // For hashing passwords
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        $users = [
            [
                'name' => 'Samad',
                'email' => 'samad@gmail.com',
                'password' => 'admin',
                'role' => 'admin',
            ],
            [
                'name' => 'Hilal',
                'email' => 'hilal@gmail.com',
                'password' => 'secret123',
                'role' => 'admin',
            ],
            [
                'name' => 'Monssif',
                'email' => 'monssif@gmail.com',
                'password' => 'mypassword',
                'role' => 'editor',
            ],

            [
                'name' => 'Oussama',
                'email' => 'oussama@gmail.com',
                'password' => 'secret123',
                'role' => 'admin',
            ],
            [
                'name' => 'Yahya',
                'email' => 'yahya@gmail.com',
                'password' => 'secret123',
                'role' => 'admin',
            ],

            // Add more users as needed
        ];
    
        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role']
                ]
            );
        }
    }
    
}
