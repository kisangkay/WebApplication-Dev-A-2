<?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\Enroll;
    use App\Http\Controllers\AssessmentDetails;
    use App\Http\Controllers\ReviewsController;
    use App\Http\Controllers\TopReviewers;
    use App\Http\Controllers\AssessmentScoreController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Middleware\check_user_role;


    //i have 2 middlewares applying to groups of controllers, one to check if user is logged in
    //The only page without this restriction is TOP REVIWERS PAGE
    //another is a role manager restricting students from teachers page.

    Route::middleware('auth')->group(function () {//this group of functions require user to be logged in first
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/', function () {return redirect()->route('courses');})->name('/');
        Route::get('courses', [CourseController::class,'index'])->name('courses');
        Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses_student');
        Route::get('/courses/{id}/student', [CourseController::class, 'student_show'])->name('courses_student');

        Route::get('/courses/{cid}/student/assessment-details-page/{assesst_id}', [AssessmentDetails::class, 'index_student'])->name('assessment-details-page-student');
        Route::post('/courses/{cid}/student/assessment-details-page/{assesst_id}/post-review', [ReviewsController::class, 'index_student_create_review'])->name('post-review');
        Route::post('/courses/{cid}/student/assessment-details-page/{assesst_id}/post-edit-reviewer-rating', [ReviewsController::class, 'update_reviewers_rating'])->name('post-edit-reviewer-rating');


        Route::middleware([check_user_role::class . ':teacher'])->group(function () {//only for teacher access had to pass middleware directly as no kernel.php in L11
            Route::get('/courses/{cid}/teacher/assessment-details-page/{assesst_id}', [AssessmentDetails::class, 'index'])->name('assessment-details-page-teacher');
            Route::get('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/student-reviews-and-score/{sid}', [ReviewsController::class, 'index'])->name('student-reviews-and-score');

            Route::post('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/student-reviews-and-score/{sid}/update-assessment-score', [AssessmentScoreController::class, 'update_score'])->name('update-assessment-score');
            Route::post('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/student-reviews-and-score/{sid}/post-assessment-score', [AssessmentScoreController::class, 'post_score'])->name('post-assessment-score');
            Route::get('/courses/{id}/teacher/add_registered_student', [CourseController::class, 'add_registered_student'])->name('add_registered_student');
            Route::get('/courses/{id}/teacher', [CourseController::class, 'teacher_show'])->name('courses_teacher');

            Route::get('/courses/{cid}/teacher/create-new-assessment', [AssessmentDetails::class, 'create'])->name('create-new-assessment');
            Route::post('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/update-assessment-details', [AssessmentDetails::class, 'update'])->name('update-assessment-details');
            Route::get('/courses/{cid}/teacher/assessment-details-page/{assesst_id}/mark-assessments', [AssessmentDetails::class, 'mark_assessments'])->name('mark-assessments');
            Route::post('/courses/{cid}/teacher/post-new-assessment', [AssessmentDetails::class, 'post'])->name('post-new-assessment');

            Route::post('/enroll-student', [Enroll::class, 'enroll'])->name('enroll-student');

        });

    });

    Route::get('/top-reviewers', [TopReviewers::class, 'index'])->name('top-reviewers');//Accessible by anyuser

    require __DIR__.'/auth.php';

