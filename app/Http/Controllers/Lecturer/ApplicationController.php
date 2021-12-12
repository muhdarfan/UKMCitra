<?php

namespace App\Http\Controllers\Lecturer;

use App\Models\Application;
use App\Models\StudentInformation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectId=Auth::user()->matric_no;
        $application = Application::join('citras_lecturer', 'citras_lecturer.courseCode', '=', 'application.courseCode')->where('citras_lecturer.matric_no',$lectId)
              		->paginate(5);
        //$application=Application::all();

        return view('lecturer.application.index')->with('application', $application);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Application::join('users', 'users.matric_no', '=', 'application.matric_no')
              		->join('student_information', 'student_information.matric_no', '=', 'users.matric_no')
              		->first();
        return view('lecturer.application.show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = Application::join('users', 'users.matric_no', '=', 'application.matric_no')
              		->join('student_information', 'student_information.matric_no', '=', 'users.matric_no')
              		->first();
        return view('lecturer.application.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(isset($request->act)) { //if you click activate button, update accordingly
            $appId = $request->act;
            Application::where('application_id', $appId )->update(['status' => 'APPROVED']);

          }if(isset($request->deact)) { //if you click deactivate button, update accordingly
            $appId = $request->deact;
            Application::where('application_id', $appId )->update(['status' => 'REJECTED']);
          }
          return redirect()->route('application.index')->with('success', 'Application updated successfully');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
