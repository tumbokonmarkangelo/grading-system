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
            'email' => 'diliman_grading_system_teacher1@gmail.com',
            'username' => 'teacher1',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_teacher2@gmail.com',
            'username' => 'teacher2',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Tres',
            'email' => 'diliman_grading_system_teacher3@gmail.com',
            'username' => 'teacher3',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_student1@gmail.com',
            'username' => 'student1',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_student2@gmail.com',
            'username' => 'student2',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Tres',
            'email' => 'diliman_grading_system_student3@gmail.com',
            'username' => 'student3',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
    }
}