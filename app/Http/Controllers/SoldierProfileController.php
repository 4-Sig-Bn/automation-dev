<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use App\Helpers\MaritalStatusHelper;
use App\Helpers\CoyStatusHelper;
use App\Helpers\StatusHelper;
use DateTime;


class SoldierProfileController extends Controller


{

    public function downloadBackup()
    {
        // Define database connection variables
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
    
        // Create a temporary file to store the backup
        $backupFile = 'backup.sql';
    
        // Build the command to create the backup
        $command = "C:\\xampp\\mysql\\bin\\mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$backupFile} 2>&1";
    
        // Execute the command
        $output = shell_exec($command);
    
        // Check if the backup was successful
        if ($output === null) {
            // Set headers to force download
            return response()->download($backupFile)->deleteFileAfterSend();
        } else {
            // Handle backup failure
            return back()->with('error', 'Backup failed.');
        }
    }
    
    
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {   
        $maritalStatusOptions = MaritalStatusHelper::getOptions();
        $coyStatusOptions = CoyStatusHelper::getOptions();
        $tradeStatusOptions = StatusHelper::getTradeOptions();

        return view('profiles.create', compact('maritalStatusOptions','coyStatusOptions','tradeStatusOptions'));
    }

    
    public function store(Request $request)
    {      

        try {
        $request->validate([

            'image' => 'required',
            'number_type' => 'required',
            
            'number' => 'required',
            'rank' => 'required',
            'trade' => 'required',
            'name' => 'required',
            'coy' => 'required',
            'marital_status' => 'required',
            'blood_gp' => 'required',

            'height_feet' => 'required',
            'height_inch' => 'required',
            'weight' => 'required',

            'present_address' => 'required',
            
            'vil' => 'required',
            'union' => 'required',
            'upazila' => 'required',
            'po' => 'required',
            'district' => 'required',

            'distance_from_border' => 'required',
            
            'birth_date' => 'required',
            'enrolment_date' => 'required',
            'unit_join_date' => 'required',
            'retirement_date' => 'required',


        ]);

        //image 

        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $originalFileName . '-' . now()->format('YmdHis') . '-' . '.' . $fileExtension;
        $destinationPath = 'upload/profileImage';
        $file->move($destinationPath, $fileName);

        $birthDate = Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d');
        $enrolmentDate = Carbon::createFromFormat('d/m/Y', $request->enrolment_date)->format('Y-m-d');
        $unitJoinDate = Carbon::createFromFormat('d/m/Y', $request->unit_join_date)->format('Y-m-d');
        $retirementDate = Carbon::createFromFormat('d/m/Y', $request->retirement_date)->format('Y-m-d');
            
        Profile::create([
            
                'image' => $fileName,
                'number_type' => $request->number_type,
                'number' => $request->number,
                'rank' => $request->rank,
                'trade' => $request->trade,
                'name' => $request->name,
                'coy' => $request->coy,
                'marital_status' => $request->marital_status,

                'blood_gp' => $request->blood_gp,

                'height_feet' => $request->height_feet,
                'height_inch' => $request->height_inch,
                'weight' => $request->weight,
                'present_address' => $request->present_address,
                'vil' => $request->vil,

                'union' => $request->union, 
                'upazila' => $request->upazila,
                'po' => $request->po,
                'district' => $request->district,

                'distance_from_border' => $request->distance_from_border,




                'birth_date' => $birthDate,
                'enrolment_date' => $enrolmentDate,
                'unit_join_date' => $unitJoinDate,
                'retirement_date' => $retirementDate,

                'punishment' => $request->punishment,
                // Include any other fields you want to save
            ]);

            return redirect()->route('database')->with('success', 'Profile created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to create profile. ' . $e->getMessage());
        }
        
        // return redirect()->route('profiles.index')
        //     ->with('success', 'Profile created successfully.');
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }
    

    public function edit($id)
    {   
        $maritalStatusOptions = MaritalStatusHelper::getOptions();
        $coyStatusOptions = CoyStatusHelper::getOptions();
        $tradeStatusOptions = StatusHelper::getTradeOptions();
        // Assuming Profile is your model
        $profile = Profile::find($id);

        $birthDate = Carbon::createFromFormat('Y-m-d', $profile->birth_date)->format('d/m/Y');
        $enrolmentDate = Carbon::createFromFormat('Y-m-d', $profile->enrolment_date)->format('d/m/Y');
        $unitJoinDate = Carbon::createFromFormat('Y-m-d', $profile->unit_join_date)->format('d/m/Y');
        $retirementDate = Carbon::createFromFormat('Y-m-d', $profile->retirement_date)->format('d/m/Y');

        // Check if the profile exists
        if (!$profile) {
            abort(404); // or handle the case when the profile is not found
        }
    
        return view('profiles.edit', compact('profile','birthDate','enrolmentDate','unitJoinDate','retirementDate','tradeStatusOptions','coyStatusOptions','maritalStatusOptions'));
    }

    public function view($id) {
        $maritalStatusOptions = MaritalStatusHelper::getOptions();
        $coyStatusOptions = CoyStatusHelper::getOptions();
        $tradeStatusOptions = StatusHelper::getTradeOptions();
        // Assuming Profile is your model
        $profile = Profile::find($id);

        $birthDate = Carbon::createFromFormat('Y-m-d', $profile->birth_date)->format('d/m/Y');
        $birthDateObject = DateTime::createFromFormat('d/m/Y', $birthDate);
        $enrolmentDate = Carbon::createFromFormat('Y-m-d', $profile->enrolment_date)->format('d/m/Y');
        $unitJoinDate = Carbon::createFromFormat('Y-m-d', $profile->unit_join_date)->format('d/m/Y');
        $retirementDate = Carbon::createFromFormat('Y-m-d', $profile->retirement_date)->format('d/m/Y');

        $today = new DateTime('today');
        $age = $birthDateObject->diff($today);

        $enrolmentDateObj =DateTime::createFromFormat('d/m/Y', $enrolmentDate);
        $serviceAge = $enrolmentDateObj->diff($today);
        // Check if the profile exists
        if (!$profile) {
            abort(404); // or handle the case when the profile is not found
        }
    
        return view('profiles.view', compact('age','profile','birthDate','serviceAge','enrolmentDate','unitJoinDate','retirementDate','tradeStatusOptions','coyStatusOptions','maritalStatusOptions'));

    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $profiles = Profile::where('number', 'like', '%' . $query . '%')->get();

    return response()->json(['data' => $profiles]);
}

    

  

    public function update(Request $request, $id)
    {   
        

        $profile = Profile::findOrFail($id);

        $request->validate([
            'number_type' => 'required',
            'number' => 'required',
            'rank' => 'required',
            'trade' => 'required',
            'name' => 'required',
            'coy' => 'required',
            'marital_status' => 'required',
            'blood_gp' => 'required',

            'height_feet' => 'required',
            'height_inch' => 'required',
            'weight' => 'required',

            'present_address' => 'required',
            
            'vil' => 'required',
            'union' => 'required',
            'upazila' => 'required',
            'po' => 'required',
            'district' => 'required',

            'distance_from_border' => 'required',
            
            'birth_date' => 'required',
            'enrolment_date' => 'required',
            'unit_join_date' => 'required',
            'retirement_date' => 'required',
        ]);
    
        // Convert the date fields to the correct format
        $birthDate = Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d');
        $enrolmentDate = Carbon::createFromFormat('d/m/Y', $request->enrolment_date)->format('Y-m-d');
        $unitJoinDate = Carbon::createFromFormat('d/m/Y', $request->unit_join_date)->format('Y-m-d');
        $retirementDate = Carbon::createFromFormat('d/m/Y', $request->retirement_date)->format('Y-m-d');
    
        if ($request->hasFile('image')) {


            unlink(public_path('upload/profileImage/' . $profile->image));
            // Storage::delete('upload/profileImage/' . $prefileName);

            $file = $request->file('image');
            $originalFileName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = $originalFileName . '-' . now()->format('YmdHis') . '-' . '.' . $fileExtension;
            $destinationPath = 'upload/profileImage';
            $file->move($destinationPath, $fileName);

            $profile->update([
                'image' => $fileName,
             ]);
        }
        // Update the profile with the formatted date fields
        $profile->update([
                'number_type' => $request->number_type,
                'number' => $request->number,
                'rank' => $request->rank,
                'trade' => $request->trade,
                'name' => $request->name,
                'coy' => $request->coy,
                'marital_status' => $request->marital_status,

                'blood_gp' => $request->blood_gp,

                'height_feet' => $request->height_feet,
                'height_inch' => $request->height_inch,
                'weight' => $request->weight,
                'present_address' => $request->present_address,
                'vil' => $request->vil,

                'union' => $request->union, 
                'upazila' => $request->upazila,
                'po' => $request->po,
                'district' => $request->district,

                'distance_from_border' => $request->distance_from_border,

                'birth_date' => $birthDate,
                'enrolment_date' => $enrolmentDate,
                'unit_join_date' => $unitJoinDate,
                'retirement_date' => $retirementDate,
        ]);

        
    
        return redirect()->route('soldierprofile.index')
            ->with('success', 'Profile updated successfully.');
    }
    

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $fileName = $profile->image;

        // Delete the profile record from the database
        $profile->delete();
    
        // Delete the image file from the storage
        unlink(public_path('upload/profileImage/' . $profile->image));

        $profile->delete();

        return redirect()->route('soldierprofile.index')
            ->with('success', 'Profile deleted successfully.');
    }


    public function csvUpload(Request $request)
    {
        // Validate the uploaded CSV file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048', // Validate CSV file
        ]);
    
        // Get the uploaded file
        $file = $request->file('csv_file');
    
        // Open the CSV file for reading
        if (($handle = fopen($file->getPathname(), 'r')) !== false) {
            try {
                // Skip the header line
                fgetcsv($handle);
    
                // Read and process the actual data
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    // Assuming the CSV file has columns in the order: Name, Number, Rank, etc.
                    Profile::create([
                        'name' => $data[0],
                        'number' => $data[1],
                        'rank' => $data[2],
                        'trade' => $data[3],
                        'coy' => $data[4],
                        'marital_status' => $data[5],
                        'birth_date' => '1976-01-01', // Default value for birth_date
                        'enrolment_date' => '1976-01-01', // Default value for enrolment_date
                        'unit_join_date' => '1976-01-01', // Default value for unit_join_date
                        // Add more fields as needed
                    ]);
                }
            } catch (\Exception $e) {
                // Handle any exceptions that occur during CSV processing
                // Log the error or perform any necessary actions
                fclose($handle);
                return back()->with('error', 'An error occurred while processing the CSV file.');
            }
    
            // Close the CSV file
            fclose($handle);
    
            // Redirect back to the index page with a success message
            return redirect()->route('soldierprofile.index')->with('success', 'CSV file uploaded successfully.');
        } else {
            // If unable to open the CSV file, redirect back with an error message
            return back()->with('error', 'Unable to open the CSV file.');
        }
    }
    
}
