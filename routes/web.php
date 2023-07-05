<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeAttendancesController;
use App\Http\Controllers\generateDtr;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\LeavecardsController;
use App\Http\Controllers\globalController;
use App\Http\Controllers\ValidationcodeController;
use App\Http\Controllers\Signatories;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LeaveapplicationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//** dashboard and dashboard components 
// ->middleware(['auth', 'verified'])
    Route::middleware("auth")->group(function(){  
        Route::get('/dashboard', [Dashboard::class,"dashboard"])->name('dashboard');
        Route::get('/', [Dashboard::class,"dashboard"])->name('dashboard');

        // ** for navigation in the dashboard 
            Route::get("/dashboard/leaveapplications", [Dashboard::class,"leaveapplications"])->name("leaveapplications");
        // * end 

        // ** leave components 
            Route::get("/vacationleave", [Dashboard::class,"vacationleave"])->name("vacationleave");
            Route::get("/sickleave", [Dashboard::class,"sickleave"])->name("sickleave");
            Route::get("/forcedleave",[Dashboard::class,"forcedleave"])->name('forcedleave');
        // *

        // ** saving multiple 
            Route::get("/savemultiple", [Dashboard::class,"savemultiple"])->name("savemultiple");
        // *

        // ** save to leave card table 
            Route::get("/savetoleavecard", [Dashboard::class,"savetoleavecard"])->name("savetoleavecard");
        // * end 
    });
// * end dashboard

Route::get('/verify/{qrcode?}', [ValidationcodeController::class,"verify"])->name('verify');
Route::post("/checkvaliddates", [LeaveapplicationsController::class,"checkvaliddates"])->name("checkvaliddates");

//** used as a test
// ===============================================================
    Route::get("/calculator", function(){
        echo ltrim("20", "0");

        $am_start    = "03:18:20";
        $thold_am_in = "9:00:00";
        if ($am_start > $thold_am_in) {
            echo "AM is greater than threshold";
        } else {
            echo "am is less than threshold";
        }
    })->name("calculator");

    Route::get("/testsig", function(){
        $sets = App\Models\User::get();

        foreach($sets as $s) {
            echo $s->name;
            echo $s->settings()->thenav;
        }
    });

    Route::get("/calculate_tardy_under", [TimeAttendancesController::class,"calculate_tardy_under"]);
// ===============================================================
//** end 

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware("auth")->group(function(){
    Route::get("/leavecabinet", function(){
        return view("leave/cabinet");
    })->name("leavecabinet");
    
    Route::get("/attendance/upload", function(){
        return view("attendance.upload");
    });
    
    Route::get("/attendance/generate", [generateDtr::class,"index"])->name("attendancegenerate");
    Route::get("/download/dtr",[generateDtr::class,"downloaddtr"])->name("downloaddtr");
    Route::get("/thedtr", function(){
        return view("pdf.dtr");
    });

    Route::post("/uploadtimelog", [TimeAttendancesController::class,'uploadtlog'])->name("uploadtimelog");

    // payslip
        Route::get("/sendpayslip",[TimeAttendancesController::class,"sendpayslip"])->name("sendpayslip");
        Route::post("/sendpayslip",[TimeAttendancesController::class,"sendpayslip"])->name("sendpayslip");
    // end payslip


    // **personnel administration 
        Route::get("/personnel/administration/{id?}", [PersonnelController::class,"administration"])->name("personneladministration");
        Route::match(array('GET','POST'),"/personnel/upload", [PersonnelController::class,"uploademployees"])->name("uploademployees");
        Route::get("/personnel/service-record/{id?}", [PersonnelController::class,"servicerecord"])->name("servicerecord");
        Route::get("/personnel/personnel-directory/{id?}",[PersonnelController::class,"personneldirectory"])->name("personneldirectory");
        Route::get("/personnel/reporting-analytics/{id?}",[PersonnelController::class,"reportinganalytics"])->name("reportinganalytics");

            // called from ajax :: personnel administration panel
                Route::get("/personnel/profile", [PersonnelController::class,"profile"])->name("theprofile");
                Route::get("/personnel/leavecredits",[LeavecardsController::class,"leavecredits"])->name("leavecredits");
            // end 

            // ** inside dashboard 
                Route::get("/loademployees",[PersonnelController::class,"displayemps"])->name("displayemps");
            // **
    // * end 

    // leave window
        Route::get("/leavewindowparent", function(){
           return view("leave.components.leavewindowparent");
        })->name("leavewindowparent");
    // end leave window

    // signatories 
        Route::get("/signatories",[Signatories::class,"edit"])->name("signatories");
    // end signatories

});

// ajax calls 
    Route::middleware("auth")->group(function(){
        Route::get("/showemployees", [generateDtr::class,"getemployees"])->name("showemployees");
        Route::post("/senddtr", [generateDtr::class,"senddtr"])->name("senddtr");
        Route::get("/getsignatories",[generateDtr::class,"getsignatories"])->name("getsignatories");
    });
// end 

// save per input 
    Route::middleware("auth")->group(function(){
        Route::get("/saveperinput", [globalController::class,"saveperinput"])->name("saveperinput");
        Route::post("/savethis", [globalController::class,"savethis"])->name("savethis");
    });
// end

// check existing data from table 
    Route::middleware("auth")->group(function(){
        Route::get("/checkexisting", [globalController::class,"checkexisting"])->name("checkexisting");
    });
// end 

// logout
    Route::middleware("auth")->group(function(){
        Route::get("/logout", function(){
            Auth::logout();

            return redirect()->route("dashboard");
        });
    });
// end logout

// applicants page 
    Route::get("/applicants", function(){
        echo "Displaying applicants";
    });
// end applicants page

require __DIR__.'/auth.php';
