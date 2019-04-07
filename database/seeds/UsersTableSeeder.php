<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 50)->create()->each(function ($user) {
        //     $user->posts()->save(factory(App\Post::class)->make());
        // });
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system@gmail.com',
            'username' => 'admin',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_admin@gmail.com',
            'username' => 'admintu',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_teacher@gmail.com',
            'username' => 'teacher1',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_student@gmail.com',
            'username' => 'student1',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
    }
}