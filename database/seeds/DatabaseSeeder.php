<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BoatsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(VisitorsTableSeeder::class);
        $this->call(ManifestsTableSeeder::class);
    }
}
