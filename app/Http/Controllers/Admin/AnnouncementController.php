<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.announcement.index', [
            'announcements' => Announcement::with('author')->orderByDesc('created_at')->paginate(10)
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
        return view('admin.announcement.create');
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
        $data = $request->validate([
            'message' => 'required|min:3',
            'featured' => 'required|in:0,1'
        ]);

        $data['author_id'] = auth()->user()->matric_no;

        Announcement::create($data);
        return redirect()->route('announcement.index')->with('message', ['type' => 'success', 'text' => 'Announcement has been successfully created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
        return view('admin.announcement.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
        $data = $request->validate([
            'message' => 'required|min:3',
            'featured' => 'required|in:0,1'
        ]);

        $announcement->update($data);
        return redirect()->route('announcement.index')->with('message', ['type' => 'success', 'text' => 'Announcement has been successfully updated!']);
    }

    /**
     * Feature the specified resource in storage.
     *
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\Response
     */
    public function feature(Announcement $announcement) {
        $announcement->featured = $announcement->featured === '0' ? '1' : '0';
        $announcement->save();

        return redirect()->route('announcement.index')->with('message', ['type' => 'success', 'text' => 'Announcement has been successfully featured!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Announcement $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
        try {
            $announcement->deleteOrFail();
            $data = [
                'type' => 'success',
                'text' => 'Announcement has been successfully deleted!'
            ];
        } catch (\Exception $e) {
            $data = [
                'type' => 'danger',
                'text' => 'Failed to delete #' . $announcement->id . '[Message: ' . $e->getMessage() . ']'
            ];
        }

        return redirect()->route('announcement.index')->with('message', $data);

    }
}
