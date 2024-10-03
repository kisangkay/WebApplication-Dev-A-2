<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseData;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //for every seeder we need to add it here
        // php artisan db:seed
        //ORDER FOLLOWS
        $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(CourseDataTableSeeder::class);
        $this->call(AssessmentsTableSeeder::class);
//        $this->call(AssessmentScoresTableSeeder::class);
//        $this->call(ReviewsTableSeeder::class);


//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
