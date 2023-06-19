<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;

class LeaveapplicationsController extends Controller
{
    //

    function checkvaliddates(Request $req) {
        $from         = $req->input("startdate");
        $to           = date("M d, Y", strtotime("+1 days ".$req->input("todate")));

        $applieddates = [];

        $period = new \DatePeriod(
                      new \DateTime($from),
                      new \DateInterval('P1D'),
                      new \DateTime($to)
                    );

        foreach ($period as $key => $value) {
            $theval   = $value->format('M d, Y');

            $day      = date("l", strtotime($theval));

            // add holiday restrictions
            if (strtolower($day) != "saturday" && strtolower($day) != "sunday") {
                array_push($applieddates,$theval);
            }
        }

        return response()->json($applieddates);
    }
}
