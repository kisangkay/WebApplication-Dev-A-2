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
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }
}
