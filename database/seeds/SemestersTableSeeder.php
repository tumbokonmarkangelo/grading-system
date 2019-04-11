
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
        DB::table('semesters')->insert([
            'name' => 'First Semester',
            'code' => '1',
        ]);
        DB::table('semesters')->insert([
            'name' => 'Second Semester',
            'code' => '2',
        ]);
        DB::table('semesters')->insert([
            'name' => 'Summer',
            'code' => '3',
        ]);
    }
}
