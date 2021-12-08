<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citra;
use Illuminate\Support\Facades\DB;

class CitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$citras = DB::table('citras');
        $citras = Citra::all();
        return view('citra.index', [
            'citras' => Citra::paginate(5)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Citra $citra)
    {
        return view('citra.show',compact('citra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Citra $citra)
    {
        return view('citra.edit',compact('citra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citra $citra)
    {
        $request->validate([
            'courseCode' => 'required',
            'courseName' => 'required',
            'descriptions' => 'required',
        ]);

        $citra->update($request->all());

        return redirect()->route('citra.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citra $citra)
    {
        $citra->delete();

        return redirect()->route('citra.index')
        ->with('success', 'Course deleted successfully');
    }
}
