<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personnel;
use App\Models\leavecards;
use App\Models\commutation;
use App\Models\vacationlocation;
use App\Models\leavetypes;
use App\Models\inclusivedates;
use App\Models\User;

use Auth;
class Dashboard extends Controller
{
    //

    function dashboard() {
         $userid = session("userid");

         $data   = personnel::where("user_id", $userid )->get();
        // // var_dump($data);

        // $prev_data = leavecards::where(["personnelid"=>"968","leavecardtype"=>1])
        //                                 ->orWhere("leavecardtype","fb")
        //                                 ->orderBy("leavecardpk","DESC")
        //                                 ->first()->toArray();

        // $user = User::get();

        // foreach($user as $u) {
        //     echo $u->name."<br/>";
        //     echo $u->settings()->thenav;
        // }

        
        return view("dashboard",compact("data"));
    }

    function leaveapplications() {
        $commutation = commutation::get();
        $leavetypes = leavetypes::get();

         $empid       = Auth::id();
        return view("dashboardcomponents.leaveapplications", compact("commutation","leavetypes","empid"));
    }

    function vacationleave() {
        $commutation = commutation::get();
        $vacationloc = vacationlocation::get();

        return view("leave.components.vacationleavewindow", compact("commutation","vacationloc"));
    }

    function sickleave() {
        return view("leave.components.sickleavewindow");
    }

    function forcedleave() {
        return view("leave.components.forcedleave");
    }

    function savemultiple(Request $req) {
        $table                  = "inclusivedates"; // $req->input("table");
        $thevalues              = (array) $req->input("thedates");
        $leaveid                = $req->input("leaveapplicationid");

        $alldata                = [];

        $ret                    = false;
        foreach($thevalues as $tv) {
            $ret = inclusivedates::create([
                "leaveapplicationid"    => $leaveid,
                "thedate"               => date("Y-m-d", strtotime($tv))
            ]);
        }

        return response()->json( $ret );
    }

    function savetoleavecard(Request $req) {
        $personnelid   = Auth::id();
        $leavecardtype = $req->input("leavetype");
        $particularid  = $req->input("particularid");

        

        // return response()->json([$leavecardtype,$particularid]);
        // get the leave card type from the table based from the ID 

        // personnel id 
        // leave card type
            // type of leave 
            // :: vacation leave 
            // :: sick leave 
        // particular type id -> points to the table specific to the type of leave 

    }
}
