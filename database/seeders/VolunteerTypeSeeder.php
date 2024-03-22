<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VolunteerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('volunteer_types')->insert([
            [
                'name' => 'ksr',
                'code' => 'KSR',
            ],
            [
                'name' => 'tsr',
                'code' => 'TSR',
            ]
        ]);
    }
}
