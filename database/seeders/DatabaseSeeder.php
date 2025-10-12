<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Impor class Faker
use Illuminate\Support\Facades\Hash; // Impor Hash untuk password

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Buat instance Faker dengan locale Indonesia

        $users = [];
        for ($i = 0; $i < 50; $i++) { // Ulangi untuk membuat 50 pengguna
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->email, // Gunakan unique() untuk memastikan email unik
                'password' => Hash::make('password'), // Gunakan Hash::make() untuk hashing password
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users); // Masukkan semua data sekaligus

        // Tugas
        $this->call([
            MemberSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
        ]);
    }
}