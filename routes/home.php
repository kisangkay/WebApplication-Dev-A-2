<?php

//HOME1 HOME1 HOME1 DEFAULT SORTING OF BICYCLE ID
//route to list all bicycles to home page
//BUT FIRST LOGIN SO WE DONT GET AN ERROR WHEN TRYING TO ADD/RETRIEVE REVIEW
    Route::get('/home', function () {
        if (!session('username')){
            return redirect()->route('login');
        }
//I WANT TO SHOW THE USERNAME OF WHOEVER POSTED THE BICYCLE USING THE FOREIGN KEY bicycleposterid ACROSS reviewusers table
//$items has all the ids we want to get their usernames so

//NOW I REVISE THE QUERY TO JOIN WITH THE REVIEWS
//I HAD TO ADD THE REVIEWS TABLE HERE BECAUSE I DIDNT HAVE A CHOICE, AS I HAVE 3 ROUTES TO RETURN THE HOME PAGE VIEW
//AND THE LAST ONE NEEDED THE ADDITIONAL REVIEWS TABLE TO GET AVG RATING SO SINCE HOME PAGE NEEDS $avg_of_ratings
//I MUST INCLUDE IT EVERYWHERE
//        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
//                                  where bicycles.bicycle_poster_user_id = review_users.user_id
//                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
//                                  group by bicycle_id";

        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings
        from bicycles
        left join review_users on bicycles.bicycle_poster_user_id = review_users.user_id
        left join reviews on bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
        group by bicycles.bicycle_id";

//NOW NEW ITEMS WILL BE INCLUDED EVEN IF THEY HAVE 0 REVIEWS

//NEW PROBLEM IM GETTING IS THAT, A NEW ITEM IS BEING HIDDEN IF IT HAS 0 REVIEWS, OF COURSE ITS JUST BEEN ADDED, SO PROBLEM
//IS IN THE OLD SCHOOL JOIN TABLES THAT OMMITS ITEMS WITH 0 REVIEWS. I WILL USE JOIN FORMAT

        $items = DB::select($sql);

        return view('home')->with('items', $items);

        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('home');



//HOME2 HOME2 HOME2 SORTING BY TOTAL REVIEWS DESCEEEEEEEEEEEEEEEEEEEEEE
    Route::get('/home_sort_total_Reviews_desc', function () {

//NOW I REVISE THE QUERY SORT BY TOTAL REVIEWS DESC
        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
                                  where bicycles.bicycle_poster_user_id = review_users.user_id
                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
                                  group by bicycle_id
                                  order by bicycle_total_reviews desc ";

        $sorted_by_total_reviews = DB::select($sql);
        return view('home')->with('items', $sorted_by_total_reviews);
        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('home_sort_total_Reviews_desc');


//HOME3 HOME3 HOME3 SORT BY TOP AVERAGE RATING DESCEEEEEEEEEEEEEEEEEEEEEE
    Route::get('/home_sort_top_Reviews_desc', function () {

//NOW I REVISE THE QUERY SORT BY TOP AVG BIKE RATING
        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users, reviews
                                  where bicycles.bicycle_poster_user_id = review_users.user_id
                                  and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
                                   group by bicycles.bicycle_id
                                   order by avg_of_ratings desc";


        $sorted_by_top_rating = DB::select($sql);
//        @dd($sorted_by_top_rating);
        return view('home')->with('items', $sorted_by_top_rating);
        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('home_sort_top_Reviews_desc');


//HOME2 HOME2 HOME2 SORTING BY TOTAL REVIEWS AAAAAAAAAAAAAAASCCEEEEEEEEEEEEEEEEEEEEEE
    Route::get('/home_sort_total_Reviews_asc', function () {

//NOW I REVISE THE QUERY SORT BY TOTAL REVIEWS DESC
        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users,reviews
                                  where bicycles.bicycle_poster_user_id = review_users.user_id
                                   and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
                                  group by bicycle_id
                                  order by bicycle_total_reviews asc ";

        $sorted_by_total_reviews = DB::select($sql);
        return view('home')->with('items', $sorted_by_total_reviews);
        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('home_sort_total_Reviews_asc');


//HOME3 HOME3 HOME3 SORT BY TOP AVERAGE RATING AAAAAAAAAAAAAAASCCEEEEEEEEEEEEEEEEEEEEEE
    Route::get('/home_sort_top_Reviews_asc', function () {

//NOW I REVISE THE QUERY SORT BY TOP AVG BIKE RATING
        $sql = "select bicycles.*, review_users.username, avg(reviews.rating) as avg_of_ratings from bicycles, review_users, reviews
                                  where bicycles.bicycle_poster_user_id = review_users.user_id
                                  and bicycles.bicycle_id = reviews.bicycle_id_being_reviewed
                                   group by bicycles.bicycle_id
                                   order by avg_of_ratings asc";


        $sorted_by_top_rating = DB::select($sql);
//        @dd($sorted_by_top_rating);
        return view('home')->with('items', $sorted_by_top_rating);
        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('home_sort_top_Reviews_asc');





?>
