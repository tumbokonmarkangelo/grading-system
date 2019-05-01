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
            'username' => 'A-0001',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_admin@gmail.com',
            'username' => 'A-0002',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin assistant',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_assistant@gmail.com',
            'username' => 'C-0001',
            'email_verified_at' => now(),
            'type' => 'assistant',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Admin assistant',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_admin_assistant@gmail.com',
            'username' => 'C-0002',
            'email_verified_at' => now(),
            'type' => 'assistant',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_teacher1@gmail.com',
            'username' => 'B-0001',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_teacher2@gmail.com',
            'username' => 'B-0002',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Teacher',
            'middle_name' => '',
            'last_name' => 'Tres',
            'email' => 'diliman_grading_system_teacher3@gmail.com',
            'username' => 'B-0003',
            'email_verified_at' => now(),
            'type' => 'teacher',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Juan',
            'email' => 'diliman_grading_system_student1@gmail.com',
            'username' => '19-0001',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Tu',
            'email' => 'diliman_grading_system_student2@gmail.com',
            'username' => '19-0002',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
        DB::table('users')->insert([
            'first_name' => 'Student',
            'middle_name' => '',
            'last_name' => 'Tres',
            'email' => 'diliman_grading_system_student3@gmail.com',
            'username' => '19-0003',
            'email_verified_at' => now(),
            'type' => 'student',
            'password' => bcrypt('password')
        ]);
    }
}