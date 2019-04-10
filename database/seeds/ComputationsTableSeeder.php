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
            'period' => 'prelim',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Recitation',
            'value' => '10',
            'period' => 'prelim',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Assignment/Project',
            'value' => '20',
            'period' => 'prelim',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Atttendance',
            'value' => '10',
            'period' => 'prelim',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Exam',
            'value' => '40',
            'period' => 'prelim',
        ]);
        
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Quiz',
            'value' => '20',
            'period' => 'midterm',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Recitation',
            'value' => '10',
            'period' => 'midterm',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Assignment/Project',
            'value' => '20',
            'period' => 'midterm',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Atttendance',
            'value' => '10',
            'period' => 'midterm',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Exam',
            'value' => '40',
            'period' => 'midterm',
        ]);
        
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Quiz',
            'value' => '20',
            'period' => 'final',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Recitation',
            'value' => '10',
            'period' => 'final',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Assignment/Project',
            'value' => '20',
            'period' => 'final',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Atttendance',
            'value' => '10',
            'period' => 'final',
        ]);
        DB::table('computations')->insert([
            'classes_subject_id' => 0,
            'name' => 'Exam',
            'value' => '40',
            'period' => 'final',
        ]);
    }
}
