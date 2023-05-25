<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\validationcode;
use App\Models\personnel;

class ValidationcodeController extends Controller
{
    //
    function verify($code = null) {
        $verifynow = validationcode::where("thecode",$code)->get();

        if (count($verifynow) > 0) {
            $emps = personnel::where("perid",$verifynow[0]->personnelid)->get(["lname","fname","mname"]);
            echo "owned by: ".$emps[0]->lname.",".$emps[0]->fname." ".$emps[0]->mname;
        } else {
            die("WE CANNOT VALIDATE THE CODE GIVEN");
        }
    }
}
