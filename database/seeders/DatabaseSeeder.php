<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Adminer',
            'email' => 'adminer@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'Admin'

        ]);

        $categories = [
            'Vegetariánske',
            'Mäsové',
            'Nízkosacharidové',
            'Bezlepkové',
            'Bezlaktózové',
            'Vegánske'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
