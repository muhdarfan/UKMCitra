<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CitrasExport;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Citra;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $citras = Citra::search($request->search, $request->category)->withCount('application')->paginate(10);
        $citraCategory = DB::table('citras')->selectRaw('courseCategory, count(courseCategory) as cnt')->groupBy('courseCategory')->get()->keyBy('courseCategory');

        return view('admin.citra.index', compact('citras', 'citraCategory'));
    }

    /**
     * Show the form for importing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import() {

    }

    public function export() {
        $date = Carbon::now()->format('d-M-Y');
        return Excel::download(new CitrasExport, "citras-{$date}-".time().".xlsx");
    }

    /**
     * Store a newly imported resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveData() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.citra.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'courseCode' => 'required',
            'courseName' => 'required|max:256',
            'courseCredit' => 'required|numeric|min:0',
            'courseCategory' => 'required|in:C1,C2,C3,C4,C5,C6',
            'courseAvailability' => 'required|numeric|min:0',
            'descriptions' => 'required',

        ]);

        Citra::create($request->all());

        return redirect()->route('citra.index')
                        ->with('success','Citra Courses created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Citra $citra)
    {
        return view('admin.citra.show', compact('citra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Citra $citra)
    {
        $current=Application::join('citras', 'citras.courseCode', '=', 'application.courseCode')
        ->where('application.status','=','approved')->where('citras.courseCode',$citra->courseCode)->count();
        return view('admin.citra.edit', compact('citra','current'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citra $citra)
    {
        $request->validate([
            'courseCode' => 'required',
            'courseName' => 'required',
            'courseAvailability' => 'required|numeric|min:0',
            'descriptions' => 'required',
        ]);

        $citra->update($request->all());

        return redirect()->route('citra.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citra $citra)
    {
        $citra->delete();

        return redirect()->route('citra.index')->with('success', 'Course deleted successfully');
    }

    /*
     * API
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $matric = $request->input('search');
            $courseCode = $request->input('courseCode');

            $lecturers = DB::table('users')
                ->leftJoin('citras_lecturer', function ($q) use ($courseCode) {
                    $q->on('users.matric_no', '=', 'citras_lecturer.matric_no');
                    $q->on('citras_lecturer.courseCode', '=', DB::raw("'{$courseCode}'"));
                })
                ->where('users.role', 'lecturer')
                ->where(function($q) use ($matric) {
                    $q->where('users.matric_no', 'LIKE', "%{$matric}%")->orwhere('users.name', 'LIKE', "%{$matric}%");
                })
                ->select(['users.matric_no', 'users.name', 'citras_lecturer.courseCode'])
                ->limit(5)->get();

            return response()->json($lecturers);
        }

        abort(403);
    }
}
