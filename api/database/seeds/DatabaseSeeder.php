<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Klaus Dieter Galm',
            'username' => 'klausdg',
            'email' => 'klausdgalm@hotmail.com',
            'password' => Hash::make('admin'),
            'role' => 2,
        ]);
        User::create([
            'name' => 'User',
            'username' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role' => 1,
        ]);

        $this->call([
            difficulties_seeder::class,
            genres_seeder::class,
            languages_seeder::class,
            filial_seeder::class,
            games_seeder::class,
        ]);

    }
}
