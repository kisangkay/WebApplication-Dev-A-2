<?php
    require "home.php";
    require "create-a-new-item.php";
    require "item-review-page_populate.php";
    require "signup.php";
    require "checkifusername_exists_action.php";
    require "item-review-page_post_review.php";
    require "item-review-page_edit_review.php";
    require "item-review-page_delete_review.php";
    require "create-new-bicycle.php";
    require "delete-this-bicycle.php";
    require "all-manufacturers.php";
    require "to-manufacturer-specific-page.php";
    require "super-admin.php";
    require "flag-review.php";
    require "super-admin-ban-user.php";

    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('.login-signup/login');
    })->name('login');

    //i want to clear the sesstion that was put when a user logs in we use session flush
    Route::post('/', function () {
        session()->flush();
        return redirect(route('login'));
    })->name('logout_action');


    Route::get('/manufacturer-specific-items', function () {
        return view('manufacturer-specific-items');
    })->name('manufacturer-specific-items');


    Route::get('/signup', function () {
        return view('.login-signup/signup');
    })->name('signup');


//is outside a route can be reused
//SINCE I REMEMBER REUSING THIS FUNCTION SOMEWHERE ILL RECREATE A SECOND ONE
    function get_bicycle($bicycle_id)
    {
        $sql = "select * from bicycles where bicycle_id = ?"; //? for sanitization
        $items = DB::select($sql, array($bicycle_id));
        if (count($items) != 1) {
            die("error while fetching item result from query $sql");
        } else {
            $itemfound = $items;
            return $itemfound;
        }
    }

