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
            'filial_id' => 1,
        ]);
        User::create([
            'name' => 'Arthur Casagrande',
            'username' => 'arthur',
            'email' => 'arthur@arthur.com',
            'password' => Hash::make('lends'),
            'role' => 1,
            'filial_id' => 1,
        ]);

        $this->call([
            DifficultySeeder::class,
            GenreSeeder::class,
            LanguageSeeder::class,
            FilialSeeder::class,
            GameSeeder::class,
        ]);

    }
}
