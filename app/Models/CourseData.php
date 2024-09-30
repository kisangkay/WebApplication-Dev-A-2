<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseData extends Model
{
    use HasFactory;
    public function course() //on this side i use belongs to to link to the course model
    {
        return $this->belongsTo(Course::class);
    }

    protected $fillable = [
        'course_id',
        'user_id',
        'assessment_id',
    ];
}
