<?php
    Route::post('/super-admin-ban-user,{userid}', function ($userid) {
//        @dd(session('username'));
        if (session('username') != 'admin') {
            return redirect(route('login'))->with('whyloggedout', 'Sorry page only restricted to admin');
        }

        $updatequery = "update review_users set banned = ? where user_id = ?";
        $allusrs = DB::select($updatequery, array('yes', $userid));

        return redirect()->back();

        return view('super-admin')->with('allusers', $allusrs);

    })->name('super-admin-ban-user');


    Route::post('/super-admin-unban-user,{userid}', function ($userid) {
//        @dd(session('username'));
        if (session('username') != 'admin') {
            return redirect(route('login'))->with('whyloggedout', 'Sorry page only restricted to admin');
        }

        $updatequery = "update review_users set banned = ? where user_id = ?";
        $allusrs = DB::select($updatequery, array('no', $userid));

        return redirect()->back();

        return view('super-admin')->with('allusers', $allusrs);

    })->name('super-admin-unban-user');

