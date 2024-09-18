<?php
    // USER DELETING THEIR REVIEW
    Route::post('/delete-review/{bicycle_id}', function ($bicycle_id) {

        $result = delete_review($bicycle_id);
        $current_userid = session('user_id');
        if ($current_userid and $result) { //you have to be logged in and if the update returns id, then
            //after submitting do
//            session()->put('thankyoumessage', 'Your review has been deleted!');
            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]))->with('reviewdeleted', true);

        } else {
            die("Error deleting your review please make sure you are logged in");
        }
    })->name('delete-review');

    //DELETE REVIEW
    function delete_review($bicycle_id)
    {
        $user_id_from_session = session('user_id');
        //we have: current userid, current bicycleid
//to get manufacturerid we use bicycleid to select
        $getmanufacturerid = "select bicycle_manufacturer_ID from bicycles
           where bicycle_id = ?";
        $found_manuf_id = DB::select($getmanufacturerid, array($bicycle_id));
        $specificmanufod = $found_manuf_id[0]->bicycle_manufacturer_ID; //point to the column name

//PART 1 WE DELETE FROM REVIEWS TABLE
        $deletereview = "delete from reviews where review_creator_id = ? and bicycle_id_being_reviewed = ?";
        DB::delete($deletereview, array($user_id_from_session, $bicycle_id));

//PART 1 WE MINUS 1 and THE TOTAL sum OF REVIEWS FOR A USER AND A BICYCLE AND MANUFACTURER

//        $update_users = "update review_users set total_reviews = total_reviews -1 where user_id = ?";
        $update_bicycles = "update bicycles set bicycle_total_reviews = bicycle_total_reviews -1 where bicycle_id = ?";
        $update_manufacturers = "update manufacturers set manufacturer_total_reviews = manufacturer_total_reviews -1 where manufacturer_id = ?";

//        DB::update($update_users, array($user_id_from_session));
        DB::update($update_bicycles, array($bicycle_id));

//AGAIN WE REUSE THE BICYCLE FUNCTION TO GET THE MANUFCATURER ID OF THIS SPECICIC BIKE TO -1 ON TOTAL REVIEWS
        $gettingbikemanufid = get_bicycle($bicycle_id);
        $bikemanufid = $gettingbikemanufid[0]->bicycle_manufacturer_ID;
//SO I USE THE BIKEMANUFID FOREIGN KEY FROM THE REUSED FUNCTION ABOVE
        DB::update($update_manufacturers, array($bikemanufid));

        if ($getmanufacturerid) {
            return $getmanufacturerid; //just to return something
        }
    }

?>
