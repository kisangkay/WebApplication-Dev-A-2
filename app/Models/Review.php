<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'review_user_number', 'user_number');
    }
    public function assessmentScore()
    {
        return $this->belongsTo(AssessmentScore::class, 'assessment_score_id', 'id');
        return $this->belongsTo(User::class, 'review_user_number', 'user_number');
    }
    public function assessmentScore()
    {
        return $this->belongsTo(AssessmentScore::class, 'assessment_score_id', 'id');
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function reviewer() //for the reviewer method to retrieve full user info
    {
        return $this->belongsTo(User::class, 'reviewer_user_number', 'user_number');
    }
    public function reviewee() //for the reviewee method to retrieve full user info
    {
        return $this->belongsTo(User::class, 'reviewee_user_number', 'user_number');
    }
    protected $fillable = [
        'reviewer_user_number',
        'reviewee_user_number',
        'review_submitted',
        'reviewee_rated',
        'assessment_id',
        'course_id',
    ];
}
