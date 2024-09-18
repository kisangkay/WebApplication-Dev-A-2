<?php

    //ITEM REVIEW PAGE ROUTE 1 my route to POPULATE review page with the item and reviews matching that bicycleid
    Route::get('/item-review-page/{bicycle_id}', function ($bicycle_id) {

        //to check if user already has another review
        $currentuserid = session('user_id');
//        dd($currentuserid);
        $sql = "select * from reviews, review_users where reviews.review_creator_id = ?
                                  and reviews.bicycle_id_being_reviewed = ? ";
        $leetsexecute = DB::select($sql, array($currentuserid, $bicycle_id));

//LETS ALSO GET THE IMAGE PATH FROM THE DATABASE
        $GETIMAGEPATH = "select bicycle_image from bicycles where bicycle_id = ?";
        $foundbikeimagepath = DB::select($GETIMAGEPATH, array($bicycle_id));

//TO SHOW MANUFACTURER NAME TOO I NEED TO JOIN BICYCLE ID AND MANUFACTURER TABLE TO SHOW BIKE IMAGE AND MANUF NAME OH I DID THAT IN THE get_bicycle function

        if ($leetsexecute and $foundbikeimagepath) { //if we get any matching result , then it means yes
            //so we return all found items and reviews once again, but we also
            // include the result of $foundbikeimagepath to check if its not empty then we do
//USER HAS A REVIEW FOR THE BIKE
            $itemfound = get_bicycle_and_manufacturer_name($bicycle_id);
            $reviewsfound = get_allreviews($bicycle_id);
            $reviewtextforloggedusertoedit = get_specificreviews($bicycle_id, $currentuserid); //getting current user's review to only edit it
            $hasedited = false;

//using return view and with, it passes data directly to the view. accessible as a variable. not session
//so tasked to find out how sessions work, i learned about put and flush and using redirect method+with to store data in session

            return view('item-review-page')
                ->with('items', $itemfound)
                ->with('reviewtext_for_you', $reviewtextforloggedusertoedit)
                ->with('reviews', $reviewsfound)
                ->with('hasareview', $leetsexecute)
                ->with('hasedited', $hasedited)
                ->with('bikeimagepath', $foundbikeimagepath);

            //if we find a record, then we disable the submit button
        } else {
//USER HAS NO REVIEW FOR THE BIKE STILL POPULATE THE PAGE BUT DIFFERENCE IS PASSING HASREVIEWS WHICH IS NOW FALSE AND IN THAT PAGE WE HAVE IF STMT FOR THAT
            $itemfound = get_bicycle_and_manufacturer_name($bicycle_id);
            $reviewsfound = get_allreviews($bicycle_id);
            return view('item-review-page') //return the view with both the selected bicycle and ALL its found reviews
            ->with('items', $itemfound)
                ->with('reviews', $reviewsfound)
                ->with('hasareview', $leetsexecute)
                ->with('bikeimagepath', $foundbikeimagepath);

//I FORGOT TO ALSO ADD THE NEW IMAGEPATH IF USER HAS NOT EXISTING REVIEW, FAILED TO NOTICE THIS AND WAS STUCK FOR HOURS

        }//closing the if statement
    })->name('item-review-page/{bicycle_id}');

    // AGAIN TO SHOW MANUFACTURER NAME TOO I NEED TO JOIN BICYCLE ID AND MANUFACTURER TABLE TO SHOW BIKE IMAGE AND MANUF NAME
    function get_bicycle_and_manufacturer_name($bicycle_id)
    {
//        $sql1 = "select * from bicycles where bicycle_id = ?";
        $all_bicycledata_and_its_manufacturername = "select bicycles.* , manufacturers.manufacturer_name
         FROM bicycles, manufacturers where bicycles.bicycle_manufacturer_ID = manufacturers.manufacturer_id
                                        and bicycles.bicycle_id = ?";

        $items = DB::select($all_bicycledata_and_its_manufacturername, array($bicycle_id));
        if (count($items) != 1) {
            die("error while fetching item result from query $sql");
        } else {
            $itemfound = $items;
            return $itemfound;
        }
    }

    //function to return all reviews for a selected item itemid==specific
    function get_allreviews($bicycle_id)
    {
        $sql = "select *, sum(reviews.flags) as totalflagsforthisreview
        from reviews, review_users
         where review_users.user_id =reviews.review_creator_id
           and reviews.bicycle_id_being_reviewed = ?
         group by review_id"; //? for sanitization
        $items = DB::select($sql, array($bicycle_id));


//        dd($items);

        $itemfound = $items;
        return $itemfound;
    }

    //GET REVIEW FOR THIS ONE LOGGED IN USERRRRRRRRRRR
    $current_user_id = session('user_id');
    function get_specificreviews($bicycle_id, $current_user_id)
    {
        $sql = "select * from reviews, review_users where review_users.user_id =
         reviews.review_creator_id and reviews.bicycle_id_being_reviewed = ? and review_users.user_id = ?";
        $items = DB::select($sql, array($bicycle_id, $current_user_id));

        $itemfound = $items;
        return $itemfound;
    }

?>
