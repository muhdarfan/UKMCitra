<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only([
            'index',
            'show',
            'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.feedback.index', [
            'feedback' => Feedback::with('author')->orderByDesc('created_at')->orderByDesc('id')->paginate(5)
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
        return view('student.feedback');
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
        $request->validate([
            'feedback' => 'required|min:10|max:256'
        ]);

        Feedback::create([
            'matric_no' => auth()->user()->matric_no,
            'comment' => $request->input('feedback')
        ]);

        return redirect()->route('user_feedback')->with('success', 'Thank you for your feedback!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Feedback $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
        $id = $feedback->id;
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', "Feedback $id has been deleted successfully.");
    }
}
