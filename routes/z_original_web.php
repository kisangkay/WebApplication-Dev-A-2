<?php
//
//    use Illuminate\Support\Facades\Route;
//
//    Route::get('/', function () {
//        return view('.login-signup/login');
//    })->name('login');
//
//    //i want to clear the sesstion that was put when a user logs in we use session flush
//    Route::post('/', function () {
//        session()->flush(); //clear session and logout
//        return redirect(route('login'));
//    })->name('logout_action');
//
//
////WE RETURN THE CREATE BIKE PAGE WITH A LIST OF ALL MANUFACTURERS TO PICK FROM
//    Route::get('/create-a-new-item', function () {
//
//        $result_from_query = get_all_manufacturers();
//        if ($result_from_query) {
//            return view('create-a-new-item')->with('all_manufacturers', $result_from_query);
//        }
//
//    })->name('create-a-new-item');
//
////function to get all manufacturers
//    function get_all_manufacturers()
//    {
//        $query_for_selecting = "select * from manufacturers order by manufacturer_name asc";
//        $all_manufacturers = DB::select($query_for_selecting);
//
//        return $all_manufacturers;
//
//    }
//
//
//    Route::get('/manufacturer-specific-items', function () {
//        return view('manufacturer-specific-items');
//    })->name('manufacturer-specific-items');
//
//
//    Route::get('/signup', function () {
//        return view('.login-signup/signup');
//    })->name('signup');
//
////HOME1 HOME1 HOME1 DEFAULT SORTING OF BICYCLE ID
////route to list all bicycles to home page
////BUT FIRST LOGIN SO WE DONT GET AN ERROR WHEN TRYING TO ADD/RETRIEVE REVIEW
//    Route::get('/home', function () {
//        if (!session('username')){
//            return redirect()->route('login');
//        }
////I WANT TO SHOW THE USERNAME OF WHOEVER POSTED THE BICYCLE USING THE FOREIGN KEY bicycleposterid ACROSS reviewusers table
////$items has all the ids we want to get their usernames so
//
////NOW I REVISE THE QUERY TO JOIN WITH THE REVIEWS
////I HAD TO ADD THE REVIEWS TABLE HERE BECAUSE I DIDNT HAVE A CHOICE, AS I HAVE 3 ROUTES TO RETURN THE HOME PAGE VIEW
////AND THE LAST ONE NEEDED THE ADDITIONAL REVIEWS TABLE TO GET AVG RATING SO SINCE HOME PAGE NEEDS $avg_of_ratings
////I MUST INCLUDE IT EVERYWHERE
////        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
////                                  where bicycles.bicycle_poster_user_id = review_users.user_id
////                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
////                                  group by bicycle_id";
//
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings
//        from bicycles
//        left join review_users on bicycles.bicycle_poster_user_id = review_users.user_id
//        left join reviews on bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//        group by bicycles.bicycle_id";
//
////NOW NEW ITEMS WILL BE INCLUDED EVEN IF THEY HAVE 0 REVIEWS
//
////NEW PROBLEM IM GETTING IS THAT, A NEW ITEM IS BEING HIDDEN IF IT HAS 0 REVIEWS, OF COURSE ITS JUST BEEN ADDED, SO PROBLEM
////IS IN THE OLD SCHOOL JOIN TABLES THAT OMMITS ITEMS WITH 0 REVIEWS. I WILL USE JOIN FORMAT
//
//        $items = DB::select($sql);
//
//        return view('home')->with('items', $items);
//
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('home');
//
//
//
////HOME2 HOME2 HOME2 SORTING BY TOTAL REVIEWS DESCEEEEEEEEEEEEEEEEEEEEEE
//    Route::get('/home_sort_total_Reviews_desc', function () {
//
////NOW I REVISE THE QUERY SORT BY TOTAL REVIEWS DESC
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
//                                  where bicycles.bicycle_poster_user_id = review_users.user_id
//                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//                                  group by bicycle_id
//                                  order by bicycle_total_reviews desc ";
//
//        $sorted_by_total_reviews = DB::select($sql);
//        return view('home')->with('items', $sorted_by_total_reviews);
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('home_sort_total_Reviews_desc');
//
//
////HOME3 HOME3 HOME3 SORT BY TOP AVERAGE RATING DESCEEEEEEEEEEEEEEEEEEEEEE
//    Route::get('/home_sort_top_Reviews_desc', function () {
//
////NOW I REVISE THE QUERY SORT BY TOP AVG BIKE RATING
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users, reviews
//                                  where bicycles.bicycle_poster_user_id = review_users.user_id
//                                  and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//                                   group by bicycles.bicycle_id
//                                   order by avg_of_ratings desc";
//
//
//        $sorted_by_top_rating = DB::select($sql);
////        @dd($sorted_by_top_rating);
//        return view('home')->with('items', $sorted_by_top_rating);
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('home_sort_top_Reviews_desc');
//
//
////HOME2 HOME2 HOME2 SORTING BY TOTAL REVIEWS AAAAAAAAAAAAAAASCCEEEEEEEEEEEEEEEEEEEEEE
//    Route::get('/home_sort_total_Reviews_asc', function () {
//
////NOW I REVISE THE QUERY SORT BY TOTAL REVIEWS DESC
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
//                                  where bicycles.bicycle_poster_user_id = review_users.user_id
//                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//                                  group by bicycle_id
//                                  order by bicycle_total_reviews asc ";
//
//        $sorted_by_total_reviews = DB::select($sql);
//        return view('home')->with('items', $sorted_by_total_reviews);
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('home_sort_total_Reviews_asc');
//
//
////HOME3 HOME3 HOME3 SORT BY TOP AVERAGE RATING AAAAAAAAAAAAAAASCCEEEEEEEEEEEEEEEEEEEEEE
//    Route::get('/home_sort_top_Reviews_asc', function () {
//
////NOW I REVISE THE QUERY SORT BY TOP AVG BIKE RATING
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users, reviews
//                                  where bicycles.bicycle_poster_user_id = review_users.user_id
//                                  and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//                                   group by bicycles.bicycle_id
//                                   order by avg_of_ratings asc";
//
//
//        $sorted_by_top_rating = DB::select($sql);
////        @dd($sorted_by_top_rating);
//        return view('home')->with('items', $sorted_by_top_rating);
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('home_sort_top_Reviews_asc');
//
//
//
//
//
//
//
//
//
//
////ITEM REVIEW PAGE ROUTE 1 my route to POPULATE review page with the item and reviews matching that bicycleid
//    Route::get('/item-review-page/{bicycle_id}', function ($bicycle_id) {
//
//        //to check if user already has another review
//        $currentuserid = session('user_id');
////        dd($currentuserid);
//        $sql = "select * from reviews, review_users where reviews.review_creator_id = ?
//                                  and reviews.bicycle_id_being_reviewed = ? ";
//        $leetsexecute = DB::select($sql, array($currentuserid, $bicycle_id));
//
////LETS ALSO GET THE IMAGE PATH FROM THE DATABASE
//        $GETIMAGEPATH= "select bicycle_image from bicycles where bicycle_id = ?";
//        $foundbikeimagepath = DB::select($GETIMAGEPATH, array($bicycle_id));
//
////TO SHOW MANUFACTURER NAME TOO I NEED TO JOIN BICYCLE ID AND MANUFACTURER TABLE TO SHOW BIKE IMAGE AND MANUF NAME OH I DID THAT IN THE get_bicycle function
//
//        if ($leetsexecute and $foundbikeimagepath) { //if we get any matching result , then it means yes
//            //so we return all found items and reviews once again, but we also
//            // include the result of $foundbikeimagepath to check if its not empty then we do
////USER HAS A REVIEW FOR THE BIKE
//            $itemfound = get_bicycle_and_manufacturer_name($bicycle_id);
//            $reviewsfound = get_allreviews($bicycle_id);
//            $reviewtextforloggedusertoedit = get_specificreviews($bicycle_id, $currentuserid); //getting current user's review to only edit it
//            $hasedited = false;
//
////using return view and with, it passes data directly to the view. accessible as a variable. not session
////so tasked to find out how sessions work, i learned about put and flush and using redirect method+with to store data in session
//
//            return view('item-review-page')
//                ->with('items', $itemfound)
//                ->with('reviewtext_for_you', $reviewtextforloggedusertoedit)
//                ->with('reviews', $reviewsfound)
//                ->with('hasareview', $leetsexecute)
//                ->with('hasedited', $hasedited)
//                ->with('bikeimagepath', $foundbikeimagepath);
//
//            //if we find a record, then we disable the submit button
//        } else {
////USER HAS NO REVIEW FOR THE BIKE STILL POPULATE THE PAGE BUT DIFFERENCE IS PASSING HASREVIEWS WHICH IS NOW FALSE AND IN THAT PAGE WE HAVE IF STMT FOR THAT
//            $itemfound = get_bicycle_and_manufacturer_name($bicycle_id);
//            $reviewsfound = get_allreviews($bicycle_id);
//            return view('item-review-page') //return the view with both the selected bicycle and ALL its found reviews
//            ->with('items', $itemfound)
//                ->with('reviews', $reviewsfound)
//                ->with('hasareview', $leetsexecute)
//                ->with('bikeimagepath', $foundbikeimagepath);
//
////I FORGOT TO ALSO ADD THE NEW IMAGEPATH IF USER HAS NOT EXISTING REVIEW, FAILED TO NOTICE THIS AND WAS STUCK FOR HOURS
//
//        }//closing the if statement
//    })->name('item-review-page/{bicycle_id}');
//
////is outside route can be reused
//
////TO SHOW MANUFACTURER NAME TOO I NEED TO JOIN BICYCLE ID AND MANUFACTURER TABLE TO SHOW BIKE IMAGE AND MANUF NAME
////SINCE I REMEMBER REUSING THIS FUNCTION SOMEWHERE ILL RECREATE A SECOND ONE
//    function get_bicycle($bicycle_id)
//    {
//        $sql = "select * from bicycles where bicycle_id = ?"; //? for sanitization
//        $items = DB::select($sql, array($bicycle_id));
//        if (count($items) != 1) {
//            die("error while fetching item result from query $sql");
//        } else {
//            $itemfound = $items;
//            return $itemfound;
//        }
//    }
//
//// AGAIN TO SHOW MANUFACTURER NAME TOO I NEED TO JOIN BICYCLE ID AND MANUFACTURER TABLE TO SHOW BIKE IMAGE AND MANUF NAME
//    function get_bicycle_and_manufacturer_name($bicycle_id)
//    {
////        $sql1 = "select * from bicycles where bicycle_id = ?";
//        $all_bicycledata_and_its_manufacturername = "select bicycles.* , manufacturers.manufacturer_name
//         FROM bicycles, manufacturers where bicycles.bicycle_manufacturer_ID = manufacturers.manufacturer_id
//                                        and bicycles.bicycle_id = ?";
//
//        $items = DB::select($all_bicycledata_and_its_manufacturername, array($bicycle_id));
//        if (count($items) != 1) {
//            die("error while fetching item result from query $sql");
//        } else {
//            $itemfound = $items;
//            return $itemfound;
//        }
//    }
//
////function to return all reviews for a selected item itemid==specific
//    function get_allreviews($bicycle_id)
//    {
//        $sql = "select * from reviews, review_users where review_users.user_id =
//         reviews.review_creator_id and reviews.bicycle_id_being_reviewed = ?"; //? for sanitization
//        $items = DB::select($sql, array($bicycle_id));
//
//        $itemfound = $items;
//        return $itemfound;
//    }
//
////GET REVIEW FOR THIS ONE LOGGED IN USERRRRRRRRRRR
//    $current_user_id = session('user_id');
//    function get_specificreviews($bicycle_id, $current_user_id)
//    {
//        $sql = "select * from reviews, review_users where review_users.user_id =
//         reviews.review_creator_id and reviews.bicycle_id_being_reviewed = ? and review_users.user_id = ?";
//        $items = DB::select($sql, array($bicycle_id, $current_user_id));
//
//        $itemfound = $items;
//        return $itemfound;
//    }
//
////SIGNUP to add a user to the database
//    Route::post('/signup_action', function () {
//        $user_name = request('username');
//
////MY INPUT VALIDATION FOR SIGNUP USERNAMEEEEEEEEEEEEEEEEEEEE
//        if (!$user_name){ //Empty, <2 in length or 0 value
//            return redirect()->route('signup')->with('validationerror','PLease provide a username!');
//        }
//        elseif (strlen($user_name)<2 || strlen($user_name)>9){
//            return redirect()->route('signup')->with('validationerror','Please use a username between 3 to 9 characters!');
//        }
//        //To check for these illegal chars
//        elseif ($user_name){
//            $illegal_chars = "-_+\"'";
//
//            $user_name_characters = str_split($user_name); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character){ //check if each char matches the defined
//                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
//                    return redirect()->route('signup')->with('validationerror','Username cant contain any of: - _ + " \'');
//                }
//            }
//        }
//
////AFTER INPUT VALIDATION, WE FILTER OUT ODD NUMBERS
//        //location of usernamefilter function
//        include "defs/defs.php";
//        $filtereduser_name = filterodds($user_name);
////        dd($filtereduser_name);
//
//
//
//        $usernamefound = add_user($user_name);
//        if ($usernamefound) {
//            //making use of session to store a sessage and return view
////            return view(".login-signup/login")->with('lastentry', "signed up, please log in and $id_of_last_entry");
//            //switched from using a view to route as session message was not being displayed
//            //SO THEN WE RETURN THE LOGIN ROUTE AND WE PASS THE USERNAME THROUGH A VARIABLE
//            return redirect(route('login'))->with('lastentry', "signed up, please log with your username $usernamefound");
//        } else {
//            die("Record not entered problem encountered");
//        }
//    })->name('signup_action');
//
//    function add_user($user_name)
//    {
//        $sql = "insert into review_users (username) values  (?)"; //? acts as a placeholder for sanitization to replace with variable
//
//        $doesusernameexist = "select * from review_users where username = ?";
//        $gotten = DB::select($doesusernameexist, array($user_name));
//
//        if (!$gotten) { //if no matching username found, we add the user into db and send user to login and show their entered name
//            DB::insert($sql, array($user_name));
//            $id_of_last_entry = DB::getPdo()->lastInsertId();
//            //i am trying to retrieve entered username using the above found user id
//            $usernamefound = DB::select("select username from review_users where user_id =? ", array($id_of_last_entry));
//            //for sanitization here i use =? which is a placeholder, and the array replaces the placeholder in execution
//            //this placeholder is useful in event that we want to pass multiple values like
//            // where id = ? and name = ?    array($id, $name)
//
//            return $usernamefound[0]->username;
//        }
//        else{
//            die("Existing username please use different one");
//        }
//
//    }
//
//
////LOGIN ROUTE TO SEND YOU TO HOME PAGE IF YOU EXIST IN DB
//    Route::post('/checkifusername_exists_action', function () {
//        $user_name = request('username');
//
////        dd($user_name);
////VALIDATIONNNNNNNNNN LOGIN
//        if (!$user_name){ //Empty, <2 in length or 0 value
//            return redirect()->route('signup')->with('validationerror','PLease provide a username!');
//        }
//        elseif (strlen($user_name)<2 || strlen($user_name)>9){
//            return redirect()->route('signup')->with('validationerror','Please use a username between 3 to 9 characters!');
//        }
//        //To check for these illegal chars
//        elseif ($user_name){
//            $illegal_chars = "-_+\"'";
//            $user_name_characters = str_split($user_name); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character){ //check if each char matches the defined
//                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
//                    return redirect()->route('login')->with('validationerror','Username cant contain any of: - _ + " \'');
//                }
//            }
//        }
//
////IF USERNAMEFOUND TO LOGGGGGGGGGIN
//        $usernamefound = get_username($user_name);
//        if ($usernamefound) {
//            //making use of session to search a username and return it
//            session()->put('username', $usernamefound->username);
//            session()->put('user_id', $usernamefound->user_id);
//            return redirect(route('home'));
//            //i want to display the username on the nav bar which only shows if url is not login or signup
//        } else {
//            // i want to display a no matching username if we dont find such a username back to the login page
//            session()->flush();
//            return redirect(route('login'))->with('loginerrormessage', 'no matching username found, please check username');
//        }
//    })->name('checkifusername_exists_action'); //the name of my route as reflects in the html section
//
//    function get_username($user_name)
//    {
//        $sql = "select * from review_users where username = ?";
//        $usernamefound = DB::select($sql, array($user_name));
//
//        if ($usernamefound) {
//            return $usernamefound[0];
//        }
//    }
//
//
////USER POST REVIEW ITEM REVIEW PAGE ROUTE 2
//    //to add a user review, we take the text from the form, and rating out of 5
//    //i had to use the same route name as in the template so as i will be redirected to the same pag
//    //while making use of the {} placeholder to reload to the same item id page as the review was submitted for the bike
//    Route::post('/item-review-page/{bicycle_id}', function ($bicycle_id) {
//
//
//        //we still use the placeholder {bicycle_id} in the url to pass the id again as an associative array in the return
//        $reviewtext = request('review-text');
//        $ratingrange = request('rating-range');
//
////POST REVIEW INPUT VALIDATIONNNNNNNNNNNNNNNNNN
//        if (!$reviewtext){ //Empty, <2 in length or 0 value
//            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror','PLease provide a review!');
//        }
//        elseif (strlen($reviewtext)<5 || strlen($reviewtext)>800){
//            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror','Please leave a review between 2 and 150 words');
//        }
//        //To check for these illegal chars
//        elseif ($reviewtext){
//            $illegal_chars = "-_+\"'";
//
//            $user_name_characters = str_split($reviewtext); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character){ //check if each char matches the defined
//                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
//                    return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])
//                        ->with('validationerror','Your review cant contain any of these: - _ + " \' characters');
//                }
//            }
//        }
//
//        $result = add_review($bicycle_id); //the return result is the id of the last entry using pdo
//        //then we get the userid from the session to see if there is already an existing record of their review
//        $current_userid = session('user_id');
//        if ($current_userid and $result) {
//            //after submitting
//            session()->put('thankyoumessage', 'Thank you for leaving your review!');
//            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]));
//
//        } else {
//            die("Error submitting your review but is should,
//                    given submit button was disabled if review already made, also please make sure you are logged in");
//        }
//
//    })->name('item-review-page');
//
//
////to add a review to the database
//    function add_review($bicycle_id)
//    {
//        $reviewtext = request('review-text');
//        $ratingrange = request('rating-range');
//        $user_id_from_session = session('user_id');
//        $currentdate = date('d-m-Y');
//
////        $sql = "insert into reviews, review_users, bicycles
//
////PART 1 WE INSERT REVIEWS TABLE
////JUST ADDED MANUFACTURER ID FOREIGN KEY TO LINK MANUF TABLE AND REVIEWS TABLE, SO
////FIRST WE GET THE MANUF ID OF THE SELECTED BIKE
//        $get_manuf_id_of_this_bike = "select bicycles.bicycle_manufacturer_ID from bicycles
//                                        where bicycle_id = ?";
//        $getmanufid= DB::select($get_manuf_id_of_this_bike, array($bicycle_id));
//        $specific_manuf_id = $getmanufid[0]->bicycle_manufacturer_ID;
////        @dd($specific_manuf_id);
//
////FIXED AFTER ADDING A NEW COLUMN TO REVIEWS TABLE NOW CHECKING UPDATE RRVIEW ROUTE
//        $addareview = "insert into reviews (review_creator_id, rating, review_date, review_text, bicycle_id_being_reviewed,manuf_id_of_bicycle_being_reviewed)
//values (?,?,?,?,?,?)";
//        DB::insert($addareview, array($user_id_from_session, $ratingrange, $currentdate, $reviewtext, $bicycle_id, $specific_manuf_id)); //insert values
//        $executequery1 = DB::getPdo()->lastInsertId(); //get id of last entry
//
////PART 2 WE INSERT USERS TABLE +1 to total reviews
////        $addusertotalreviews = "update review_users set total_reviews = total_reviews+1 where user_id = ?";
////        DB::update($addusertotalreviews, array($user_id_from_session));
//
////PART 3 WE INSERT BICYCLES TABLE +1 to total reviews
//        $addtotalbikereviews = "update bicycles set bicycle_total_reviews = bicycle_total_reviews+1 where bicycle_id = ?";
//        DB::update($addtotalbikereviews, array($bicycle_id));
//
////to get manufacturerid we use bicycleid to select
//        $getmanufacturerid = "select bicycle_manufacturer_ID from bicycles
//           where bicycle_id = ?";
//        $found_manuf_id = DB::select($getmanufacturerid, array($bicycle_id));
//        $specificmanufid = $found_manuf_id[0]->bicycle_manufacturer_ID; //not to find its specific integer of ID we access
//        //it by using an associative array.
////        dd($specificmanufid);
////
//
////PART 4 WE INSERT MANUFACTURERS TABLE +1 to total reviews
//        //HERE I REUSE THE GET_BICYCLE FUNCTION TO GET THE BICYCLE MANUFACTURER ID FROM THE TABLE BICYCLES
//        $gettingbikemanufid = get_bicycle($bicycle_id);
//        $bikemanufid = $gettingbikemanufid[0]->bicycle_manufacturer_ID;
////SO I USE THE BIKEMANUFID FOREIGN KEY FROM THE REUSED FUNCTION ABOVE
//        $updatemanuftotalreviews = "update manufacturers set
//             manufacturer_total_reviews = manufacturer_total_reviews +1 where manufacturer_id = ?";
//        DB::update($updatemanuftotalreviews, array($bikemanufid));
//
//
//        if ($executequery1) {
//            return $executequery1;
//        } else {
//            die("error entering your review on $updatemanuftotalreviews");
//        }
//    }
//
//// USER EDITING THEIR REVIEW
//    Route::post('/item-review-update-action/{bicycle_id}', function ($bicycle_id) {
//
//        //we still use the placeholder {bicycle_id} in the url to pass the id again as an associative array in the return
//        $newreviewtext = request('new-review-text');
//        $newratingrange = request('new-rating-range');
//
////EDIT REVIEW INPUT VALIDATIONNNNNNNNNNNNNNNNNN
//        if (!$newreviewtext){ //Empty, <2 in length or 0 value
//            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror','PLease provide a review!');
//        }
//        elseif (strlen($newreviewtext)<5 || strlen($newreviewtext)>800){
//            return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])->with('validationerror','Please leave a review between 2 and 150 words');
//        }
//        //To check for these illegal chars
//        elseif ($newreviewtext){
//            $illegal_chars = "-_+\"'";
//
//            $user_name_characters = str_split($newreviewtext); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character){ //check if each char matches the defined
//                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
//                    return redirect()->route('item-review-page', ['bicycle_id' => $bicycle_id])
//                        ->with('validationerror','Your review cant contain any of these: - _ + " \' characters');
//                }
//            }
//        }
//
//
//
//        $result = update_review($bicycle_id); //the return result is the id of the last entry using pdo
//        //then we get the userid from the session to see if there is already an existing record of their review
//        $current_userid = session('user_id');
//        if ($current_userid and $result) { //you have to be logged in and if the update returns id, then
//            //after submitting do
////            session()->put('thankyoumessage', 'Your review has been updated successfully!');
//            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]))->with('hasedited', true);
//        } else {
//            die("Error updating your review but is should,
//                    as we have separate forms for existing and new reviews, also please make sure you are logged in
//                    as we are using your username in the session created after loggin in");
//        }
//    })->name('item-review-update-action');
//
////to add a review to the database
//    function update_review($bicycle_id)
//    {
//        $newreviewtext = request('new-review-text');
//        $newratingrange = request('new-rating-range');
//        $user_id_from_session = session('user_id');
//        $currentdate = date('d-m-Y');
//
////PART 1 WE UPDATE REVIEWS TABLE
//        $updating_review = "update reviews set rating = ?, review_date= ?, review_text = ? where review_creator_id = ?";
//
//
//        $executequery1 = DB::update($updating_review, array($newratingrange, $currentdate, $newreviewtext, $user_id_from_session)); //the new values
////        $executequery1 = DB::getPdo()->lastInsertId(); //get id of last entry
//
//        if ($executequery1) {
//            return $executequery1;
//        } else {
//            die("error entering your review on $updating_review");
//        }
//    }
//
//
//// USER DELETING THEIR REVIEW
//    Route::post('/delete-review/{bicycle_id}', function ($bicycle_id) {
//
//        $result = delete_review($bicycle_id);
//        $current_userid = session('user_id');
//        if ($current_userid and $result) { //you have to be logged in and if the update returns id, then
//            //after submitting do
////            session()->put('thankyoumessage', 'Your review has been deleted!');
//            return redirect(route('item-review-page', ['bicycle_id' => $bicycle_id]))->with('reviewdeleted' ,true);
//
//        } else {
//            die("Error deleting your review please make sure you are logged in");
//        }
//    })->name('delete-review');
//
////DELETE REVIEW
//    function delete_review($bicycle_id)
//    {
//        $user_id_from_session = session('user_id');
//        //we have: current userid, current bicycleid
////to get manufacturerid we use bicycleid to select
//        $getmanufacturerid = "select bicycle_manufacturer_ID from bicycles
//           where bicycle_id = ?";
//        $found_manuf_id = DB::select($getmanufacturerid, array($bicycle_id));
//        $specificmanufod = $found_manuf_id[0]->bicycle_manufacturer_ID; //point to the column name
//
////PART 1 WE DELETE FROM REVIEWS TABLE
//        $deletereview = "delete from reviews where review_creator_id = ? and bicycle_id_being_reviewed = ?";
//        DB::delete($deletereview, array($user_id_from_session, $bicycle_id));
//
////PART 1 WE MINUS 1 and THE TOTAL sum OF REVIEWS FOR A USER AND A BICYCLE AND MANUFACTURER
//
////        $update_users = "update review_users set total_reviews = total_reviews -1 where user_id = ?";
//        $update_bicycles = "update bicycles set bicycle_total_reviews = bicycle_total_reviews -1 where bicycle_id = ?";
//        $update_manufacturers = "update manufacturers set manufacturer_total_reviews = manufacturer_total_reviews -1 where manufacturer_id = ?";
//
////        DB::update($update_users, array($user_id_from_session));
//        DB::update($update_bicycles, array($bicycle_id));
//
////AGAIN WE REUSE THE BICYCLE FUNCTION TO GET THE MANUFCATURER ID OF THIS SPECICIC BIKE TO -1 ON TOTAL REVIEWS
//        $gettingbikemanufid = get_bicycle($bicycle_id);
//        $bikemanufid = $gettingbikemanufid[0]->bicycle_manufacturer_ID;
////SO I USE THE BIKEMANUFID FOREIGN KEY FROM THE REUSED FUNCTION ABOVE
//        DB::update($update_manufacturers, array($bikemanufid));
//
//        if ($getmanufacturerid) {
//            return $getmanufacturerid; //just to return something
//        }
//    }
//
////HERE WE BEGIN THE IMPLEMENTATION OF ADDING NEW BICYCLES THAT WILL SHOW ON THE HOME PAGE
////USER POST REVIEW ITEM REVIEW PAGE ROUTE 2
//
//    Route::post('/create-new-bicycle', function () {
//
//        $result = add_bicycle(); //if the functionnreturns anything we store it in result. im using it as a checker
//
////check if you are logged in so that we dont get an error when posting your user id
//        $current_userid = session('user_id');
//
//        //lets get its values from the the template
//        $bicycle_name = request('bicycle_name');
//        $bicycle_description = request('bike_description');
//        $selected_manufacturer_id = request('manufacturerid');
//        $bike_image = request()->file('bike_image');
//
////NEW BICYCLE CREATION VALIDATIONNNNNNNNNNNNNNNNNN
//        if (!$bicycle_name || !$bicycle_description){
//            //Empty, <2 in length or 0 value
//            return redirect()->route('create-a-new-item')->with('validationerror','PLease provide a Bicycle name and description');
//        }
//        if (!$bike_image){
//            return redirect()->route('create-a-new-item')->with('validationerror','please select an image');
//        }
//        if (!$selected_manufacturer_id){
//            return redirect()->route('create-a-new-item')->with('validationerror','please select an manufacturer');
//        }
//
//        elseif (strlen($bicycle_name)<5){
//            return redirect()->route('create-a-new-item')->with('validationerror','Bicycle name should have minimum of 5 characters');
//        }
//        elseif (strlen($bicycle_description)<5 || strlen($bicycle_name)>800){
//            return redirect()->route('create-a-new-item')->with('validationerror','Please leave a review between 2 and 150 words');
//        }
//        //To check for these illegal chars
//        elseif ($bicycle_name || $bicycle_description){
//            $illegal_chars = "-_+\"'";
//
//            $user_name_characters = str_split($bicycle_name || $bicycle_description); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character){ //check if each char matches the defined
//                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
//                    return redirect()->route('create-a-new-item')
//                        ->with('validationerror','Your bicycle name or its \' description cant contain any of these: - _ + " \' characters');
//                }
//            }
//        }
//
//
//        if ($current_userid and $result) {
////after submitting i will add a (with->and pass to session to show bike added to home page) (its going to session as we are using redirect+with)
//            return redirect(route('home',))->with('itisposted', true);
//
//        } else {
//            die("posting your bicycle");
//        }
//
//    })->name('create-new-bicycle');//name of this route so can be accessible by using route('itsname')
//
//
////to add a bike to the database
//    function add_bicycle()
//    {
//        $bicycle_name = request('bicycle_name');
//        $bicycle_description = request('bike_description');
//        $selected_manufacturer_id = request('manufacturerid');
//        $bike_image = request()->file('bike_image');
//
////THIS FUNCTION ALSO ADDS THE PATH OF THE IMAGE AS PREFIX AND THEN IN THE DB THE PATH WILL SHOW
//        $bike_image_to_upload = $bike_image->store('images', 'public');
////@dd($bike_image_to_upload); //WOULD SHOW THE IMAGE NAME, AND TYPE
////HAD TO INCLUDE SYMBOLIC LINK TO LINK THE STORAGE/IMAGES TO THE PUBLIC FOLDER
//
//
//        $bicycle_poster_id_from_session = session('user_id');
//        $currentdate = date('d-m-Y');
//
////        $sql = "insert into reviews, review_users, bicycles
//
////PART 1 WE INSERT TO BICYCLES TABLE
//        $addbike = "insert into bicycles (bicycle_name, bicycle_manufacturer_ID, bicycle_image, bicycle_description,
//                      bicycle_total_reviews,bicycle_poster_user_id, bicycle_date_posted)
//values (?,?,?,?,?,?,?)";
//
////insert values
//        DB::insert($addbike, array($bicycle_name, $selected_manufacturer_id, $bike_image_to_upload, $bicycle_description,
//            0, $bicycle_poster_id_from_session, $currentdate));
//
//        $getidoflastentry = DB::getPdo()->lastInsertId(); //get id of last entry
//
////SOMETHING TO RETURN TRUE AS NOT EMPTY
//        if ($getidoflastentry) {
//            return $getidoflastentry;
//        } else {
//            die("error entering your review on $getidoflastentry");
//        }
//    }
//
//
//
//
//
//
//
////NOW IMPLEMENTING TO DELETE A BICYCLE AND ALL ITS REVIEWS
//    Route::post('/delete-this-bicycle/{bicycle_id}', function ($bicycle_id) {
//
//        $result = delete_bike($bicycle_id);
//        $userisloggedin = session('user_id'); //I WANT TO RESTRICT DELETING BIKE TO LOGGED IN USERS ONLY
//
//        if ($result and $userisloggedin) {
//            return redirect(route('home'))->with('itsdeleted', true); //I WILL USE THIS BOOL TO SHOW CONFIRMATION
//        } else {
//            die("Error deleting your bike please make sure youre logged in");
//        }
//    })->name('delete-this-bicycle');
//
////DELETE REVIEW
//    function delete_bike($bicycle_id)
//    {
////STARTING WITH THE REVIEW BECUASE IT HAS A FOREIGN KEY OF THE BICYCLE DATA WERE DELETING SO WE DONT GET AN ERROR
////PART 1 WE DELETE ITS CORRESPONDING ALL REVIEWS SO IF REVIEW HAS bicycle_id_being_reviewed = $bicycle_id
////BUT THIS ROW CAN BE EMPTY SO WE HAVE TO CHECK FIRST USING COUNT
//
//        $isthereanyreview = "select count(review_id) as itstotalreviews from reviews where bicycle_id_being_reviewed = ?";
//        $isthereanyreviewquery = DB::select($isthereanyreview, array($bicycle_id));
////        dd($isthereanyreviewquery);
//
////SO WE ONLY REMOVE THE REVIEW IF IT EXISTS
//        if ($isthereanyreviewquery[0]-> itstotalreviews >0){
//            $delete_its_reviews = "delete from reviews where bicycle_id_being_reviewed = ?";
//            DB::delete($delete_its_reviews, array($bicycle_id));
//        }
////REMEMBERED I ALSO HAVE REVIEW COUNT IN MANUFACTURERS AND WE NEED TO DECREMENT IT
//
//
////PART 2 NOW WE DELETE FROM BICYCLES TABLE SO ROW MATCHING BIKE IS REMOVED
//        $deletebike = "delete from bicycles where bicycle_id = ?";
//        DB::delete($deletebike, array($bicycle_id));
//
//
////IF DELETED ITEM AND REVIEW
//        $isdeleted=true;
//
////A bicycle might not have any reviews
//        if ($isdeleted) {
//            return $isdeleted; //just to return something
//        }
//        else{
//            die("Couldn't delete the bicycle record and or its reviews");
//        }
//    }
//
//
//
////NOW ONTO MANUFACTURERS 1
////route to list all MANUFCATURERES to manuf page
//    Route::get('all-manufacturers', function () {
////UpDATED QUERY TO ALSO GET COUNT OF ALL BICYCLES MATCHING THE SAME MANUFACTURERid
//
////COUNT HAPPENS TO THE NUMBER OF ROW ELEMENTS INSIDE A GROUP
//
//        $allmanuf_rating = "select manufacturers.*, sum(reviews.rating) as sumofratings, avg(reviews.rating) as average
//        from manufacturers, reviews
//        where manufacturers.manufacturer_id = reviews.manuf_id_of_bicycle_being_reviewed
//
//        group by manufacturers.manufacturer_id order by manufacturer_name";
//
//
////THIS IS JUST TO DISPLAY THE TOTAL NO OF MANUFS IN ALL M PAGE
//        $sql2="select count(manufacturers.manufacturer_id) as countofmanufacturers from manufacturers";
//        $sql2query=DB::select($sql2);
//
////HERE, WE COUNT ALL THE BICYCLES USING THEIR UNIQUE ID WHICH IS bicycle_id, BUT THAT'S AFTER MERGING THE 2 TABLES USING ,
////AND THAT MERGE GIVES US ONE TABLE OF VERY LONG ROWS WHICH HAVE NOW BEEN EXTENDED AND JOINED USING THE SAME
////MATCHING PRIMARY AND FOREIGN KEYS, THEN WE GROUP THE ROWS BY THE MANUFACTURER ID, WHICH ARE ONLY 5 SO THE
//// TEMPLATE WILL SHOW ONLY 5 ITEMS IN THE PAGE ALL MANUFACTURERS WHICH IS WHAT WE WANT, AND THEN WE SHOW THE 'ALLBIKES'
////WHICH NOW CONTAINS THE SUM OF ALL BIKES FROM THE 5 SPECIFIC GROUPS.
//
//        $allmanufacturers = DB::select($allmanuf_rating);
//
////NOW I WANT TO RETURN THE AVERAGE RATING FOR A MANUFACTURER, avg=sum of ratings for a manuf /totalreviews(already stored in db)
////JUST ADDED A NEW COLUMN TO REVIEWS TABLE TO JOIN THE REVIEWS AND MANUF TABLES
//
////        $tofindthe_sum_of_a_manufacturers_rating="select reviews.*, sum(reviews.rating) as sumofratings, manufacturers.* from reviews, manufacturers
////                                  where reviews.manuf_id_of_bicycle_being_reviewed = manufacturers.manufacturer_id
////                                  group by manufacturers.manufacturer_id";
////
////        $sumoftheratingsofeachmanufacturergrouped = DB::select($tofindthe_sum_of_a_manufacturers_rating);
//
//        return view('all-manufacturers')
//            ->with('totalmanufs', $sql2query)
//            ->with('allmanufacturers', $allmanufacturers);
//        // then we pass data from this route to the view
//        //the db data stored in $items variable is then accessed from view using the variable name 'items'
//        //so its different from a session since its not stored across views
//    })->name('all-manufacturers');
//
//
//
////NOW ONTO MANUFACTURERS 2
////ROUTE TO REDIRECT TO MANUFATURER SPECIFIC PAGE
//    Route::get('to_manufacturer_specific_page_action/{manufacturer_id}/{manufacturer_name}', function ($manufacturer_id, $manufacturer_name) {
//
//        $getbicycles_from_manufacturer = "select bicycles.*, manufacturers.* from bicycles, manufacturers
//                                                   where manufacturers.manufacturer_id = bicycles.bicycle_manufacturer_ID
//                                                   and manufacturers.manufacturer_id = ?";
//
//        $list_by_manufacturer = DB::select($getbicycles_from_manufacturer, array($manufacturer_id));
//
//
//
//        return view('manufacturer-specific-items') //RETURNS THIS PAGE BUT RETAINS ITS ROUTE NAME IN URL
//        ->with('fromthismanufacturer', $list_by_manufacturer)
//            ->with('themanuf_name', $manufacturer_name);
//    })->name('to_manufacturer_specific_page_action');
