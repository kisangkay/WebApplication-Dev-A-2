<?php
    //HERE WE BEGIN THE IMPLEMENTATION OF ADDING NEW BICYCLES THAT WILL SHOW ON THE HOME PAGE
    //USER POST REVIEW ITEM REVIEW PAGE ROUTE 2

    Route::post('/create-new-bicycle', function () {

        $result = add_bicycle(); //if the functionnreturns anything we store it in result. im using it as a checker

//check if you are logged in so that we dont get an error when posting your user id
        $current_userid = session('user_id');

        //lets get its values from the the template
        $bicycle_name = request('bicycle_name');
        $bicycle_description = request('bike_description');
        $selected_manufacturer_id = request('manufacturerid');
        $bike_image = request()->file('bike_image');

//NEW BICYCLE CREATION VALIDATIONNNNNNNNNNNNNNNNNN
        if (!$bicycle_name || !$bicycle_description) {
            //Empty, <2 in length or 0 value
            return redirect()->route('create-a-new-item')->with('validationerror', 'PLease provide a Bicycle name and description');
        }
        if (!$bike_image) {
            return redirect()->route('create-a-new-item')->with('validationerror', 'please select an image');
        }
        if (!$selected_manufacturer_id) {
            return redirect()->route('create-a-new-item')->with('validationerror', 'please select an manufacturer');
        } elseif (strlen($bicycle_name) < 5) {
            return redirect()->route('create-a-new-item')->with('validationerror', 'Bicycle name should have minimum of 5 characters');
        } elseif (strlen($bicycle_description) < 5 || strlen($bicycle_name) > 800) {
            return redirect()->route('create-a-new-item')->with('validationerror', 'Please leave a review between 2 and 150 words');
        } //To check for these illegal chars
        elseif ($bicycle_name || $bicycle_description) {
            $illegal_chars = "-_+\"'";

            $user_name_characters = str_split($bicycle_name || $bicycle_description); //makes an array of each chars in the username
            foreach ($user_name_characters as $character) { //check if each char matches the defined
                if (strpos($illegal_chars, $character) == true) { //$character is a single char of each value in the username
                    return redirect()->route('create-a-new-item')
                        ->with('validationerror', 'Your bicycle name or its \' description cant contain any of these: - _ + " \' characters');
                }
            }
        }


        if ($current_userid and $result) {
//after submitting i will add a (with->and pass to session to show bike added to home page) (its going to session as we are using redirect+with)
            return redirect(route('home',))->with('itisposted', true);

        } else {
            die("posting your bicycle");
        }

    })->name('create-new-bicycle');//name of this route so can be accessible by using route('itsname')


    //to add a bike to the database
    function add_bicycle()
    {
        $bicycle_name = request('bicycle_name');
        $bicycle_description = request('bike_description');
        $selected_manufacturer_id = request('manufacturerid');
        $bike_image = request()->file('bike_image');

//THIS FUNCTION ALSO ADDS THE PATH OF THE IMAGE AS PREFIX AND THEN IN THE DB THE PATH WILL SHOW
        $bike_image_to_upload = $bike_image->store('images', 'public');
//@dd($bike_image_to_upload); //WOULD SHOW THE IMAGE NAME, AND TYPE
//HAD TO INCLUDE SYMBOLIC LINK TO LINK THE STORAGE/IMAGES TO THE PUBLIC FOLDER


        $bicycle_poster_id_from_session = session('user_id');
        $currentdate = date('d-m-Y');

//        $sql = "insert into reviews, review_users, bicycles

//PART 1 WE INSERT TO BICYCLES TABLE
        $addbike = "insert into bicycles (bicycle_name, bicycle_manufacturer_ID, bicycle_image, bicycle_description,
                      bicycle_total_reviews,bicycle_poster_user_id, bicycle_date_posted) values (?,?,?,?,?,?,?)";

//insert values
        DB::insert($addbike, array($bicycle_name, $selected_manufacturer_id, $bike_image_to_upload, $bicycle_description,
            0, $bicycle_poster_id_from_session, $currentdate));

        $getidoflastentry = DB::getPdo()->lastInsertId(); //get id of last entry

//SOMETHING TO RETURN TRUE AS NOT EMPTY
        if ($getidoflastentry) {
            return $getidoflastentry;
        } else {
            die("error entering your review on $getidoflastentry");
        }
    }

?>
