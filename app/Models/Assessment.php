<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    public function course() //on this side i use belongs to to link to the course model
    {
        return $this->belongsTo(Course::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'assessment_id', 'id');
    }
    public function scores()
    {
        return $this->hasMany(AssessmentScore::class, 'assessment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'review_user_id', 'user_number');
    }

    protected $fillable = [
        'assessment_name',
        'course_id',
        'due_date',
        'assessment_instruction',
        'number_of_reviews_required',
        'max_score',
        'peer_review_type',
    ];
}
