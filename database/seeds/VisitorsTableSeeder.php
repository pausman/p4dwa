<?php

use App\User;
use App\Visitor;
use Faker\Factory as Faker;
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
        $users = USER::all();
        foreach ($users as $user) {
            $visitor = new Visitor();
            $visitor->group_name = $faker->lastName.' Family Group';
            $visitor->group_size = $faker->numberBetween($min = 1, $max = 10);
            $visitor->user_id = $user->id;
            $visitor->save();

        }
    }
}
