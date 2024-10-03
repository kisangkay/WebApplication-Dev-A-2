<?php

    namespace App\Http\Controllers;
    use App\Models\AssessmentScore;
    use App\Models\Course;
    use App\Models\CourseData;
    use App\Models\User;

    use Illuminate\Http\Request;

    class Enroll extends Controller
    {
        public function enroll( Request $request)//retrieve the student id from url to update in users model
        {
            $validate=  $request->validate([
                'student_number' =>   'required|integer|min:1',
        ]);

            $course_id = $request->input('course_id');//INPUT VALUDATION
            $student_id_to_add = $request->input('student_number');

//TO HANDLE EVENT WHERE USER ENTERS STUDENT WHO WHERE ALREADY A COURSE MEMBER, I CHECK IF $student_id_to_add exists in COL WITH $course_id
            $select_if_student_to_enroll = CourseData::where('user_number', $student_id_to_add)->first();

            if ($select_if_student_to_enroll)//if exists, return back with feedback in session message
            {
                return back()->with('feedback', 'Could not Add! Student Already Enrolled into this course');
            }
            else{
                $insert = CourseData::create(array('course_id'=>$course_id, 'user_number'=>$student_id_to_add));
                return back()->with('feedback', 'Successfully Enrolled');
            }
        }

    }
