<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personnel;
use App\Models\leavecards;
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
}
