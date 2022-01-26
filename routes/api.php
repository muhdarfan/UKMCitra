<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/citra', function (Request $request) {
    $data = $request->input('citra');

    $temp = \App\Models\Citra::select('courseName', 'courseCategory')->where('courseCode', $data)->first();
    return response()->json($temp);
});

Route::get('/courses/students', function (Request $request) {
    $test = \App\Models\Application::with('applicant')->get()->map(function ($item) {
        return [
            'matric_no' => $item->matric_no,
            'program' => $item->applicant->studentInfo->program_code,
            'semester' => $item->semester,
            'session' => $item->session,
            'course_code' => $item->courseCode,
        ];
    })->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    return response()->streamDownload(function () use ($test) {
        echo $test;
    }, 'student_courses_dataset.json');
});
