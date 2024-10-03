<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\AssessmentScore;

    class AssessmentScoreController extends Controller
    {
        public function post_score(int $cid, $assesst_id,  $sid, Request $request)//post score
        {
            $validate=  $request->validate([
                'score' =>  'required|integer|min:1|max:100',
            ]);

            $scoreValue = $request->input('score');
//        dd($sid);
            $score = AssessmentScore::create(array('assessment_id'=>$assesst_id, 'score'=> $scoreValue, 'course_id'=>$cid, 'user_number'=>$sid ));
            return back()->with('feedback', 'Score Saved Successfully');

        }

        public function update_score(int $cid, $assesst_id,  $sid, Request $request)//update score all values passed in the url in that order we need $sid
        {
            $validate=  $request->validate([
                'score' =>  'required|integer|min:1|max:100',
            ]);
            $scoreValue = $request->input('score');

            $assessment_score = AssessmentScore::where('user_number', $sid)//to update, first retrieve score
            ->where('assessment_id', $assesst_id)
                ->where('course_id', $cid)
                ->first();
//        dd($sid);
            $assessment_score->update(['score' => $scoreValue]);
            return back()->with('feedback', 'Score Updated');

        }
    }
