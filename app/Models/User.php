<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'user_number'; // user_number is now our primary key not id
    protected $keyType = 'int';
    public $incrementing = false;//user number is primary key  but not AI
    public function courseData() //function to link course model to course data model,... to retrieve the courses a user is enrolled
    {

        return $this->hasMany(CourseData::class, 'user_number', 'user_number');//coursedata table is related to user in that
        //one user can have many entries of coursedata
        //now I can easily retrieve all CourseData records for a user

//        $user = User::find($userId);
//        $coursesData = $user->courseData; // This will give you all related CourseData entries
    }
    public function assessmentScores()
    {
        return $this->hasMany(AssessmentScore::class, 'user_number', 'user_number');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_number',
        'fullname',
        'email',
        'password',
        'user_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
