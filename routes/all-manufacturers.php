<?php
    //NOW ONTO MANUFACTURERS 1
    //route to list all MANUFCATURERES to manuf page
    Route::get('all-manufacturers', function () {
//UpDATED QUERY TO ALSO GET COUNT OF ALL BICYCLES MATCHING THE SAME MANUFACTURERid

//COUNT HAPPENS TO THE NUMBER OF ROW ELEMENTS INSIDE A GROUP

        $allmanuf_rating = "select manufacturers.*, sum(reviews.rating) as sumofratings, avg(reviews.rating) as average
        from manufacturers, reviews
        where manufacturers.manufacturer_id = reviews.manuf_id_of_bicycle_being_reviewed

        group by manufacturers.manufacturer_id order by manufacturer_name";


//THIS IS JUST TO DISPLAY THE TOTAL NO OF MANUFS IN ALL M PAGE
        $sql2 = "select count(manufacturers.manufacturer_id) as countofmanufacturers from manufacturers";
        $sql2query = DB::select($sql2);

//HERE, WE COUNT ALL THE BICYCLES USING THEIR UNIQUE ID WHICH IS bicycle_id, BUT THAT'S AFTER MERGING THE 2 TABLES USING ,
//AND THAT MERGE GIVES US ONE TABLE OF VERY LONG ROWS WHICH HAVE NOW BEEN EXTENDED AND JOINED USING THE SAME
//MATCHING PRIMARY AND FOREIGN KEYS, THEN WE GROUP THE ROWS BY THE MANUFACTURER ID, WHICH ARE ONLY 5 SO THE
// TEMPLATE WILL SHOW ONLY 5 ITEMS IN THE PAGE ALL MANUFACTURERS WHICH IS WHAT WE WANT, AND THEN WE SHOW THE 'ALLBIKES'
//WHICH NOW CONTAINS THE SUM OF ALL BIKES FROM THE 5 SPECIFIC GROUPS.

        $allmanufacturers = DB::select($allmanuf_rating);

//NOW I WANT TO RETURN THE AVERAGE RATING FOR A MANUFACTURER, avg=sum of ratings for a manuf /totalreviews(already stored in db)
//JUST ADDED A NEW COLUMN TO REVIEWS TABLE TO JOIN THE REVIEWS AND MANUF TABLES

//        $tofindthe_sum_of_a_manufacturers_rating="select reviews.*, sum(reviews.rating) as sumofratings, manufacturers.* from reviews, manufacturers
//                                  where reviews.manuf_id_of_bicycle_being_reviewed = manufacturers.manufacturer_id
//                                  group by manufacturers.manufacturer_id";
//
//        $sumoftheratingsofeachmanufacturergrouped = DB::select($tofindthe_sum_of_a_manufacturers_rating);

        return view('all-manufacturers')
            ->with('totalmanufs', $sql2query)
            ->with('allmanufacturers', $allmanufacturers);
        // then we pass data from this route to the view
        //the db data stored in $items variable is then accessed from view using the variable name 'items'
        //so its different from a session since its not stored across views
    })->name('all-manufacturers');

?>
