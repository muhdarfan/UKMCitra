<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
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
        return view('lecturer.courses.index', [
            'citras' => auth()->user()->citras()->withCount(['application as approvedApplication' => function ($query) {
                $query->where('status', '=', 'approved');
            }, 'application as pendingApplication' => function ($query) {
                $query->where('status', '=', 'pending');
            }])->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $citra = auth()->user()->citras()->with('application')->wherePivot('courseCode', '=', $id)->first();

        // Check whether Lecturer has permission to the Citra courses.
        // If not, redirect to Citra list.
        if (!$citra)
            return redirect()->route('mycitra.index');

        $pendingCount = $citra->application()->where('status', '=', 'pending')->count();
        $citra->application = $citra->application()->byStatus($request->status)->orderByRaw("FIELD(application.status, 'pending') DESC")->orderByDesc('created_at')->paginate(10);

        return view('lecturer.courses.show', compact('citra', 'pendingCount'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $courseCode)
    {
        /*
        UPDATE `application` SET `status`='pending' WHERE courseCode = 'LMCR2482';
        UPDATE `application` SET `status`='approved' WHERE courseCode = 'LMCR2482' LIMIT 2;
         */

        $citra = auth()->user()->citras()->with('application')->wherePivot('courseCode', '=', $courseCode)->first();

        if (!$citra)
            return redirect()->route('mycitra.index');

        $request->validate([
            'type' => 'required|in:reject,approve',
            'quota' => 'required_if:type,==,approve|numeric|min:1',
        ]);

        if ($request->input('type') === 'approve') {
            $quota = $request->input('quota');

            // TODO
            // ACCEPT STUDENT BY PRIORITY
            $citra->application()->where('status', 'pending')->orderByDesc('created_at')->limit($quota)->update(['status' => 'approved']);
        }

        $citra->application()->where('status', 'pending')->update(['status' => 'rejected']);

        return redirect()->route('mycitra.show', $courseCode)->with('message', ['type' => 'success', 'text' => 'Your request have been successfully saved.']);
    }
}
