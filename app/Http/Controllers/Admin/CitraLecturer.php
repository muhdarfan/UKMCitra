<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Citra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitraLecturer extends Controller
{
    /*
     * TODO
     * INDEX, CREATE, STORE
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Citra $citra)
    {
        //
        $request->validate([
            'matric_no' => 'required'
        ]);

        DB::table('citras_lecturer')->insertOrIgnore([
            'matric_no' => $request->input('matric_no'),
            'courseCode' => $citra->courseCode
        ]);

        return redirect()->route('citra.edit', $citra->courseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citra $citra, $matric)
    {
        //
        DB::table('citras_lecturer')->where('courseCode', $citra->courseCode)->where('matric_no', $matric)->delete();

        return redirect()->route('citra.edit', $citra->courseCode);
    }
}
