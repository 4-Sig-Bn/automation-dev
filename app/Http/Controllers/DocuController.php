<?php

namespace App\Http\Controllers;

use App\Models\Docu;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use Barryvdh\DomPDF\Facade\Pdf;
class DocuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("docu.index");
    }
// uploadIndex, uploadFile

    public function uploadIndex()
    {
        return view("docu.upload");
    }
    public function uploadFile(Request $request)
    {   

        $request->validate([
            'file' => 'required', // Ensure it's a PDF file and within size limit
            'branch' => 'required', // Validate branch selection
        ]);

        $file = $request->file('file');
        $originalFileName = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $randomString = Str::random(5);
        $fileName = $originalFileName . '-' . now()->format('YmdHis') . '-' . $randomString . '.' . $fileExtension;
        $destinationPath = 'upload/docu';

        $file->move($destinationPath, $fileName);
        $uploadDate = Carbon::now();


        // Save the upload date, file name, branch, and uploader ID in the 'docu' table
        $docu = new Docu();
        $docu->branch = $request->branch;
        $docu->file_name = $fileName;
        $docu->upload_date = $uploadDate; // Use Carbon to get the current date and time
        $docu->modified_date = null; // Assuming modified_date is null for newly uploaded files
        $docu->uploaded_by = Auth::id(); // Get the ID of the currently authenticated user
        $docu->save();

        return redirect()->route('docu.view')->with('success', 'ফাইলটি সফলভাবে আপলোড হয়েছে।');

    }

    public function view()
    {   
        $docus = Docu::with('uploader')->get();
        return view('docu.view', compact('docus'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    public function show(string $name)
    {   
        // Assuming $name contains the filename of the PDF file
    
        // Generate the PDF dynamically
        return response()->file(public_path('upload/docu/' . $name), ['content-type'=>'application/pdf']);

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
