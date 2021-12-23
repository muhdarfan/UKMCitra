<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Citra;
use Illuminate\Http\Request;

class CitraListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.citra.index', [
            'citras' => Citra::paginate(5)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citra  $citra
     * @return \Illuminate\Http\Response
     */
    public function show(Citra $citra)
    {
        return view('student.citra.show', compact('citra'));
    }
}
