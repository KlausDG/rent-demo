<?php

// use Faker\Generator as Faker;
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
        // $faker = \Faker\Factory::create();
        $pricesArray = array(10, 15, 20);
        $json = File::get(base_path() . '/dump.json');
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
                'isAvailable' => rand(0, 1),
                'price' => $pricesArray[rand(0, 2)],
                'imageThumb' => $obj->thumbnail,
                'difficulties_id' => rand(1, 5),
                'genres_id' => rand(1, 5),
                'languages_id' => rand(1, 2),
                'filial_id' => rand(1, 4)
            ));
        }

    }
}
