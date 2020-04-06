<?php

use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('difficulties')->insert(array(
            array(
                'title' => 'Fácil',
            ),
            array(
                'title' => 'Normal',
            ),
            array(
                'title' => 'Intermediário',
            ),
            array(
                'title' => 'Difícil',
            ),
            array(
                'title' => 'Muito Difícil',
            ),
        ));

    }
}
