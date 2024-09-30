<?php

    //LOGIN ROUTE TO SEND YOU TO HOME PAGE IF YOU EXIST IN DB
    Route::post('/checkifusername_exists_action', function () {
        $user_name = request('username');

//        dd($user_name);
//VALIDATION LOGIN
//        if (!$user_name) { //Empty, <2 in length or 0 value
//            return redirect()->route('signup')->with('validationerror', 'PLease provide a username!');
//        } elseif (strlen($user_name) < 2 || strlen($user_name) > 9) {
//            return redirect()->route('signup')->with('validationerror', 'Please use a username between 3 to 9 characters!');
//        } //To check for these illegal chars
//        elseif ($user_name) {
//            $illegal_chars = "-_+\"'";
//            $user_name_characters = str_split($user_name); //makes an array of each chars in the username
//            foreach ($user_name_characters as $character) { //check if each char matches the defined
//                if (strpos($illegal_chars, $character) == true) { //$character is a single char of each value in the username
//                    return redirect()->route('login')->with('validationerror', 'Username cant contain any of: - _ + " \'');
//                }
//            }
//        }

//IF USERNAMEFOUND TO LOGIN
        $usernamefound = get_username($user_name);
        if ($usernamefound) {
//            dd($usernamefound->username);
            session()->put('username', $usernamefound->username); //add it here so super-admin route can access it from session
            if ($usernamefound->username == 'admin') {
                return redirect(route('super-admin'));
            } elseif ($usernamefound->banned == 'yes') {
                return redirect(route('login'))->with('loginerrormessage', 'you have been banned for review misuse please contact admin');
            }
            //making use of session to search a username and return it
            session()->put('username', $usernamefound->username);
            session()->put('user_id', $usernamefound->user_id);
            return redirect(route('home'));
            //i want to display the username on the nav bar which only shows if url is not login or signup
        } else {
            // i want to display a no matching username if we dont find such a username back to the login page
            session()->flush();
            return redirect(route('login'))->with('loginerrormessage', 'no matching username found, please check username');
        }
    })->name('checkifusername_exists_action'); //the name of my route as reflects in the html section

    function get_username($user_name)
    {
        $sql = "select * from review_users where username = ?";
        $usernamefound = DB::select($sql, array($user_name));

        if ($usernamefound) {
            return $usernamefound[0];
        }
    }

?>
