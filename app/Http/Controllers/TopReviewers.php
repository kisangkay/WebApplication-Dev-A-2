<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //used db facede here to use the query builder as i couldnt find eloquent method for avg

class TopReviewers extends Controller
{
    public function index()
    {
        //JOIN THE REVIEW TABLE AND USER TABLE TO GET FULL NAME BASED ON THE user_number after getting the average of ratings

        $top_reviews_average = Review::with('reviewer')//eloquent method with used, and reviewer is a method in the model that connects to user table to get full details
        ->select('reviewer_user_number', DB::raw('AVG(reviewee_rated) as average_rating'))//used db facade here as not aware of eloquent's average method
            //used eloquent select method here, and i had to use raw sql to get the average
            ->groupBy('reviewer_user_number')//eloquent and the rest are eloquent methods too AVG APPLIED TO @student_id
            ->orderBy('average_rating', 'desc')
            ->limit(5)//we only getting the top 5
            ->get();//use loop. if was first() it would be a single entry and no need for loop


        return(view('top-reviewers'))
            ->with('top_reviewers', $top_reviews_average);
    }
}
