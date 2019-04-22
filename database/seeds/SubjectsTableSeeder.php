<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'code' => 'ENG123',
            'name' => 'English 1',
            'description' => 'English 1',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'MATH123',
            'name' => 'MATH 1',
            'description' => 'MATH 1',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'IT123',
            'name' => 'Introduction to information technology',
            'description' => 'Introduction to information technology',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE1',
            'name' => 'Physical Education 1',
            'description' => 'Physical Education 1',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE2',
            'name' => 'Physical Education 2',
            'description' => 'Physical Education 2',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE3',
            'name' => 'Physical Education 3',
            'description' => 'Physical Education 3',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE4',
            'name' => 'Physical Education 4',
            'description' => 'Physical Education 4',
            'units' => 3,
            'semester_id' => 1,
            'year_id' => 1
        ]);
    }
}
