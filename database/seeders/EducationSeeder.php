<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
            [
                'name' => 'sd',
                'code' => 'SD',
            ],
            [
                'name' => 's1',
                'code' => 'S1',
            ]
        ]);
    }
}
