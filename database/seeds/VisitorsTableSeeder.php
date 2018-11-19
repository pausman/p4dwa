<?php

use App\Visitor;
use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Use Faker to create the data
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 25) as $i) {
            $visitor = new Visitor();
            $visitor->group_leader_name = $faker->name;
            $visitor->email = $faker->email;
            $visitor->group_size = $faker->numberBetween($min = 1, $max = 10);
            $visitor->need_a_boat_ride = $faker->boolean($chanceOfGettingTrue = 90);
            $visitor->save();
        }
    }
}
