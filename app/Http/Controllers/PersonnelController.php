<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personnel;
use App\Models\positions;

use App\Models\area_offices;
use App\Models\offices;
use App\Models\divisions;

use App\Models\employment_types;
use App\Models\usersettings;
use App\Models\User;

use App\Process\DoleProcess;

use DB;
use Auth; 
class PersonnelController extends Controller
{
    //
    public function __construct() {
        
    }

    public function administration($id = false) {

        DoleProcess::checksettings("hrnav");

        $employees  = personnel::all();
        $positions  = positions::all();

        // get areas, offices, divisions
        $areas      = area_offices::all();
        $offices    = offices::all();
        $divisions  = divisions::all(); 

        // employment status
        $emp_status = employment_types::all();

        $selected   = [];

        $displaytabs = null; 

        if ($id != false) {
            $displaytabs = true;
        }

        if ($id == "new") {
            $newid = DB::table("personnels")->insertGetId([]);
            return redirect()->route("personneladministration",["id"=>$newid]);
        }

        return view("personnel.administration", compact("employees","selected","positions","areas","divisions","offices","emp_status","displaytabs"));
    }

    public function servicerecord() {
        return view("personnel.servicerecord");
    }

    public function personneldirectory() {
        return view("personnel.personneldirectory");
    }

    public function reportinganalytics() {
        return view("personnel.reportinganalytics");
    }

    public function profile(Request $req) {
        $selected    = personnel::where("perid",$req->input("thechosenid"))->get();

        $positions   = positions::where("status",$selected[0]->employment_type_id)->get();

        // get areas, offices, divisions
        $areas       = area_offices::all();
        $offices     = offices::all();
        $divisions   = divisions::all(); 

        // employment status
        $emp_status  = employment_types::all();

        // signatories 
        $signatories = [];

        $users        = User::where("id",$selected[0]->user_id)->get();
        $usersettings = usersettings::where("userid",$selected[0]->user_id)->get();

        return view("personnel.aplets.profile", compact("selected","positions","areas","offices","divisions","emp_status","usersettings","users"));
    }



    public function uploademployees(Request $req) {

        $uploaded = null;
        if ($req->method() == "POST") {
            // posting
            $file 	 	 = $req->file("thefile");        
            $tfile 		 = fopen($file,"r");

            $count       = 0;
                while(! feof($tfile)) {
                    $csvfile = fgetcsv($tfile);

                    if ($csvfile != false) {
                        if ($count != 0) {
                            $save = personnel::create([
                                    "biometricid"           => $csvfile[0],
                                    "fname"                 => htmlentities($csvfile[1]),
                                    "mname"                 => htmlentities($csvfile[2]),
                                    "lname"                 => htmlentities($csvfile[3]),
                                    "employment_type_id"    => $csvfile[4],
                                    "position_id"           => $csvfile[5],
                                    "area_office_id"        => $csvfile[6],
                                    "office_id"             => $csvfile[7],
                                    "division_id"           => $csvfile[8],
                                    "email"                 => $csvfile[9]
                                ]);
                        }
                    }
                    $count++;
                }
            $uploaded = "Uploaded";
        }

        return view("personnel.upload", compact("uploaded"));
    }
}
