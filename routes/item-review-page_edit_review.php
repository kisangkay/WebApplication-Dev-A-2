<?php
    // USER EDITING THEIR REVIEW
    Route::post('/item-review-update-action/{bicycle_id}', function ($bicycle_id) {

        //we still use the placeholder {bicycle_id} in the url to pass the id again as an associative array in the return
        $newreviewtext = request('new-review-text');
        $newratingrange = request('new-rating-range');

//EDIT REVIEW INPUT VALIDATIONNNNNNNNNNNNNNNNNN
        if (!$newreviewtext) { //Empty, <2 in length or 0 value
            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror', 'PLease provide a review!');
        } elseif (strlen($newreviewtext) < 5 || strlen($newreviewtext) > 800) {
            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror', 'Please leave a review between 2 and 150 words');
        } //To check for these illegal chars
        elseif ($newreviewtext) {
            $illegal_chars = "-_+\"'";

            $user_name_characters = str_split($newreviewtext); //makes an array of each chars in the username
            foreach ($user_name_characters as $character) { //check if each char matches the defined
                if (strpos($illegal_chars, $character) == true) { //$character is a single char of each value in the username
                    return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])
                        ->with('validationerror', 'Your review cant contain any of these: - _ + " \' characters');
                }
            }
        }


        $result = update_review($bicycle_id); //the return result is the id of the last entry using pdo
        //then we get the userid from the session to see if there is already an existing record of their review
        $current_userid = session('user_id');
        if ($current_userid and $result) { //you have to be logged in and if the update returns id, then
            //after submitting do
//            session()->put('thankyoumessage', 'Your review has been updated successfully!');
            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]))->with('hasedited', true);
        } else {
            die("Error updating your review but is should,
                    as we have separate forms for existing and new reviews, also please make sure you are logged in
                    as we are using your username in the session created after loggin in");
        }
    })->name('item-review-update-action');

    //to add a review to the database
    function update_review($bicycle_id)
    {
        $newreviewtext = request('new-review-text');
        $newratingrange = request('new-rating-range');
        $user_id_from_session = session('user_id');
        $currentdate = date('d-m-Y');

//PART 1 WE UPDATE REVIEWS TABLE
        $updating_review = "update reviews set rating = ?, review_date= ?, review_text = ? where review_creator_id = ?";


        $executequery1 = DB::update($updating_review, array($newratingrange, $currentdate, $newreviewtext, $user_id_from_session)); //the new values
//        $executequery1 = DB::getPdo()->lastInsertId(); //get id of last entry

        if ($executequery1) {
            return $executequery1;
        } else {
            die("error entering your review on $updating_review");
        }
    }

?>
