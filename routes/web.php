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

if (\Illuminate\Support\Facades\App::environment('local')) {
    Route::get('/signin/{as}', function ($as) {
        $user = \App\Models\User::where('role', $as)->first();

        if (!$user)
            return redirect()->route('login');

        Auth::login($user);
        return redirect()->route('dashboard')->with('message', "You are logged in as `{$as}`");
    })->name('dev_login');
}

Route::get('/', function () {
    return redirect("/login");
});

Route::get('/template', function () {
    return view('template');
});

// Route for authenticated user
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

    // Route for System Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/citra/export', [\App\Http\Controllers\Admin\CitraController::class, 'export'])->name('citra.export');
        Route::resource('citra', \App\Http\Controllers\Admin\CitraController::class);
        Route::resource('citra.lecturer', \App\Http\Controllers\Admin\CitraLecturer::class)->except(['show', 'edit', 'update']);
        Route::resource('feedback', \App\Http\Controllers\FeedbackController::class)->except(['create', 'store']);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    // Route for Lecturer
    Route::middleware('role:lecturer')->group(function () {
        Route::resource('application', \App\Http\Controllers\Lecturer\ApplicationController::class);
        Route::resource('mycitra', \App\Http\Controllers\Lecturer\MyCitraController::class);
    });

    // Route for Student
    Route::middleware('role:student')->group(function () {
        Route::post('citras/store', [\App\Http\Controllers\Student\MyApplicationController::class, 'store'])->name('myApplication.store');
        Route::resource('citras', \App\Http\Controllers\Student\CitraListController::class)->only(['index', 'show']);

        Route::resource('myApplication', \App\Http\Controllers\Student\MyApplicationController::class)->except([
            'create', 'store', 'edit'
        ]);

        Route::get('/feedback_form', [\App\Http\Controllers\FeedbackController::class, 'create'])->name('user_feedback');
        Route::post('/feedback_form', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('user_feedback_store');
    });

    // Route for ajax
    Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
        Route::post('search_lecturer', [\App\Http\Controllers\Admin\CitraController::class, 'search'])->name('find_lecturer');
        //Route::post('assign_lecturer', [\App\Http\Controllers\Admin\CitraController::class, 'assignLecturer'])->name('assign_lecturer');
    });
});

Route::get('asd', function () {
    abort(500);
});

// Laravel Authentication Library
// Register Login and Register route.
Auth::routes();

