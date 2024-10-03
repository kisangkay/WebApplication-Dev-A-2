<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_number' => 200,
            'fullname' => 'Oliver Harper',
            'email' => 'oliver.harper100@gm.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);

        DB::table('users')->insert([
            'user_number' => 201,
            'fullname' => 'Sophia Bennett',
            'email' => 'sophia.bennett101@sophben.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);

        DB::table('users')->insert([
            'user_number' => 202,
            'fullname' => 'Mason Andrews',
            'email' => 'mason.andrews102@yaho.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);

        DB::table('users')->insert([
            'user_number' => 203,
            'fullname' => 'Isabella Taylor',
            'email' => 'isabella.taylor103@isa.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);

        DB::table('users')->insert([
            'user_number' => 204,
            'fullname' => 'Benjamin White',
            'email' => 'benjamin.white104@benw.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);

        DB::table('users')->insert([
            'user_number' => 205,
            'fullname' => 'Ava Harris',
            'email' => 'ava.harris105@harr.com',
            'email_verified_at' => null,
            'password' => bcrypt('12341234'),
            'user_role' => 'teacher',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'remember_token' => null,
        ]);


//Loop to enter 60 students with random values:
        $faker = Faker::create();

        for ($user_number = 100; $user_number < 160; $user_number++) {//59 students
            DB::table('users')->insert([
                'user_number' => $user_number,
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => null,
                'password' => bcrypt('12341234'),
                'user_role' => 'student',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'remember_token' => null,
            ]);
        }

    }



}
