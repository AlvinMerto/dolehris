<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personnel;

class LeavecardsController extends Controller
{
    //

    public function leavecredits(Request $req) {
        $selected  = personnel::where("perid",$req->input("thechosenid"))->get();

        

        return view("personnel.aplets.leavecredits", compact("selected"));
    }
}
