<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\personnel;

use DB;

class globalController extends Controller
{
    // ajax call
    function saveperinput(Request $req) {
        // $db  = $req->input("db");
        $tbl = $req->input("tbl");
        $key = $req->input("key");
        $id  = $req->input('id');

        $fld = $req->input("fld");
        $val = $req->input("value");

        $update = DB::table($tbl)->where($key,$id)->update([$fld=>$val]);

        return response()->json($update);
    }

    function savethis(Request $req) {
        $data = (array) $req->input("thedata");
        $tbl  = $req->input("table");

        $ishash = $req->input("hash");

        if ( $ishash != false ){
            $tohash        = $data[$ishash];
            $data[$ishash] = Hash::make($tohash);
        }

        $data = array_merge($data, ['created_at' => date("Y-m-d H:i:s")]);
        $save = DB::table($req->input('table'))->insertGetId($data);

        return response()->json($save);
    }
    // end 
}
