<?php

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(array(
            array(
                'title' => 'Festivo',
            ),
            array(
                'title' => 'Infantil',
            ),
            array(
                'title' => 'Família',
            ),
            array(
                'title' => 'Estratégico',
            ),
            array(
                'title' => 'Temático',
            ),
        ));

    }
}
