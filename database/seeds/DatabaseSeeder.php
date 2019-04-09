<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(YearLevelsTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(ComputationsTableSeeder::class);
    }
}
