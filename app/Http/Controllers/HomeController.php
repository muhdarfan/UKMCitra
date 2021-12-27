<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role === 'student') {
            $applications = auth()->user()->applications()->orderBy('application_id', 'DESC')->get();

            return view('student.dashboard', compact('applications'));
        } else {
            return view('dashboard');
        }
    }

    public function profile() {
        if (auth()->user()->role === 'student')
            return view('student.profile');

        return view('profile');
    }
}
