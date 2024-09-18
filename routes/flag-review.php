<?php
    // USER EDITING THEIR REVIEW
    Route::post('/flag-review/{review_id}', function ($review_id) {

        $isflagged = update_flagcount($review_id);

        session()->put('flag', $review_id);

        return redirect()->back();

    })->name('flag-review');

    //to add a review to the database
    function update_flagcount($review_id)
    {

//PART 1 WE UPDATE REVIEWS TABLE
        $updating_review_flags = "update reviews set flags = flags + 1 where review_id = ?";


        $executequery1 = DB::update($updating_review_flags, array($review_id)); //the new values

        if ($executequery1) {
            return $executequery1;
        } else {
            die("error entering your review on $executequery1");
        }
    }

?>
