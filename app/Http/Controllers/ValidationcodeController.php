<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\validationcode;
use App\Models\personnel;
use App\Models\details;

class ValidationcodeController extends Controller
{
    //
    function verify($code = null) {
        $verifynow = validationcode::where("thecode",$code)->get();

        if (count($verifynow) > 0) {
            $emps = details::where("groupid",$verifynow[0]->detailsid)->get();
            echo "<table>";
                foreach($emps as $e) {
                    echo "<tr>";
                        echo "<td> {$e->thefield} </td>";
                        echo "<td> {$e->thevalue} </td>";
                    echo "</tr>";
                }
            echo "</table>";
        } else {
            die("WE CANNOT VALIDATE THE CODE GIVEN");
        }
    }
}
