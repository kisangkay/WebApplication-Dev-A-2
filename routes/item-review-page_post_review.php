<?php
    //USER POST REVIEW ITEM REVIEW PAGE ROUTE 2
    //to add a user review, we take the text from the form, and rating out of 5
    //i had to use the same route name as in the template so as i will be redirected to the same pag
    //while making use of the {} placeholder to reload to the same item id page as the review was submitted for the bike
    Route::post('/item-review-page/{id}', function ($bicycle_id) {


        //we still use the placeholder {bicycle_id} in the url to pass the id again as an associative array in the return
        $reviewtext = request('review-text');
        $ratingrange = request('rating-range');

//POST REVIEW INPUT VALIDATIONNNNNNNNNNNNNNNNNN
        if (!$reviewtext) { //Empty, <2 in length or 0 value
            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror', 'PLease provide a review!');
        } elseif (strlen($reviewtext) < 5 || strlen($reviewtext) > 800) {
            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror', 'Please leave a review between 2 and 150 words');
        } //To check for these illegal chars
        elseif ($reviewtext) {
            $illegal_chars = "-_+\"'";

            $user_name_characters = str_split($reviewtext); //makes an array of each chars in the username
            foreach ($user_name_characters as $character) { //check if each char matches the defined
                if (strpos($illegal_chars, $character) == true) { //$character is a single char of each value in the username
                    return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])
                        ->with('validationerror', 'Your review cant contain any of these: - _ + " \' characters');
                }
            }
        }

        $result = add_review($bicycle_id); //the return result is the id of the last entry using pdo
        //then we get the userid from the session to see if there is already an existing record of their review
        $current_userid = session('user_id');
        if ($current_userid and $result) {
            //after submitting
            session()->put('thankyoumessage', 'Thank you for leaving your review!');
            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]));

        } else {
            die("Error submitting your review but is should,
                    given submit button was disabled if review already made, also please make sure you are logged in");
        }

    })->name('item-review-page');


    //to add a review to the database
    function add_review($bicycle_id)
    {
        $reviewtext = request('review-text');
        $ratingrange = request('rating-range');
        $user_id_from_session = session('user_id');
        $currentdate = date('d-m-Y');

//        $sql = "insert into reviews, review_users, bicycles

//PART 1 WE INSERT REVIEWS TABLE
//JUST ADDED MANUFACTURER ID FOREIGN KEY TO LINK MANUF TABLE AND REVIEWS TABLE, SO
//FIRST WE GET THE MANUF ID OF THE SELECTED BIKE
        $get_manuf_id_of_this_bike = "select bicycles.bicycle_manufacturer_ID from bicycles
                                        where bicycle_id = ?";
        $getmanufid = DB::select($get_manuf_id_of_this_bike, array($bicycle_id));
        $specific_manuf_id = $getmanufid[0]->bicycle_manufacturer_ID;
//        @dd($specific_manuf_id);

//FIXED AFTER ADDING A NEW COLUMN TO REVIEWS TABLE NOW CHECKING UPDATE RRVIEW ROUTE
        $addareview = "insert into reviews (review_creator_id, rating, review_date, review_text, bicycle_id_being_reviewed,manuf_id_of_bicycle_being_reviewed)
values (?,?,?,?,?,?)";
        DB::insert($addareview, array($user_id_from_session, $ratingrange, $currentdate, $reviewtext, $bicycle_id, $specific_manuf_id)); //insert values
        $executequery1 = DB::getPdo()->lastInsertId(); //get id of last entry

//PART 2 WE INSERT USERS TABLE +1 to total reviews
//        $addusertotalreviews = "update review_users set total_reviews = total_reviews+1 where user_id = ?";
//        DB::update($addusertotalreviews, array($user_id_from_session));

//PART 3 WE INSERT BICYCLES TABLE +1 to total reviews
        $addtotalbikereviews = "update bicycles set bicycle_total_reviews = bicycle_total_reviews+1 where bicycle_id = ?";
        DB::update($addtotalbikereviews, array($bicycle_id));

//to get manufacturerid we use bicycleid to select
        $getmanufacturerid = "select bicycle_manufacturer_ID from bicycles
           where bicycle_id = ?";
        $found_manuf_id = DB::select($getmanufacturerid, array($bicycle_id));
        $specificmanufid = $found_manuf_id[0]->bicycle_manufacturer_ID; //not to find its specific integer of ID we access
        //it by using an associative array.
//        dd($specificmanufid);
//

//PART 4 WE INSERT MANUFACTURERS TABLE +1 to total reviews
        //HERE I REUSE THE GET_BICYCLE FUNCTION TO GET THE BICYCLE MANUFACTURER ID FROM THE TABLE BICYCLES
        $gettingbikemanufid = get_bicycle($bicycle_id);
        $bikemanufid = $gettingbikemanufid[0]->bicycle_manufacturer_ID;
//SO I USE THE BIKEMANUFID FOREIGN KEY FROM THE REUSED FUNCTION ABOVE
        $updatemanuftotalreviews = "update manufacturers set
             manufacturer_total_reviews = manufacturer_total_reviews +1 where manufacturer_id = ?";
        DB::update($updatemanuftotalreviews, array($bikemanufid));


        if ($executequery1) {
            return $executequery1;
        } else {
            die("error entering your review on $updatemanuftotalreviews");
        }
    }

?>
