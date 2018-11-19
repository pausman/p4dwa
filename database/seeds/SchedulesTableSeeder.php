<?php

use App\Schedule;
use Flynsarmy\CsvSeeder\CsvSeeder;

class SchedulesTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     * Read from a csv file to get the data using CsvSeeder package
     * @return void
     */
    public function __construct()
    {
        $result = Schedule::all()->count();
        if ($result == 0) {
            $this->table = 'schedules';
            $this->csv_delimiter = ',';
            $this->filename = base_path() . '/database/seeds/csvs/boatscheduledata.csv';
        } else {
            echo('Duplicating this data could be dangerous so it was not done' . PHP_EOL);
            echo('Use php artisan migrate:fresh --seed to clear the data first'. PHP_EOL);
        }
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        // DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        //DB::table($this->table)->truncate();

        parent::run();
    }
}
