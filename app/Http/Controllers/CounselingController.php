<?php

namespace App\Http\Controllers;

use App\Models\CounselingRequest;
use App\Models\Course;
use App\Models\CourseLecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CounselingController extends Controller
{
    // Show student counseling request page
public function userIndex()
{
    $userId = Auth::id();

    $courseIds = DB::table('orders')
                    ->where('user_id', $userId)
                    ->pluck('course_id');

    $courses = \App\Models\Course::whereIn('id', $courseIds)->get();

    $requests = \App\Models\CounselingRequest::where('user_id', $userId)
                    ->with('course', 'lecture')
                    ->latest()
                    ->get();

    return view('frontend.dashboard.counseling_request', compact('courses', 'requests'));
}

    // Store a new counseling request
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecture_id' => 'required|exists:course_lectures,id',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'mode' => 'required|in:online,offline',
            'description' => 'nullable|string',
        ]);

        CounselingRequest::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'lecture_id' => $request->lecture_id,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'mode' => $request->mode,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Counseling request submitted.');
    }

    // Instructor view of all requests
    public function instructorIndex()
    {
        $requests = CounselingRequest::with('user', 'course', 'lecture')->latest()->get();
        return view('instructor.counseling_management', compact('requests'));
    }

    // Accept/Decline with message
   public function reply(Request $request)
{
    $request->validate([
        'request_id' => 'required|exists:counseling_requests,id',
        'status' => 'required|in:accepted,declined',
        'teacher_reply' => 'nullable|string',
    ]);

    $req = CounselingRequest::findOrFail($request->request_id);
    $req->status = $request->status;
    $req->teacher_reply = $request->teacher_reply;
    $req->save();

    return redirect()->back()->with('success', 'Reply sent successfully.');
}

    // Instructor edit counseling request
public function update(Request $request)
{
    $request->validate([
        'request_id' => 'required|exists:counseling_requests,id',
        'preferred_date' => 'required|date',
        'preferred_time' => 'required',
        'mode' => 'required|in:online,offline',
        'teacher_reply' => 'nullable|string'
    ]);

    $req = CounselingRequest::findOrFail($request->request_id);
    $req->preferred_date = $request->preferred_date;
    $req->preferred_time = $request->preferred_time;
    $req->mode = $request->mode;
    $req->teacher_reply = $request->teacher_reply;
    $req->status = 'accepted';
    $req->save();

    return redirect()->back()->with('success', 'Counseling request updated.');
}


    // Get single request (for edit modal)
    public function getSingle($id)
    {
        $req = CounselingRequest::with('user', 'course', 'lecture')->findOrFail($id);
        return response()->json($req);
    }
}
