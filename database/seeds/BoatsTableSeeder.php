<?php

use App\Boat;
use Illuminate\Database\Seeder;

class BoatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Simple array of data
     * @return void
     */
    public function run()
    {
        $result = Boat::all()->count();
        if ($result == 0) {
            $boats = [
                ['Ark', '17'],
                ['Whaler', 5],
                ['Canoe', 1],

            ];

            foreach ($boats as $key => $boatData) {
                $boat = new Boat();
                $boat->name = $boatData[0];
                $boat->capacity = $boatData[1];
                $boat->save();
            }
        } else {
            echo('Duplicating this data could be dangerous so it was not done' . PHP_EOL);
            echo('Use php artisan migrate:fresh --seed to clear the data first'. PHP_EOL);
        }
    }
}
