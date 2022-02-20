<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarBrandsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::unprepared(
            file_get_contents(storage_path('app').'/carbrands.sql')
        );
    }
}
