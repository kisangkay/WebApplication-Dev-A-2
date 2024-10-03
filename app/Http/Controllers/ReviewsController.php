<?php

    namespace App\Http\Controllers;
    use App\Models\Assessment;
    use App\Models\AssessmentScore;
    use App\Models\Review;
    use App\Models\User;
    use App\Rules\DropdownChecker;
    use App\Rules\MinWords;
    use Illuminate\Http\Request;

    class ReviewsController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(int $cid, $assesst_id,  $sid)//POPULATE MARKING PAGE
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

        public function index_student_create_review(int $cid, $assesst_id, Request $request)//STUDENT SUBMITTING A REVIEW ENTRY
        {
//VALUES TO CHECK IF THERE IS ALREADY A REVIEW FOR THIS STUDENT MADE BY THE LOGGED IN USER
            $reviewer_id_logged_in = auth()->user()->user_number; //get reviewer snumber
            $reviewee_user_number = $request->input('reviewee_user_number'); //get reviewee student number
            $number_of_reviews_required = $request->input('number_of_reviews_required'); //NUMBER OF REVIEWS REQUIRED



            $array = [];

            for ($i = 0; $i < $number_of_reviews_required; $i++) {
//                dd($request->input('review_text'.$i));
                // Collect the validation rules for each review_text field
                $array['review_text' . $i] = [new MinWords(5)];
            }
            $request->validate($array);


            //i was only getting the first option validated hence opted to using an array to validate each at once after gathering the form field values
//            $request->validate($review_text_array_fields);

//I FIGURE I NEED TO LOOP THE HAVEIREVIEWED CHECKER THE NUMBER OF TIMES OF number_reviews_required
                for ($i = 0; $i < $number_of_reviews_required; $i++) {//checking if review done by logged in user for each student

                    $reviewee_user_number = $request->reviewee_user_number[$i];
//RUBRIC DIDNT SPECIFY IF I TO PREVENT USER FROM REVIEWING THEMSELVES
//                if ($reviewee_user_number == $reviewer_id_logged_in){
//                    return back()->with('feedback_error', 'Sorry you cannot review Yourself');
//                }

                //IF USER ALREADY REVIEWED THIS REVIEWEE PER THE VALUE FROM THE [$i]
                $haveireviewed = Review::where('reviewer_user_number', $reviewer_id_logged_in)//IF MATCHING, RETURN WITH feedback message
                ->where('reviewee_user_number', $reviewee_user_number)//the requested reviewee_id from the form
                ->where('assessment_id', $assesst_id)
                    ->where('course_id', $cid)
                    ->exists();

                if ($haveireviewed) {//if any existing return from haveireviewed,
                    return back()->with('feedback_error', 'Review NOT Submitted, you already made a review for this Student');
                }
            }
//                dd($request->review_text);

//I LOOP THE CREATE ELOQUENT THE NUMBER OF TIMES OF THE FORM SECTION WAS DISPLAYES
            //if no existing review yet for this course, assessment, reviewer and reviewee id combo

            for ($i = 0; $i < $number_of_reviews_required; $i++) {
                Review::create(array(

                    'reviewer_user_number'=>$reviewer_id_logged_in, //reviewer is the same for all reviews
                    'reviewee_user_number'=>$request->reviewee_user_number[$i],//since the name attributes in html are arrays
//                    'review_submitted'=>$request->review_text[$i],
                    'review_submitted'=>$request->input('review_text'.$i),
                    'assessment_id'=>$assesst_id, //assesst id is the same for all reviews
                    'course_id'=>$cid //courseid is the same for all reviews
                ));
            }
            return back()->with('feedback', $number_of_reviews_required . ' Reviews Submitted');

        }

        public function update_reviewers_rating(int $cid, $assesst_id, Request $request)//requesting the rating and reviewers_id
        {
//SAVE A RATING SUBMITTED BY A LOGGED IN USER TO A SPECIFIC REVIEW
            $reviewer_id_logged_in = auth()->user()->user_number; //get reviewee_id from session
            $reviewee_is_rating_as = $request->input('reviewee_is_rating_as'); //get rating
            $reviewer_id = $request->input('reviewer_id'); //get reviewer_id

            //REVIEW RECORD TO UPDATE
            $whichreview_entry = Review::where('reviewer_user_number', $reviewer_id)//IF MATCHING, RETURN WITH feedback message
            ->where('reviewee_user_number', $reviewer_id_logged_in)//reviewee becomes the logged in user
            ->where('assessment_id', $assesst_id)
                ->where('course_id', $cid)
                ->first();

//INITIAL RATING WAS 'NULL' SO WE UPDATE IT TO A RANGE 1-5
            $whichreview_entry->update([
                'reviewee_rated' => $reviewee_is_rating_as,
            ]);


            return back()->with('feedback', 'Rating Submitted');
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
