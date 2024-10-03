<?php

namespace App\Http\Controllers;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\CourseData;
use App\Models\User;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()//populate home page with enrolled or teaching courses
    {
        //TO GET COURSES LOGGED IN USER IS ENROLLED/TEACHING IN:
        $user_id_from_loggeduser = auth()->user()->user_number; //get user snumber
        $courses_for_this_user = Course::whereHas('CourseData', function ($query) use ($user_id_from_loggeduser) {//retrieves all courses BUT FILTERS ones associated with logged in user using Wherehas
            $query->where('user_number', $user_id_from_loggeduser);//I want to filter courseData by userid
        })->get();
        if (auth()->user()->user_role === 'teacher') {
            return view('courses')->with('courses_for_this_user', $courses_for_this_user)->with('whichrole', 'Your Teaching Courses');
        }
        else{
            return view('courses')->with('courses_for_this_user', $courses_for_this_user)->with('whichrole', 'Your Enrolled Courses');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function teacher_show(int $id,)//populates course details page for teacher
    {
        $course = Course::findOrFail($id);//getting course id from url
        $assesstthiscourse = Assessment::where('course_id', $id)->get();//get all assessments with courseid $id
//dd($id);

        //pick full names of users who are teachers and exist in the coursedata table and course table and COURSE ID IS FROM PAGE $id
        $fullnames = User::whereHas('CourseData', function ($query) use ($id) {
            $query->where('course_id', $id); // Check for matching course_id
        })->where('user_role', 'teacher')->get();

//        dd($fullnames);

        return view('course-details-page-teacher')->with('course', $course) //FILTER COURSES WHERE TEACHER IS A TEACHER and stud
        ->with('teachers', $fullnames)
        ->with('assesstthiscourse', $assesstthiscourse);
    }

    public function add_registered_student(int $id)
    {
        $allusers = User::where('user_role', 'student')->paginate(10);


        $this_course_name_for_header = CourseData::with('course')//list specific course name matching $cid
            ->where('course_id', $id)
            ->first();

        return view('add-registered-student')
            ->with('all_users' , $allusers)
            ->with('cid' , $id)
            ->with('this_course_name_for_header' , $this_course_name_for_header);
    }


//STUDENT SHOW///////////////////////////////////////
    public function student_show(int $id,)
    {
        $course = Course::findOrFail($id);//getting course id from url
        $assesstthiscourse = Assessment::where('course_id', $id)->get();//get all assessments with courseid $id
//dd($id);
        //pick full names of users who are teachers and exist in the coursedata table and course table and COURSE ID IS FROM PAGE $id

        $fullnames = User::whereHas('CourseData', function ($query) use ($id) {
            $query->where('course_id', $id); // Check for matching course_id
        })->where('user_role', 'teacher')->get();
//        dd($fullnames);
        return view('course-details-page-student')->with('course', $course) //FILTER COURSES WHERE TEACHER IS A TEACHER and stud
        ->with('teachers', $fullnames)
            ->with('assesstthiscourse', $assesstthiscourse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
