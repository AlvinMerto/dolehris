<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\area_offices;
use App\Models\personnel;

class Signatories extends Controller
{
    //
    function edit() {
        $area_offices = area_offices::all();
        $personnel    = personnel::get(["lname","fname","mname","perid"]);
        return view("Signatories.Signatories",["offices"=>$area_offices,"personnel"=>$personnel]);
    }
}
