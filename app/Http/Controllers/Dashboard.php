<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personnel;
use App\Models\leavecards;
use App\Models\commutation;
use App\Models\vacationlocation;
use App\Models\User;

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
        return view("dashboardcomponents.leaveapplications", compact("commutation"));
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
}
