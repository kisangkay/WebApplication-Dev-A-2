<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollDeenrollstudent;
use App\Http\Controllers\AssessmentDetails;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');//checks if a user is logged in and verified
    //if not they will be redirected to page login

Route::middleware('auth')->group(function () {//this group of functions require user to be logged in first
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {return redirect()->route('courses');})->name('/');
    Route::get('courses', [CourseController::class,'index'])->name('courses');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses_student');
    Route::get('/courses/{id}/teacher', [CourseController::class, 'teacher_show'])->name('courses_teacher');
    Route::get('/courses/{id}/teacher/add_registered_student', [CourseController::class, 'add_registered_student'])->name('add_registered_student');

    Route::post('enroll/{cid}/{sid}', [EnrollDeenrollstudent::class, 'enroll'])->name('enroll-student');
    Route::post('deenroll/{cid}/{sid}', [EnrollDeenrollstudent::class, 'de_enroll'])->name('de-enroll-student');

    Route::get('/courses/{cid}/teacher/assessment-details-page/{assesst_id}', [AssessmentDetails::class, 'index'])->name('assessment-details-page');
    Route::get('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/student-reviews-and-score/{sid}', [ReviewsController::class, 'index'])->name('student-reviews-and-score');

    Route::resource('user', SignupController::class);
});

require __DIR__.'/auth.php';


//    Route::resource('user', SignupController::class);



//    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('item-review-page');

//    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');


//    Route::view('/home-teacher', 'teacher.home')->name('home-teacher');


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


//    Route::get('/login', function () {
//        return redirect(route('login'));
//    })->name('login');


    //i want to clear the sesstion that was put when a user logs in we use session flush
//    Route::post('/', function () {
//        session()->flush();
//        return redirect(route('login'));
//    })->name('logout_action');


    Route::get('/manufacturer-specific-items', function () {
        return view('manufacturer-specific-items');
    })->name('manufacturer-specific-items');

//    Route::get('/student-reviews-and-score', function () {
//        return view('student-reviews-and-score');
//    })->name('student-reviews-and-score');

    Route::get('/create-a-new-assessment', function () {

        $result_from_query = get_all_manufacturers();
        if ($result_from_query) {
            return view('create-a-new-assessment')->with('all_manufacturers', $result_from_query);
        }

    })->name('create-a-new-assessment');


    Route::get('/add_enrolled_student', function () {

        $getallusers = "select *, sum(reviews.flags) as totalflags
                            from review_users
                             left join reviews on reviews.review_creator_id = review_users.user_id
                             group by reviews.review_creator_id order by reviews.flags desc";
        $allusrs = DB::select($getallusers);


        return view('add-enrolled-student')->with('allusers', $allusrs);
    })->name('add_enrolled_student');

//    xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx




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


