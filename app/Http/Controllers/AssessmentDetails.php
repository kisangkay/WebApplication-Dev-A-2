<?php

namespace App\Http\Controllers;
use App\Models\Assessment;

use App\Models\CourseData;
use App\Models\Review;
use Illuminate\Http\Request;

class AssessmentDetails extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $cid, $assesst_id)//Populate the teacher's ASSESSMENT DETAILS PAGE
    {
        //TO DISABLE EDIT BUTTON FOR TEACHER IF A REVIEW EXISTS ALREADY
        $isthereanyreview = Review::where('course_id', $cid)
        ->where('assessment_id', $assesst_id)
        ->first();

        $assessmentdetails = Assessment::where('id', $assesst_id)->get();//details for this assessment

        // Return the data to the view
        return view('assessment-details-page-teacher')
            ->with('assesst_details', $assessmentdetails[0])
            ->with('cid', $cid)
            ->with('assesst_id', $assesst_id)

            ->with('isthereanyreview',$isthereanyreview);//if there is any review, we sidable assessment edit button
    }

    public function list_assessments(int $cid, $assesst_id) //Populate the list-assessments page for teacher
    {
        //TO DISABLE EDIT BUTTON FOR TEACHER IF A REVIEW EXISTS ALREADY
        $isthereanyreview = Review::where('course_id', $cid)
            ->where('assessment_id', $assesst_id)
            ->first();

        $assessmentdetails = Assessment::where('id', $assesst_id)->get();//details for this assessment

        // Get all users enrolled in the course from CourseData where course_id and assessment_id match
        $courseData = CourseData::with(['user']) // Eager load user details
        ->where('course_id', $cid)
            ->whereHas('user', function ($query) {
                $query->where('user_role', 'student'); // Filter based on user_role in the User model
            })
            ->get();

//ALL STUDENTS REVIEW COUNT, assesst_score grouped by sID

        $courseData = CourseData::with([
            'user' => function ($query) use ($assesst_id, $cid) {
                $query->withCount([
                    'reviewsSubmitted as review_submitted_count' => function ($query) use ($assesst_id, $cid) {
                        $query->where('assessment_id', $assesst_id)
                            ->where('course_id', $cid);
                    },
                    'reviewsReceived as review_received_count' => function ($query) use ($assesst_id, $cid) {
                        $query->where('assessment_id', $assesst_id)
                            ->where('course_id', $cid);
                    },
                ])->with(['assessmentScores' => function ($query) use ($assesst_id, $cid) {
                    $query->where('assessment_id', $assesst_id)
                        ->where('course_id', $cid);
                }]);
            }
        ])
            ->where('course_id', $cid)
            ->whereHas('user', function ($query) {
                $query->where('user_role', 'student'); // Filter based on user_role in the User model
            })
            ->paginate(1); // Pagination added here
//how CAN I APPLY PAGINATION TO THIS GROUPED USER DATA COLLECTION
//            $groupedResults_paginated = $groupedResults::paginate(1);


        // Return the data to the view
        return view('list-assessments')
            ->with('assesst_details', $assessmentdetails[0])
            ->with('cid', $cid)
            ->with('assesst_id', $assesst_id)
            ->with('groupedResults', $courseData)//PAGINATION HERE //all students review count, assesst_score grouped by sID

//            ->with('course_data', $courseData)
            ->with('isthereanyreview',$isthereanyreview);//if there is any review, we sidable assessment edit button
    }


    public function update( int $cid, $assesst_id, Request $request) //updates an assessment from the database
    {
        $Assessment_instruction = $request->input('instruction');
        $due_dates = $request->input('due_date');
        $reviews_requireds = $request->input('reviews_required');
        $max_scores = $request->input('max_score');
        $pr_assessment_type = $request->input('pr_assessment_type');

        $current_record = Assessment::where('id', $assesst_id)//to update, first retrieve score
            ->where('course_id', $cid)//figured i dont need this here
            ->first();
//        dd($sid);
        $current_record->update([
            'assessment_instruction' => $Assessment_instruction,
        'due_date' => $due_dates,
        'reviews_required' => $reviews_requireds,
        'max_score' => $max_scores,
        'peer_review_type' => $pr_assessment_type,
        ]);

        return back()->with('feedback', 'Assessment Updated');
    }


//    RETURN VIEW STUDENT///////////////////////////////////////////////////
    public function index_student(int $cid, $assesst_id) //populates the assessment-details-page of the student
    {

//TO LIST ALL REVIEWS LOGGED IN USER HAS RECEIVED FOR THISS ASSESSMENT AND COURSE
        $reviewer_id_logged_in = auth()->user()->user_number; //get reviewer snumber

        $my_received_reviews = Review::with(['reviewer'])//RECEIVED REVIEWS loading the relationship to user model inside the Review model to get full reviewer details
            ->where('reviewee_user_number', $reviewer_id_logged_in)//will join with User model to get reviewer fullname
            ->where('assessment_id', $assesst_id)
            ->where('course_id', $cid)
            ->get();//to return all entries then i loop over

        $my_given_reviews = Review::with(['reviewee'])//POSTED REVIEWS loading the relationship to user model inside the Review model to get full reviewee details
        ->where('reviewer_user_number', $reviewer_id_logged_in)//WHERE I AM THE REVIEWER will join with User model to get reviewer fullname
        ->where('assessment_id', $assesst_id)
            ->where('course_id', $cid)
            ->get();//to return all entries then i loop over

//Count reviews by logged in user to check agains required totals per student
        $my_total_reviews = Review::where('reviewer_user_number', $reviewer_id_logged_in)
            ->where('assessment_id', $assesst_id)
            ->where('course_id', $cid)
            ->count();

//so $myreviews->reviewer_user_number would be my reviewer now I need to GET ITS RELEVANT Fullname from User Model

//SHOWING STUDENTS ENROLLED IN THE COURSE AND USERROLE STUDENTS
        $students_andcourse_inthiscourse = CourseData::with(['user'])
            ->where('course_id', $cid)
            ->whereHas('user', function ($query) {
                $query->where('user_role', 'student'); // Filter based on user_role in the User model
            })->get();

        $assessmentdetails = Assessment::where('id', $assesst_id)->get();
        // Get all users enrolled in the course from CourseData where course_id and assessment_id match
        $courseData = CourseData::with(['user'])// load user details
        ->where('course_id', $cid)
            ->whereHas('user', function ($query) {
                $query->where('user_role', 'student'); //userrole must be student as we cant review teachers from the dropdown
            })
            ->get();

        return view('assessment-details-page-student')//POPULATE STUDENTS ASSESSMENT DETAILS PAGE
            ->with('cid', $cid)
            ->with('assesst_id', $assesst_id)
            ->with('assesst_details', $assessmentdetails[0])//to show the assessment title in asst details page
            ->with('my_received_reviews', $my_received_reviews)//SHOW RECEIVED REVIEWS THIS COURSE & ASSESSMENT
            ->with('my_given_reviews', $my_given_reviews)//SHOW GIVEN REVIEWS THIS COURSE & ASSESSMENT
            ->with('my_total_reviews', $my_total_reviews)//COUNT OF REVIEWS FROM THIS USER TO COMPARE WITH MAX
            ->with('students_and_course_inthiscourse',$students_andcourse_inthiscourse);//need to run a loop for each array and another loop for each user
    }

    public function edit(int $cid, $assesst_id)
    {

    }

    public function create(int $cid)//return the view of creating a new assessment
    {
        return view('create-new-assessment')->with('cid', $cid);
    }

    public function post($cid , Request $request)//method posts a new assessment from teacher (create-new-assessment)
    {
        $Assessment_name = $request->input('assessment_title');
        $Assessment_instruction = $request->input('assessment_instruction');
        $Required_reviews_number = $request->input('reviews_number');
        $max_score = $request->input('max_score');
        $due_dates_and_time = $request->input('due_date_time');
        $pr_type = $request->input('pr_type_select');


        $create_assessment = Assessment::create(array( //yes i created its fillable in model
            'assessment_name' => $Assessment_name,
            'course_id'=>$cid,
            'due_date' => $due_dates_and_time,
            'assessment_instruction' => $Assessment_instruction,
            'number_reviews_required' => (int) $Required_reviews_number,
            'max_score' => $max_score,
            'peer_review_type' => $pr_type,
        ));

        return back()->with('feedback', 'Assessment Posted!');

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
    public function show(string $id)
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
