<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
         //assessments between 1 and 4 assessments

        //loop over all 5 courses
        $course_count=1;
        while ($course_count <5) {

            $assessments_to_create = rand(1, 4);

            for ($assesments_to_add = 0; $assesments_to_add < $assessments_to_create; $assesments_to_add++) {

                $max_score = [20, 50, 100];
                $reviews_required = [2, 3, 4];

                shuffle($max_score);
                shuffle($reviews_required);

                $maximum_score = array_slice($max_score, 0, 1);
                $reviews_required_number = array_slice($reviews_required, 0, 1);

                DB::table('assessments')->insert([
                    'assessment_name' => $faker->title,
                    'course_id' => $course_count,
                    'due_date' => $faker->dateTime,
                    'assessment_instruction' => $faker->paragraph,
                    'number_reviews_required' => $reviews_required_number[0],
                    'max_score' => $maximum_score[0],
                    'peer_review_type' => 'Student-Select',
                    'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]);
            }
            $course_count++;//run inner loop 5 times, as no of courses
        }
    }
}
