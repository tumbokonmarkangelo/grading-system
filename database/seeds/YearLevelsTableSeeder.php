<?php

use Illuminate\Database\Seeder;

class YearLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('year_levels')->insert([
            'name' => 'First Year',
            'code' => '1',
        ]);
        DB::table('year_levels')->insert([
            'name' => 'Second Year',
            'code' => '2',
        ]);
        DB::table('year_levels')->insert([
            'name' => 'Third Year',
            'code' => '3',
        ]);
        DB::table('year_levels')->insert([
            'name' => 'Fourth Year',
            'code' => '4',
        ]);
    }
}
