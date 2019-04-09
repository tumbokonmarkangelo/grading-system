<?php

use Illuminate\Database\Seeder;

class ComputationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Quiz',
            'value' => '20',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Recitation',
            'value' => '10',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Assignment/Project',
            'value' => '20',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Atttendance',
            'value' => '10',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Exam',
            'value' => '40',
        ]);
    }
}
