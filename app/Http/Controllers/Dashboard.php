<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\personnel;

class Dashboard extends Controller
{
    //

    function dashboard() {
        $userid = session("userid");

        $data   = personnel::where("user_id", $userid )->get();
        // var_dump($data);
        return view("dashboard",compact("data"));
    }
}
