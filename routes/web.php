<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dev-login', function () {
    abort_unless(app()->environment('local'), 403);

    Auth::loginUsingId(App\Models\User::first()->id);

    return redirect()->to('/');
});
