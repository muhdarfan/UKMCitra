<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class MyCitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('lecturer.courses.index', [
            'citras' => auth()->user()->citras()->withCount(['application as approvedApplication' => function ($query) {
                $query->where('status', '=', 'approved');
            }, 'application as pendingApplication' => function ($query) {
                $query->where('status', '=', 'pending');
            }])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $citra = auth()->user()->citras()->with('application')->wherePivot('courseCode', '=', $id)->first();

        // Check whether Lecturer has permission to the Citra courses.
        // If not, redirect to Citra list.
        if (!$citra)
            return redirect()->route('mycitra.index');

        return view('lecturer.courses.edit', compact('citra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $citra = auth()->user()->citras()->with('application')->wherePivot('courseCode', '=', $id)->first();

        // Check whether Lecturer has permission to the Citra courses.
        // If not, redirect to Citra list.
        if (!$citra)
            return redirect()->route('mycitra.index');

        $request->validate([
            'courseAvailability' => 'required|numeric|min:0'
        ]);

        $newAvailability = intval($request->input('courseAvailability'));

        // Check whether new availability is more than current student.
        // If not, redirect to Citra detail with an error.
        if ($newAvailability < $citra->application->where('status', 'approved')->count()) {
            return redirect()->route('mycitra.show', $citra->courseCode)->with('message', ['type' => 'danger', 'text' => 'New Citra Course Availability should be more than current student.']);
        }

        $citra->courseAvailability = $newAvailability;
        $citra->save();

        return redirect()->route('mycitra.show', $citra->courseCode)->with('message', ['type' => 'success', 'text' => 'Citra courses new availability has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
