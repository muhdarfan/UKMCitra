<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Validate if authenticated user has permission to view.
        if ($request->user()->cannot('viewAny', Application::class))
            abort(404);

        $lectId = Auth::user()->matric_no;
        $application = Application::select('application.*', 'users.name')->join('users', 'users.matric_no', '=', 'application.matric_no')
            ->join('student_information', 'student_information.matric_no', '=', 'users.matric_no')
            ->join('citras_lecturer', 'citras_lecturer.courseCode', '=', 'application.courseCode')->where('citras_lecturer.matric_no', $lectId);

        //$application = Application::join('citras_lecturer', 'citras_lecturer.courseCode', '=', 'application.courseCode')->where('citras_lecturer.matric_no',$lectId)
        //->paginate(5);
        //$applications=Application::all();
        $citra = Application::select('citras.courseAvailability')->join('citras_lecturer', 'citras_lecturer.courseCode', '=', 'application.courseCode')
            ->join('citras', 'citras.courseCode', '=', 'application.courseCode')
            ->where('citras_lecturer.matric_no', $lectId)->first();

        /*
        $availability = Application::join('citras_lecturer', 'citras_lecturer.courseCode', '=', 'application.courseCode')
            ->where('citras_lecturer.matric_no', $lectId)
            ->where('application.status', '=', 'approved')->count();


        if ($availability < $citra->courseAvailability) {
            Application::where('status', 'pending')->update(['status' => 'APPROVED']);
        }
        */

        /*
         * FILTERING BASED ON REQUEST
         */
        if ($request->has('course')) {
            $application->where('application.courseCode', $request->course);
        }

        if ($request->has('search')) {
            $application->where(function ($query) use ($request) {
                $query->orWhere('application.courseCode', 'LIKE', "%{$request->search}%");
                $query->orWhere('application.matric_no', 'LIKE', "%{$request->search}%");
                $query->orWhere('users.name', 'LIKE', "%{$request->search}%");
                $query->orWhere('application.status', 'LIKE', "%{$request->search}%");
            });
        }

        $applications = $application->orderByRaw("FIELD(application.status, 'pending') DESC")->orderBy('application.application_id', 'desc')->paginate(10);

        return view('lecturer.application.index', compact('applications', 'citra'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Application $application)
    {
        /*
        $data = Application::join('users', 'users.matric_no', '=', 'application.matric_no')
            ->join('student_information', 'student_information.matric_no', '=', 'users.matric_no')
            ->where('application.application_id', $id)
            ->first();
        */
        if ($request->user()->cannot('update', $application))
            return redirect()->route('application.index');

        /*
         * Priority Algorithm
         * -------------------
         * 1. Year
         * 2. Faculty
         * 3. Credit Needed (Bonus if same category)
         * 4. CGPA
         *
         */

        return view('lecturer.application.show', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        // Validate authenticated user if has permission to update.
        if ($request->user()->cannot('update', $application))
            return redirect()->route('application.index');

        // Validate if application is in 'pending' status
        if ($application->status !== 'pending')
            return redirect()->route('application.index')->with('message', ['type' => 'warning', 'text' => "Application #{$application->application_id} can't be updated since it has already been <strong>" . ucfirst($application->status) . "</strong>."]);

        if (isset($request->act)) //if you click activate button, update accordingly
            $application->update(['status' => 'approved']);
        elseif (isset($request->deact)) //if you click deactivate button, update accordingly
            $application->update(['status' => 'rejected']);
        else
            Log::info(auth()->user()->name . ' trying to update an application with unknown status.', 'Lecturer/Application');

        return redirect()->route('application.index')->with('message', ['type' => 'success', 'text' => 'Application updated successfully']);
    }
}
