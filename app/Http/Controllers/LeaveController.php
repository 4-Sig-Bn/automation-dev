<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class LeaveController extends Controller
{    public function home()
    {
        // Assuming you want to show a list of profiles to select from

        return view('leave.home');
    }

    public function index()
    {
        // Assuming you want to show a list of profiles to select from
        $leaves = Leave::with('profile')->get();

        return view('leave.index', compact('leaves'));
    }
    public function create()
    {
        // Assuming you want to show a list of profiles to select from
        $profiles = Profile::all();
        return view('leave.create', compact('profiles'));
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'number' => 'required|string', // Validate the profile number
            'start_date' => 'required|date',
            'joining_date' => 'required|date',
            'reason' => 'required|string',
            'type' => 'required|string',
            'ordered_by' => 'required|string',
            'applicant_name' => 'required|string',
        ]);

        $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $joinDate = Carbon::createFromFormat('d/m/Y', $request->joining_date)->format('Y-m-d');

        // Retrieve the profile based on the provided number
        $profile = Profile::where('number', $request->number)->first();

        // Check if the profile exists
        if (!$profile) {
            return back()->withErrors(['number' => 'Invalid profile number.']); // Redirect back with an error message
        }

        // Create a new Leave instance
        $leave = new Leave();
        $leave->profile_id = $profile->id; // Assign the profile ID
        $leave->start_date = $startDate;
        $leave->end_date = $joinDate;
        $leave->reason = $request->reason;
        $leave->type = $request->type;
        $leave->ordered_by = $request->ordered_by;
        $leave->applicant_name = $request->applicant_name;
        $leave->status = 'pending'; // Set default status to pending
        $leave->approved_by = null; // Initially set to null until approved
        $leave->save();

        // Redirect back with success message
        return redirect()->route('leaves.create')->with('success', 'Leave request submitted successfully.');
    } catch (\Exception $e) {
        // Log any errors that occur
        Log::error('Error occurred while storing leave request: ' . $e->getMessage());
        // Redirect back with error message
        return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.']);
    }
}

public function statusChange($id, Request $request)
{
    // Retrieve the leave instance by its ID
    $leave = Leave::findOrFail($id);

    // Update the status of the leave based on the status value in the request
    $leave->status = $request->status;
    $leave->save();

    // Redirect back or return a response as needed
    return redirect()->back()->with('success', 'Leave status updated successfully.');
}

public function edit($id)
{
    // Retrieve the leave instance by its ID
    $leave = Leave::findOrFail($id);

    $startDate = Carbon::createFromFormat('Y-m-d', $leave->start_date)->format('d/m/Y');
    $joinDate = Carbon::createFromFormat('Y-m-d', $leave->end_date)->format('d/m/Y');
    // Redirect back or return a response as needed
    return view('leave.edit', compact('leave','startDate','joinDate'));
}

// public function update($request)
// {
//     // Retrieve the leave instance by its ID
//     $leave = Leave::findOrFail($request->id);

//     $startDate = Carbon::createFromFormat('Y-m-d', $leave->start_date)->format('d/m/Y');
//     $joinDate = Carbon::createFromFormat('Y-m-d', $leave->end_date)->format('d/m/Y');
//     // Redirect back or return a response as needed
//     return view('leave.edit', compact('leave','startDate','joinDate'));
// }

public function update(Request $request)
{
    // Retrieve the leave instance by its ID
    $leave = Leave::findOrFail($request->id);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'start_date' => 'required|date_format:d/m/Y',
        'joining_date' => 'required|date_format:d/m/Y',
        'reason' => 'required|string',
        'type' => 'required|string',
        'ordered_by' => 'required|string',
        'applicant_name' => 'required|string',
    ]);

    $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
    $joinDate = Carbon::createFromFormat('d/m/Y', $request->joining_date)->format('Y-m-d');
    // Update the leave instance with the validated data
    $leave->update([
        'start_date' => $startDate,
        'end_date' => $joinDate,
        'reason' => $validatedData['reason'],
        'type' => $validatedData['type'],
        'ordered_by' => $validatedData['ordered_by'],
        'applicant_name' => $validatedData['applicant_name'],
    ]);

    // Redirect back or return a response as needed
    return redirect()->route('leave.index')->with('success', 'Leave application updated successfully.');
}


}
