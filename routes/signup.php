<?php
//SIGNUP to add a user to the database
    Route::post('/signup_action', function () {
        $user_name = request('username');

//MY INPUT VALIDATION FOR SIGNUP USERNAMEEEEEEEEEEEEEEEEEEEE
        if (!$user_name){ //Empty, <2 in length or 0 value
            return redirect()->route('signup')->with('validationerror','PLease provide a username!');
        }
        elseif (strlen($user_name)<2 || strlen($user_name)>9){
            return redirect()->route('signup')->with('validationerror','Please use a username between 3 to 9 characters!');
        }
        //To check for these illegal chars
        elseif ($user_name){
            $illegal_chars = "-_+\"'";

            $user_name_characters = str_split($user_name); //makes an array of each chars in the username
            foreach ($user_name_characters as $character){ //check if each char matches the defined
                if (strpos($illegal_chars, $character ) == true){ //$character is a single char of each value in the username
                    return redirect()->route('signup')->with('validationerror','Username cant contain any of: - _ + " \'');
                }
            }
        }

//AFTER INPUT VALIDATION, WE FILTER OUT ODD NUMBERS
        //location of usernamefilter function
        include "defs/username_filter.php";
        $filtereduser_name = filterodds($user_name);
//        dd($filtereduser_name);


        $usernamefound = add_user($filtereduser_name);
        if ($usernamefound) {
            //making use of session to store a sessage and return view
//            return view(".login-signup/login")->with('lastentry', "signed up, please log in and $id_of_last_entry");
            //switched from using a view to route as session message was not being displayed
            //SO THEN WE RETURN THE LOGIN ROUTE AND WE PASS THE USERNAME THROUGH A VARIABLE
            return redirect(route('login'))
                ->with('lastentry', "signed up, but username has been changed to $usernamefound");
        } else {
            die("Record not entered problem encountered");
        }
    })->name('signup_action');

    function add_user($filtereduser_name)
    {
        $sql = "insert into review_users (username) values  (?)"; //? acts as a placeholder for sanitization to replace with variable

        $doesusernameexist = "select * from review_users where username = ?";
        $gotten = DB::select($doesusernameexist, array($filtereduser_name));

        if (!$gotten) { //if no matching username found, we add the user into db and send user to login and show their entered name
            DB::insert($sql, array($filtereduser_name));
            $id_of_last_entry = DB::getPdo()->lastInsertId();
            //i am trying to retrieve entered username using the above found user id
            $usernamefound = DB::select("select username from review_users where user_id =? ", array($id_of_last_entry));
            //for sanitization here i use =? which is a placeholder, and the array replaces the placeholder in execution
            //this placeholder is useful in event that we want to pass multiple values like
            // where id = ? and name = ?    array($id, $name)

            return $usernamefound[0]->username;
        }
        else{
            die("Existing username please use different one");
        }

    }
?>
