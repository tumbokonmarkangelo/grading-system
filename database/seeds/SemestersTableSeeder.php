
<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semester')->insert([
            'name' => 'First Semester',
            'code' => '1',
        ]);
        DB::table('semester')->insert([
            'name' => 'Second Semester',
            'code' => '2',
        ]);
        DB::table('semester')->insert([
            'name' => 'Third Semester',
            'code' => '3',
        ]);
    }
}
