<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentScore extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_number', 'user_number');
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'assessment_score_id', 'id'); // Assuming 'assessment_score_id' is the foreign key in Review
    }

    protected $fillable = [
        'assessment_id',
        'score',
        'user_number',
        'course_id',
    ];
}
