<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeAttendancesController;
use App\Http\Controllers\generateDtr;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\globalController;
use App\Http\Controllers\ValidationcodeController;
use App\Http\Controllers\Signatories;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("/testtime", function(){
    
    for($i = 1;$i<=60;$i++) {
        echo substr($i/480, 0,6)."<br/>";
    }
    
})->name("testtime");

Route::get("/compute", function(){ // used for testing :: can be remove
    $period = new DatePeriod(
         new DateTime('2010-10-01'),
         new DateInterval('P1D'),
         new DateTime('2010-10-05')
    );

    foreach ($period as $key => $value) {
        // echo $value->format('Y-m-d')."<br/>";
    }

    $time1 = new DateTime('11:59:00');
    $time2 = new DateTime('12:00:00');
    $interval = $time1->diff($time2);

    if ($time1 > $time2) {
        echo "Time 1 is greater than time 2";
    } else if ($time1 < $time2) {
        echo "Time 1 is less than time 2";
    }

    echo "<br/>";
    // echo $interval->format('%h:%i')."<br/>";

    $hour = $interval->format("%h");
    $mins = $interval->format("%i");

    echo $hour;
    echo ":";
    echo $mins;

    if ($hour <= 9) {
        if ($hour < 9) {

        } else if ($hour == 9) {

        }
    } else {
        // overtime
    }

    echo "<br/>";

    $a = "01:02:00";
    $aa = "00:40:00";

    $secs = strtotime($aa)-strtotime("00:00:00");
    $result = date("H:i:s",strtotime($a)+$secs);
    echo $result;

    echo "<br/>";
    $am_start = "08:55:00";
    $pm_end   = "16:30:00";
    $under = null;
                                    $supposed_pm_out   = date("H:i:s", strtotime("+9 hours ".$am_start));
                                    $pm_under_t1       = new DateTime($pm_end);
                                    $pm_under_t2       = new DateTime($supposed_pm_out);
                                    $pm_under_interval = $pm_under_t1->diff($pm_under_t2);

                                    $pm_under_hour     = $pm_under_interval->format("%h");
                                    $pm_under_mins     = $pm_under_interval->format("%i");

                                    if ($pm_under_t1 < $pm_under_t2) {
                                        $pm_under_time = $pm_under_hour.":".$pm_under_mins;

                                        $secs_under    = strtotime($under)-strtotime("00:00:00");
                                        $under_result  = date("H:i:s", strtotime($pm_under_time)+$secs);

                                        $under         = $under_result;
                                    } else {
                                        echo "pm_under_t1" . "is greater than" . "pm_under_t2";
                                    }
    echo "hello".$under;

    echo "<br/>";

    $under1 = "00:30:00";
    $under2 = "00:31:00";

    $unders_secs = strtotime($under1)-strtotime("00:00:00");
    $res_under   = date("H:i:s", strtotime($under2)+$unders_secs);

    echo $res_under;

    echo "<br/>";
    echo number_format("0.018752",3). "<br/>";
    echo ceil( number_format("0.1252",2) );

    echo "<br/>";
    $am_start         = "09:02 AM";
    $thold_am_in      = "09:00:00";

                        if ($am_start > $thold_am_in) {
                            $supposed_pm_out  = "18:00:00";
                        } else {
                            $supposed_pm_out  = date("H:i:s", strtotime("+9 hours ".$am_start));
                        }
        echo $supposed_pm_out;

    echo "<br/>";
    $hour = "00";
    $mins = "05";
    $hrs_days  = number_format($hour/8,3); 
    $mins_days = number_format($mins/480,3);

    echo $mins_days."<br/>";
    return $hrs_days+$mins_days;
}); // END :: used for testing :: can be remove

Route::get('/verify/{qrcode?}', [ValidationcodeController::class,"verify"])->name('verify');

Route::get("/calculator", function(){
    return view("attendance.calculator");
})->name("calculator");

Route::get("/calculate_tardy_under", [TimeAttendancesController::class,"calculate_tardy_under"]);

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


    // personnel administration 
    Route::get("/personnel/administration/{id?}", [PersonnelController::class,"administration"])->name("personneladministration");
    Route::get("/personnel/upload", [PersonnelController::class,"uploademployees"])->name("uploademployees");
    Route::post("/personnel/upload",[PersonnelController::class,"uploademployees"])->name("uploademployees");
    Route::get("/personnel/service-record/{id?}", [PersonnelController::class,"servicerecord"])->name("servicerecord");
    Route::get("/personnel/personnel-directory/{id?}",[PersonnelController::class,"personneldirectory"])->name("personneldirectory");
    Route::get("/personnel/reporting-analytics/{id?}",[PersonnelController::class,"reportinganalytics"])->name("reportinganalytics");

        // called from ajax :: personnel administration panel
            Route::get("/personnel/profile", [PersonnelController::class,"profile"])->name("theprofile");
            Route::get("/personnel/leavecredits",[PersonnelController::class,"leavecredits"])->name("leavecredits");
        // end 
    // end 

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

// applicants page 
    Route::get("/applicants", function(){
        echo "Displaying applicants";
    });
// end applicants page


require __DIR__.'/auth.php';
