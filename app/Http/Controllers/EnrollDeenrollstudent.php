<?php

namespace App\Http\Controllers;
use App\Models\AssessmentScore;
use App\Models\Course;
use App\Models\CourseData;
use App\Models\User;

use Illuminate\Http\Request;

class EnrollDeenrollstudent extends Controller
{
    public function enroll(string $cid, int $sid)//retrieve the student id from url to update in users model
    {
        $product = CourseData::create(array('course_id'=>$cid, 'user_number'=>$sid, 'assessment_id'=>''));
            return back()->with('feedback', 'Successfully Enrolled');
    }
    public function de_enroll(string $cid, int $sid)
    {
//                dd($sid);
        $getusercoursedata = CourseData::where('course_id', $cid)//SELECTS STUDENT FROM COURSE ENROLLMENT ENTRY
            ->where('user_number', $sid)
            ->first();
        $getassigndataforthis_student_course = AssessmentScore::where('course_id', $cid)//SELECTS STUDENT'S ASSESSMENT SCORE
            ->where('user_number', $sid)
            ->first();


        if ($getusercoursedata) {//if exists, delete record
            $getusercoursedata->delete();//DELETES STUDENT FROM COURSE ENROLLMENT ENTRY
        }
        if ($getassigndataforthis_student_course) {//if exists, delete record
            $getassigndataforthis_student_course->delete();//DELETES STUDENT'S ASSESSMENT SCORE
        }
        return back()->with('feedback', 'Successfully De-enrolled Relevant Assessment Deleted');
    }

}
