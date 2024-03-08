<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gallery;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = [
            [
                'name' => 'admin',
                'username' => 'admin',
                'slug' => 'admin',
                'email' => 'admin@gmail.com',
                'level' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'user1',
                'username' => 'user1',
                'slug' => 'user1',
                'email' => 'user1@gmail.com',
                'level' => 'user',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'user2',
                'username' => 'user2',
                'slug' => 'user2',
                'email' => 'user2@gmail.com',
                'level' => 'user',
                'password' => Hash::make('password'),
            ],
        ];
        User::insert($users);
        $faker = Factory::create();
        for ($i = 1; $i <= 60; $i++) {
            $gallery = [
                'name' => Str::random(8),
                'status' => 1,
                'description' => $faker->sentence(10),
                'path' => 'gallery/img' . $i . '.jpg',
            ];
            if ($i <= 15) {
                $gallery['user_id'] = 1;
                $gallery['created_at'] = Carbon::now();
            } elseif ($i <= 40) {
                $gallery['user_id'] = 2;
                $gallery['created_at'] = Carbon::now()->subMonth();
            } elseif ($i <= 60) {
                $gallery['user_id'] = 3;
                $gallery['created_at'] = Carbon::now()->subMonths(2);
            }
            Gallery::create($gallery);
        }
        $profiles = [
            ['user_id' => 1],
            ['user_id' => 2],
            ['user_id' => 3],
        ];
        Profile::insert($profiles);
    }
}
