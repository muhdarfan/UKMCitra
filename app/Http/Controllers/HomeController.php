<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Application;
use App\Models\Citra;
use App\Models\Feedback;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

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
        $announcement = Announcement::orderByDesc('created_at')->first();

        if (auth()->user()->role === 'student') {
            $applications = auth()->user()->applications()->orderBy('application_id', 'DESC')->get();

            return view('student.dashboard', compact('applications', 'announcement'));
        } elseif (auth()->user()->role === 'admin') {
            $coursesCount = Citra::count();
            $applicationCount = Application::count();
            $applicantCount = DB::table('application')->select('matric_no')->distinct()->get()->count();
            $filledCitrasCount = DB::table('application')->select('courseCode')->distinct()->get()->count();
            $feedbackCount = Feedback::count();

            $fullCoursesCount = DB::table('application as a')->join('citras as c', 'c.courseCode', '=', 'a.courseCode')
                ->groupBy('a.courseCode')
                ->selectRaw('c.courseCode, (CAST(c.courseAvailability AS SIGNED) - SUM(if(status = "approved", 1, 0))) as cntLeft')
                ->having('cntLeft', '<', 1)->get()->count();

            // Application by Year
            $applicationsStats = DB::table('application')->join('student_information', 'application.matric_no', '=', 'student_information.matric_no')
                ->selectRaw('student_information.session_enter, COUNT(application.application_id) as cnt')
                ->groupBy('student_information.session_enter')->get()
                ->mapWithKeys(function ($item) {
                    return ['Year ' . $this->calculateYear($item->session_enter) => $item->cnt];
                });

            // Application by Status
            $applicationStatus = DB::table('application')->selectRaw('application.status, COUNT(application.application_id) as cnt')
                ->groupBy('application.status')->get()
                ->mapWithKeys(function ($item) {
                    return [ucfirst($item->status) => $item->cnt];
                });

            // Application Submitted by Date
            $applicationsDateDB = DB::table('application')->selectRaw('COUNT(application_id) as cnt, SUM(if(status = "approved", 1, 0)) as approved, SUM(if(status = "pending", 1, 0)) as pending, SUM(if(status = "rejected", 1, 0)) as rejected, DATE_FORMAT(created_at, "%d/%m/%Y") fdate')
                ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
                ->orderByRaw('STR_TO_DATE(fdate, "%d/%m/%Y")', 'ASC')
                ->groupBy('fdate')->get()
                ->mapWithKeys(function ($item) {
                    return [$item->fdate => ['all' => $item->cnt, 'approved' => intval($item->approved), 'rejected' => intval($item->rejected), 'pending' => intval($item->pending)]];
                });

            $applicationsDate = collect(CarbonPeriod::create(now()->subDays(6), now()))->mapWithKeys(function ($date) {
                return [$date->format('d/m/Y') => ["all" => 0, "rejected" => 0, 'approved' => 0]];
            })->merge($applicationsDateDB)->sortKeys();

            // POPULAR COURSES
            // Order by
            // 1. High Application Count
            // 2. Low availability
            // 3. Date
            $topCourses = DB::table('application as a')->join('citras as c', 'c.courseCode', '=', 'a.courseCode')
                ->selectRaw('c.courseCode, c.courseName, c.courseAvailability, MAX(a.created_at) as last_submit, COUNT(a.application_id) as cnt, SUM(if(status = "approved", 1, 0)) as approved, (CAST(c.courseAvailability AS SIGNED) - SUM(if(status = "approved", 1, 0))) as cntLeft')
                ->groupBy('a.courseCode')
                ->orderBy('cnt', 'DESC')
                ->orderBy('cntLeft', 'ASC')
                ->orderBy('last_submit', 'ASC')
                ->limit(4)
                ->get();

            return view('admin.dashboard', compact('fullCoursesCount', 'coursesCount', 'applicantCount', 'filledCitrasCount', 'feedbackCount', 'topCourses', 'applicationsStats', 'applicationCount', 'applicationStatus', 'applicationsDate'));
        } else {
            return view('dashboard', compact('announcement'));
        }
    }

    public function profile()
    {
        if (auth()->user()->role === 'student')
            return view('student.profile');

        return view('profile');
    }

    private function calculateYear($session)
    {
        return (env('APP_CURRENT_SESSION') - $session) / 10001;
    }
}
