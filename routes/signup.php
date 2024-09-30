<?php
    use App\Models\UsersData;
    use Illuminate\Support\Carbon;//using class carbon to get current time
//SIGNUP to add a user to the database


    Route::post('/signup_action', function () {
        $snumber = request('snumber');

        $studentno = add_user($snumber);//if function returns something means it was entered successfully and retrieved
        if ($studentno) {
            //making use of session to store a sessage and return view
//            return view(".login-signup/login")->with('lastentry', "signed up, please log in and $id_of_last_entry");
            //switched from using a view to route as session message was not being displayed
            //SO THEN WE RETURN THE LOGIN ROUTE AND WE PASS THE USERNAME THROUGH A VARIABLE
            return redirect(route('login'))->with('lastentry', "Signed up Please Login");
//                ->with('lastentry', "signed up, but username has been changed to $usernamefound");
        } else {
            return redirect(route('login'))->with('lastentry', "Student number exists please login");
        }
    })->name('signup_action');

    function add_user($snumber)
    {
//        $snumber = request('snumber');
        $fullname = request('fullname');
        $email = request('email');
        $password = request('password');

        $gotten = UsersData::where('user_number', $snumber)->exists();

        if (!$gotten) { //if no matching username found, we add the user into db and send user to login and show their entered name
            $register = UsersData::create(['user_number'=>$snumber, 'fullname'=>$fullname,
                'email'=>$email,'password'=>Hash::make($password)]);
            $id_of_last_entry = DB::getPdo()->lastInsertId();

            //i am trying to retrieve entered username using the above found user id
            $usernofound=UsersData::where('id', $id_of_last_entry)->get();
//            dd($usernofound[0]->user_number);

            return $usernofound[0]->user_number;
        }


    }
?>
