<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\CourseData;
use App\Models\User;

use Illuminate\Http\Request;

class EnrollDeenrollstudent extends Controller
{
    public function enroll(string $cid, $sid)//retrieve the student id from template to update in users model
    {
        $product = CourseData::create(array('course_id'=>$cid, 'user_id'=>$sid, 'assessment_id'=>''));
            return back()->with('feedback', 'Successfully Enrolled');
    }
    public function de_enroll(string $cid, $sid)
    {
        $getusercoursedata = CourseData::where('course_id', $cid)
            ->where('user_id', $sid)
            ->first();

        if ($getusercoursedata) {//if exists, delete record
//            @dd($getusercoursedata);
            $getusercoursedata->delete();
        }
        return back()->with('feedback', 'Successfully De-enrolled');
    }


}
