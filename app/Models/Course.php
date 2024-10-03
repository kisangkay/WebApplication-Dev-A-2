<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Course extends Model
    {
        use HasFactory;
        public function courseData() //function to link course model to course data model,... to retrieve the relevant courses.
        {
            return $this->hasMany(CourseData::class);
        }
    }
