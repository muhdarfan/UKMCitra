<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Citra;
use Illuminate\Http\Request;

class MyApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::where('matric_no', '=', auth()->user()->matric_no)->orderByDesc('created_at')->paginate(10);

        return view('student.application.index', compact('applications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreApplicationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationRequest $request)
    {
        //
        $code = $request->input('courseCode');

        $citra = Citra::find($code);

        if (!$citra)
            return redirect()->route('citras.index')->with('data', ['type' => 'danger', 'message' => 'Citra course not found.']);

        if ($citra->application->contains('matric_no', auth()->user()->matric_no))
            return redirect()->route('citras.index')->with('data', ['type' => 'danger', 'message' => 'Application already exists.']);

        if (!$citra->isAvailable()) {
            $request->validate([
                'reason' => 'required|max:255'
            ]);
        }

        Application::create([
            'matric_no' => auth()->user()->matric_no,
            'courseCode' => $citra->courseCode,
            'reason' => $citra->isAvailable() ? 'Course Available' : $request->input('reason'),
            'status' => $citra->isAvailable() ? 'approved' : 'pending',
            'session' => env('APP_CURRENT_SESSION'),
            'semester' => env('APP_CURRENT_SEMESTER', '1')
        ]);

        return redirect()->route('citras.index')->with('data', ['type' => 'success', 'message' => 'Your application has been submitted.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return 'test';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateApplicationRequest $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
