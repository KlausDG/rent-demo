<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $pricesArray = array(10, 15, 20);
        $json = File::get(base_path() . '\dump.json');
        $data = json_decode($json);
        $array1 = $data;
        foreach ($array1 as $obj) {
            DB::table('games')->insert(array(
                'title' => $obj->name,
                'minPlayers' => $obj->minPlayers,
                'maxPlayers' => $obj->maxPlayers,
                'minTime' => $obj->playingTime / 2,
                'maxTime' => $obj->playingTime,
                'isExpansion' => $obj->isExpansion,
                'isAvailable' => $faker->boolean,
                'price' => $faker->randomElement($pricesArray),
                'imageThumb' => $obj->thumbnail,
                'difficulties_id' => $faker->numberBetween($min = 1, $max = 5),
                'genres_id' => $faker->numberBetween($min = 1, $max = 5),
                'languages_id' => $faker->numberBetween($min = 1, $max = 2),
                'filial_id' => $faker->numberBetween($min = 1, $max = 4),
            ));
        }

    }
}
