<?php

namespace App\Http\Controllers;
use App\Models\MTReport;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.home');
    }

    public function  indexQM()
    {
        return view('reports.qm.home');
    }

    public function  mtReportIndex()
    {
        return view('reports.qm.mt.index');
    }

    public function  mtReportAll()
    {    
        $reports = MTReport::all();
        return view('reports.qm.mt.all', compact('reports'));
    }
    
    public function  mtReportStore(Request $request)
    {   
        $request->validate([
        'content' => 'required',
    ]);
       $date = date('Y-m-d H:i:s');

        MTReport::create([
            'content' => $request->content,
            'date' => $date
            // Include any other fields you want to save
        ]);

    return redirect()->route('mtreport.all');
    }


}
