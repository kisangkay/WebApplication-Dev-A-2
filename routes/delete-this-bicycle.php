<?php
    //NOW IMPLEMENTING TO DELETE A BICYCLE AND ALL ITS REVIEWS
    Route::post('/delete-this-bicycle/{bicycle_id}', function ($bicycle_id) {

        $result = delete_bike($bicycle_id);
        $userisloggedin = session('user_id'); //I WANT TO RESTRICT DELETING BIKE TO LOGGED IN USERS ONLY

        if ($result and $userisloggedin) {
            return redirect(route('home'))->with('itsdeleted', true); //I WILL USE THIS BOOL TO SHOW CONFIRMATION
        } else {
            die("Error deleting your bike please make sure youre logged in");
        }
    })->name('delete-this-bicycle');

    //DELETE REVIEW
    function delete_bike($bicycle_id)
    {
//STARTING WITH THE REVIEW BECUASE IT HAS A FOREIGN KEY OF THE BICYCLE DATA WERE DELETING SO WE DONT GET AN ERROR
//PART 1 WE DELETE ITS CORRESPONDING ALL REVIEWS SO IF REVIEW HAS bicycle_id_being_reviewed = $bicycle_id
//BUT THIS ROW CAN BE EMPTY SO WE HAVE TO CHECK FIRST USING COUNT

        $isthereanyreview = "select count(review_id) as itstotalreviews from reviews where bicycle_id_being_reviewed = ?";
        $isthereanyreviewquery = DB::select($isthereanyreview, array($bicycle_id));
//        dd($isthereanyreviewquery);

//SO WE ONLY REMOVE THE REVIEW IF IT EXISTS
        if ($isthereanyreviewquery[0]->itstotalreviews > 0) {
            $delete_its_reviews = "delete from reviews where bicycle_id_being_reviewed = ?";
            DB::delete($delete_its_reviews, array($bicycle_id));
        }
//REMEMBERED I ALSO HAVE REVIEW COUNT IN MANUFACTURERS AND WE NEED TO DECREMENT IT


//PART 2 NOW WE DELETE FROM BICYCLES TABLE SO ROW MATCHING BIKE IS REMOVED
        $deletebike = "delete from bicycles where bicycle_id = ?";
        DB::delete($deletebike, array($bicycle_id));


//IF DELETED ITEM AND REVIEW
        $isdeleted = true;

//A bicycle might not have any reviews
        if ($isdeleted) {
            return $isdeleted; //just to return something
        } else {
            die("Couldn't delete the bicycle record and or its reviews");
        }
    }

?>
