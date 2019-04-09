<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'code' => 'BSIT-123',
            'semester_id' => 1,
            'year_id' => 1,
        ]);
        DB::table('classes')->insert([
            'code' => 'BSIT-456',
            'semester_id' => 2,
            'year_id' => 1,
        ]);
        DB::table('classes')->insert([
            'code' => 'BSIT-789',
            'semester_id' => 3,
            'year_id' => 1,
        ]);
    }
}
