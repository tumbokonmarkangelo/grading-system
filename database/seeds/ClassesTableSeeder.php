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
        ]);
        DB::table('classes')->insert([
            'code' => 'BSIT-456',
        ]);
        DB::table('classes')->insert([
            'code' => 'BSIT-789',
        ]);
    }
}
