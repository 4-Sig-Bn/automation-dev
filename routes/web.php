<?php

use App\Http\Controllers\CarrierPlanController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ParadeStateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoldierProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DocuController;



// inbuilt routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// updated routes


// Public routes

Route::get('/', function () {
    return view('welcome');
});

// Private routes

Route::get('/dashboard', function () {

    // if (Auth::check() && Auth::user()->roles()->first()->name == 'admin') {
    if (Auth::check()) {

         $pCounts = DB::table('profiles')->count();
         $gpTCounts = DB::table('carrier_plans')
                         ->where('cycle_1', 'দলগত প্রশিক্ষণ')
                         ->count();
 
         $plTCounts = DB::table('carrier_plans')
                         ->where('cycle_1', 'বাৎসরিক ছুটি')
                         ->count();
         $adminTCounts = DB::table('carrier_plans')
                         ->where('cycle_1', 'প্রশাসনিক')
                         ->count();
         $indlTCounts = DB::table('carrier_plans')
                         ->where('cycle_1', 'একক প্রশিক্ষণ')
                         ->count();
         return view('dashboard', compact('pCounts','gpTCounts','plTCounts','adminTCounts','indlTCounts'));
     } 
     else {
         Auth::logout();
         return redirect('/');
     }
 })->middleware(['auth', 'verified'])->name('dashboard');

 Route::get('/download-backup', [SoldierProfileController::class, 'downloadBackup'])->middleware(['auth', 'verified'])->name('backup.download');

 Route::get('/database', function () {
     return view('database');
 })->middleware(['auth', 'verified'])->name('database');

 

// Soldier Profile routes

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/create-profile', [SoldierProfileController::class, 'create'])->name('soldierprofile.create');
    Route::post('/create-profile', [SoldierProfileController::class, 'store'])->name('soldierprofile.store');

    Route::get('/all-profiles', [SoldierProfileController::class, 'index'])->name('soldierprofile.index');
    Route::get('/view-profile/{id}', [SoldierProfileController::class, 'view'])->name('soldierprofile.view');

    Route::get('/edit-profile/{id}', [SoldierProfileController::class, 'edit'])->name('soldierprofile.edit');
    Route::post('/update-profile/{id}', [SoldierProfileController::class, 'update'])->name('soldierprofile.update');
    Route::delete('/delete-profile/{id}', [SoldierProfileController::class, 'destroy'])->name('soldierprofile.delete');

    Route::post('/profile-csv', [SoldierProfileController::class, 'csvUpload'])->name('soldierprofile.csvupload');
});


// Report routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/report', [ReportController::class, 'index'])->name('report.home');
    Route::get('/report/qm', [ReportController::class, 'indexQM'])->name('qmreport.home');
    Route::get('/report/qm/mt', [ReportController::class, 'mtReportIndex'])->name('mtreport.home');
    Route::post('/report/qm/mt', [ReportController::class, 'mtReportStore'])->name('mtreport.store');
    Route::get('/report/qm/mt/all', [ReportController::class, 'mtReportAll'])->name('mtreport.all');
});

// Carrier plan routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/carrier', [CarrierPlanController::class, 'home'])->name('carrier.home');
    Route::get('/create-carrier', [CarrierPlanController::class, 'create'])->name('carrier.create');
    Route::post('/create-carrier', [CarrierPlanController::class, 'store'])->name('carrier.store');
    Route::get('/carrier-index', [CarrierPlanController::class, 'index'])->name('carrier.index');
    Route::get('/edit-carrier/{id}', [CarrierPlanController::class, 'edit'])->name('carrier.edit');
    Route::post('/update-carrier/{id}', [CarrierPlanController::class, 'update'])->name('carrier.update');
    Route::delete('/delete-carrier/{id}', [CarrierPlanController::class, 'destroy'])->name('carrier.delete');

    //search userid
    Route::get('/search-profiles', [SoldierProfileController::class, 'search']);
});



// Document routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/docu', [DocuController::class, 'index'])->name('docu.index');
    Route::get('/docu/upload', [DocuController::class, 'uploadIndex'])->name('docu.upload');
    Route::post('docu/upload', [DocuController::class, 'uploadFile'])->name('docu.upload.post');
    Route::get('/docu/view', [DocuController::class, 'view'])->name('docu.view');
    Route::get('/docu/show/{name}', [DocuController::class, 'show'])->name('docu.show');
});


// Parade State route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/parade', [ParadeStateController::class, 'home'])->name('parade.home');
});


// IPFT Ret 

Route::get('/ipft-ret-home', [SoldierProfileController::class, 'create'])->middleware(['auth', 'verified'])->name('ipft-ret.home');


// configuration from admin
Route::get('/config', function () {
    return view('config.index');
})->middleware(['auth', 'verified'])->name('config.index');


// config - users 

Route::get('/users', [UsersController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');

Route::get('/config/users/create', function () {
    return view('config.user.index');
})->middleware(['auth', 'verified'])->name('users.create');

Route::get('/config/users/permissions', function () {
    return view('config.user.index');
})->middleware(['auth', 'verified'])->name('users.permit.index');



// leave 

Route::get('/leave-home', [LeaveController::class, 'home'])->middleware(['auth', 'verified'])->name('leave.home');
Route::get('/leave-create', [LeaveController::class, 'create'])->middleware(['auth', 'verified'])->name('leave.create');
Route::get('/leave-index', [LeaveController::class, 'index'])->middleware(['auth', 'verified'])->name('leave.index');

Route::post('/leave-create', [LeaveController::class, 'store'])->middleware(['auth', 'verified'])->name('leave.store');

Route::post('/leave-status-change/{id}', [LeaveController::class, 'statusChange'])->middleware(['auth', 'verified'])->name('leave.statusChange');
Route::get('/leave-edit/{id}', [LeaveController::class, 'edit'])->middleware(['auth', 'verified'])->name('leave.edit');
Route::post('/leave-update', [LeaveController::class, 'update'])->middleware(['auth', 'verified'])->name('leave.update');
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/  // backup



    // Route::get('/create-profile', [SoldierProfileController::class, 'create'])->name('soldierprofile.create');
    // Route::post('/create-profile', [SoldierProfileController::class, 'store'])->name('soldierprofile.store');
    // Route::get('/all-profiles', [SoldierProfileController::class, 'index'])->name('soldierprofile.index');
    // Route::get('/view-profile/{id}', [SoldierProfileController::class, 'view'])->name('soldierprofile.view');
    // Route::get('/edit-profile/{id}', [SoldierProfileController::class, 'edit'])->name('soldierprofile.edit');
    // Route::post('/update-profile/{id}', [SoldierProfileController::class, 'update'])->name('soldierprofile.update');
    // Route::delete('/delete-profile/{id}', [SoldierProfileController::class, 'destroy'])->name('soldierprofile.delete');
    // Route::post('/profile-csv', [SoldierProfileController::class, 'csvUpload'])->name('soldierprofile.csvupload');




    // Report
    

    // Route::get('/report', [ReportController::class, 'index'])->name('report.home');

    // //QM
    // Route::get('/report/qm', [ReportController::class, 'indexQM'])->name('qmreport.home');

    // //mt

    // Route::get('/report/qm/mt', [ReportController::class, 'mtReportIndex'])->name('mtreport.home');
    // Route::post('/report/qm/mt', [ReportController::class, 'mtReportStore'])->name('mtreport.store');
    // Route::get('/report/qm/mt/all', [ReportController::class, 'mtReportAll'])->name('mtreport.all');

    // carrier-plan

    // Route::get('/carrier', [CarrierPlanController::class, 'home'])->name('carrier.home');
    // Route::get('/create-carrier', [CarrierPlanController::class, 'create'])->name('carrier.create');
    // Route::post('/create-carrier', [CarrierPlanController::class, 'store'])->name('carrier.store');
    // Route::get('/carrier-index', [CarrierPlanController::class, 'index'])->name('carrier.index');
    // Route::get('/edit-carrier/{id}', [CarrierPlanController::class, 'edit'])->name('carrier.edit');
    // Route::post('/update-carrier/{id}', [CarrierPlanController::class, 'update'])->name('carrier.update');
    // Route::delete('/delete-carrier/{id}', [CarrierPlanController::class, 'destroy'])->name('carrier.delete');

    // Route::get('/search-profiles', [SoldierProfileController::class, 'search']);


    // Route::get('/ipft-ret-home', [SoldierProfileController::class, 'create'])->name('ipft-ret.home');
    
//parade
// Route::get('/parade', [ParadeStateController::class, 'home'])->name('parade.home');
// // config
//     Route::get('/config', function () {
//         return view('config.index');
//     })->name('config.index');

// docu

// Route::get('/docu', [DocuController::class, 'index'])->name('docu.index');
// Route::get('/docu/upload', [DocuController::class, 'uploadIndex'])->name('docu.upload');
// Route::post('docu/upload', [DocuController::class, 'uploadFile'])->name('docu.upload.post');
// Route::get('/docu/view', [DocuController::class, 'view'])->name('docu.view');


// Route::get('/docu/show/{name}', [DocuController::class, 'show'])->name('docu.show');



