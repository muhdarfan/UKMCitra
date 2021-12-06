<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/login");
});

Route::get('/template', function () {
    return view('template');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/listofcitrapage', function () {
    return view('listofcitrapage');
});

// Route for authenticated user
Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Route for System Admin
    Route::middleware('role:admin')->group(function() {
        Route::resource('citra', \App\Http\Controllers\Admin\CitraController::class);
    });

    // Route for Lecturer
    Route::middleware('role:lecturer')->group(function() {

    });

    // Route for Student
    Route::middleware('role:student')->group(function() {

    });
});

// Laravel Authentication Library
// Register Login and Register route.
Auth::routes();

