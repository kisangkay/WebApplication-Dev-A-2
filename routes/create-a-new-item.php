<?php
    //WE RETURN THE CREATE BIKE PAGE WITH A LIST OF ALL MANUFACTURERS TO PICK FROM
    Route::get('/create-a-new-item', function () {

        $result_from_query = get_all_manufacturers();
        if ($result_from_query) {
            return view('create-a-new-item')->with('all_manufacturers', $result_from_query);
        }

    })->name('create-a-new-item');


    //function to get all manufacturers
    function get_all_manufacturers()
    {
        $query_for_selecting = "select * from manufacturers order by manufacturer_name asc";
        $all_manufacturers = DB::select($query_for_selecting);

        return $all_manufacturers;
    }

?>
