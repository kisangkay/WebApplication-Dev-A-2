<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//times to enroll random teachers to random courses without repeating course number for @teacher

            for ($teacher_id_to_enroll = 200; $teacher_id_to_enroll < 206; $teacher_id_to_enroll++) {//6 teachers
                //each teacher enrol between 2 and 3 courses
                $how_many_courses_to_enroll_per_teacher = rand(2, 3);

                $course_ids = [1, 2, 3, 4, 5];

                shuffle($course_ids);

                $course_to_enroll = array_slice($course_ids, 0, $how_many_courses_to_enroll_per_teacher);//to pick only unique value at location 0

                foreach ($course_to_enroll as $course_id) {
                    DB::table('course_data')->insert([
                        'course_id' => $course_id,
                        'user_number' => $teacher_id_to_enroll,
                        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                    ]);
                }
            }

 //enroll students
        for ($student_id_to_enroll = 100; $student_id_to_enroll < 159; $student_id_to_enroll++) {//59 students
            //each teacher enrol between 2 and 3 courses
            $how_many_courses_to_enroll_per_student = rand(2, 4);

            $course_ids = [1, 2, 3, 4, 5];

            shuffle($course_ids);

            $course_to_enroll = array_slice($course_ids, 0, $how_many_courses_to_enroll_per_student);//from ltn 0 picks the number of values = $how_many..

            foreach ($course_to_enroll as $course_id) {
                DB::table('course_data')->insert([
                    'course_id' => $course_id,
                    'user_number' => $student_id_to_enroll,
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]);
            }
        }
        }

}
