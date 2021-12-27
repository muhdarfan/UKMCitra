<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Citra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitraListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') && empty($request->search))
            return redirect()->route('citras.index');

        $citras = Citra::search($request->search, $request->category)->paginate(15);
        $citraCategory = DB::table('citras')->selectRaw('courseCategory, count(courseCategory) as cnt')->groupBy('courseCategory')->get()->keyBy('courseCategory');

        return view('student.citra.index', compact(['citras', 'citraCategory']));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Citra $citra
     * @return \Illuminate\Http\Response
     */
    public function show(Citra $citra)
    {
        return view('student.citra.show', compact('citra'));
    }
}
