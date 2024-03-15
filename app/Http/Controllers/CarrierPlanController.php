<?php

namespace App\Http\Controllers;
use App\Helpers\StatusHelper;

use Illuminate\Http\Request;
use App\Models\CarrierPlan;
use App\Models\Profile;

class CarrierPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        return view('carrier.home');
    }
    public function index()
    {
        $carriers = CarrierPlan::with('profile')->get();
        return view('carrier.index', compact('carriers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carrierStatusOptions = StatusHelper::getCarrrierOptions();

        return view('carrier.create', compact('carrierStatusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Validate incoming request
         $validatedData = $request->validate([
             'number' => 'required', // Assuming 'number' corresponds to the profile number
             'cycle_status_1' => 'required', // Add validation rules for other fields as needed
             'cycle_status_2' => 'required',
             'cycle_status_3' => 'required',
             'cycle_status_4' => 'required',
         ]);
     
         // Find the profile based on the provided number
         $profile = Profile::where('number', $validatedData['number'])->first();
     
         // Check if the profile exists
         if (!$profile) {
             return redirect()->back()->with('error', 'Profile not found.');
         }
     
         // Create a new Carrier Plan instance with mass assignment
         $carrierPlan = CarrierPlan::create([
             'profile_id' => $profile->id,
             'year' => '2024', 
             'cycle_1' => $validatedData['cycle_status_1'],
             'cycle_2' => $validatedData['cycle_status_2'],
             'cycle_3' => $validatedData['cycle_status_3'],
             'cycle_4' => $validatedData['cycle_status_4'],
         ]);
     
         // Redirect to the appropriate page (e.g., index page)
         return redirect()->route('carrier.index')->with('success', 'Carrier Plan created successfully!');
     }
     
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
