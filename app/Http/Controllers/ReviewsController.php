<?php

namespace App\Http\Controllers;
use App\Models\Assessment;
use App\Models\AssessmentScore;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $cid, $assesst_id,  $sid)
    {

        $reviewer_all_data = User::where('user_number', $sid)
            ->first();

        $assessment_data = Assessment::where('id', $assesst_id)//assessment model and student id to show score for userid
            ->first();

//get if there is a score for this user to toggle add and edit score buttons
        $assessment_score = AssessmentScore::where('user_number', $sid)
            ->where('assessment_id', $assesst_id)
            ->where('course_id', $cid)
        ->first();

        $student_reviewee_name = User::where('user_number', 22)
            ->get();

        $submittedreviews = Review::where('reviewer_user_number', $sid)
        ->where('assessment_id', $assesst_id)//also assessmentid has to be associated to this assessment
        ->get();

        $receivedreviews = Review::where('reviewee_user_number', $sid)
            ->where('assessment_id', $assesst_id)//also assessmentid has to be associated to this assessment
            ->get();


        return view('student-reviews-and-score')
            ->with('reviewssubmitted',$submittedreviews)
            ->with('reviewsreceived',$receivedreviews)

//            ->with('revieweename',$student_reviewee_name)
            ->with('assessment_data',$assessment_data)
            ->with('assessment_score',$assessment_score)

            ->with('reviewer_all_data',$reviewer_all_data)

            ->with('cid',$cid)
            ->with('assesst_id',$assesst_id)
            ->with('sid',$sid);

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
    public function show(string $id)
    {
        //
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
