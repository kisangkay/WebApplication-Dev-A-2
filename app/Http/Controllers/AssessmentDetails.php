<?php

namespace App\Http\Controllers;
use App\Models\Assessment;

use App\Models\AssessmentScore;
use App\Models\CourseData;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AssessmentDetails extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $cid, $assesst_id)
    {
        //TO DISABLE EDIT BUTTON IF A REVIEW EXISTS ALREADY
        $isthereanyreview = Review::where('course_id', $cid)
        ->where('assessment_id', $assesst_id)
        ->first();

        $assessmentdetails = Assessment::where('id', $assesst_id)->get();
        // Get all users enrolled in the course from CourseData where course_id and assessment_id match
        $courseData = CourseData::with(['user']) // Eager load user details
        ->where('course_id', $cid)
            ->whereHas('user', function ($query) {
                $query->where('user_role', 'student'); // Filter based on user_role in the User model
            })
            ->get();

        // Initialize the grouped results array
        $groupedResults = [];

        // Process the users in courseData
        foreach ($courseData as $data) {
            $user_number = $data->user->user_number;

            // Count the number of reviews submitted by and received by this user for the given assessment
            $review_submitted_c = Review::where('reviewer_user_number', $user_number)
                ->where('assessment_id', $assesst_id)
                ->where('course_id', $cid)
                ->count();

            $review_received_c = Review::where('reviewee_user_number', $user_number)
                ->where('assessment_id', $assesst_id)
                ->where('course_id', $cid)
                ->count();

            // Retrieve scores for this user for the given assessment
            $scores = AssessmentScore::where('user_number', $user_number)
                ->where('assessment_id', $assesst_id)
                ->where('course_id', $cid)
                ->get();

            // Add user data, scores, and review counts to the groupedResults array
            if (!isset($groupedResults[$user_number])) {
                $groupedResults[$user_number] = [
                    'user' => $data->user, // User details from the user relation
                    'scores' => $scores, // User's scores
                    'reviews' => [], // Placeholder for review data (optional)
                    'review_submitted_count' => $review_submitted_c, // Count of reviews submitted
                    'review_received_count' => $review_received_c, // Count of reviews received
                ];
            }
        }
        // Return the data to the view
        return view('assessment-details-page')
            ->with('groupedResults', $groupedResults)
            ->with('cid', $cid)
            ->with('assesst_id', $assesst_id)
            ->with('assesst_details', $assessmentdetails[0])
            ->with('isthereanyreview',$isthereanyreview);

    }

    public function update( int $cid, $assesst_id, Request $request)
    {
        $Assessment_instruction = $request->input('instruction');
        $due_dates = $request->input('due_date');
        $reviews_requireds = $request->input('reviews_required');
        $max_scores = $request->input('max_score');

        $current_record = Assessment::where('id', $assesst_id)//to update, first retrieve score
            ->where('course_id', $cid)//figured i dont need this here
            ->first();
//        dd($sid);
        $current_record->update([
            'assessment_instruction' => $Assessment_instruction,
        'due_date' => $due_dates,
        'reviews_required' => $reviews_requireds,
        'max_score' => $max_scores,
        ]);

        return back()->with('feedback', 'Assessment Updated');
    }
    public function edit(int $cid, $assesst_id)
    {


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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
