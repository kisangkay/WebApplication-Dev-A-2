<?php
    Route::get('/super-admin', function () {
//        @dd(session('username'));
        if (session('username') != 'admin') {
            return redirect(route('login'))->with('whyloggedout', 'Sorry page only restricted to admin');
        }

        $getallusers = "select *, sum(reviews.flags) as totalflags
                            from review_users
                             left join reviews on reviews.review_creator_id = review_users.user_id
                             group by reviews.review_creator_id order by reviews.flags desc";
        $allusrs = DB::select($getallusers);


        return view('super-admin')->with('allusers', $allusrs);

    })->name('super-admin');


