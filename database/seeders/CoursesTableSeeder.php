<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'course_code' => '1104ICT',
            'course_name' => 'Professional ICT Practice',
            'course_image' => 'images/profprac.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('courses')->insert([
            'course_code' => '1903ICT',
            'course_name' => 'Application Systems Design',
            'course_image' => 'images/appsystems.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('courses')->insert([
            'course_code' => '2108ICT',
            'course_name' => 'Design Thinking in IT',
            'course_image' => 'images/design.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('courses')->insert([
            'course_code' => '1031ICT',
            'course_name' => 'Applied Computing',
            'course_image' => 'images/applied.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('courses')->insert([
            'course_code' => '3016ICT',
            'course_name' => 'Mathematics for Computer Science',
            'course_image' => 'images/math.png',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
