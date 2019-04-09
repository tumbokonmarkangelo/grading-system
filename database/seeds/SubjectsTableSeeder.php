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
            'description' => 'English 1'
        ]);
        DB::table('subjects')->insert([
            'code' => 'MATH123',
            'description' => 'MATH 1'
        ]);
        DB::table('subjects')->insert([
            'code' => 'IT123',
            'description' => 'Introduction to information technology'
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE1',
            'description' => 'Physical Education 1'
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE2',
            'description' => 'Physical Education 2'
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE3',
            'description' => 'Physical Education 3'
        ]);
        DB::table('subjects')->insert([
            'code' => 'PE4',
            'description' => 'Physical Education 4'
        ]);
    }
}
