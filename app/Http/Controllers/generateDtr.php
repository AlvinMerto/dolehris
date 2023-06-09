<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personnel;
use App\Models\time_attendances;

use App\Models\area_offices;
use App\Models\offices;
use App\Models\divisions;
use App\Models\Signatories;

use App\Models\Schedules;
use App\Models\employment_types;

use App\Process\DoleProcess;

use PDF;
use Mail;
use DB;

class generateDtr extends Controller
{
    //
    public function index() {
        // get areas, offices, divisions
        $areas       = area_offices::all();
        $offices     = offices::all();
        $divisions   = divisions::all(); 

        $emp_status = employment_types::all();

        return view("attendance.generate", compact("areas","offices","divisions","emp_status"));
    }

    // ajax calls
    public function getemployees(Request $req) {
        $area    = $req->input("area");

        $office  = $req->input("office");
        $div     = $req->input("division");
        $emptype = $req->input("emptype");

        $where['area_office_id']          = $area;

        // if ($office != "none") {
        //     $where['office_id']           = $office; // get from division table
        // }

        // if ($div != "none") {
        //     $where['division_id']         = $div; // get from unit table
        // }

        if ($emptype != "none") {
            $where['employment_type_id']  = $emptype;
        }

        $personnel = personnel::where($where)->get();
        // var_dump($where);
        return view("attendance.listofemployees", compact("personnel"));
    }

    public function senddtr(Request $req) {
        $bioid    = $req->input("biometricid");
        $thedate  = $req->input("thedate");
        $signname = $req->input('sign_name');
        $signpost = $req->input("sign_post");

        if (strlen($bioid) == 0) {
            return response()->json("nobioid");
        }
        // 04/01/2023 - 04/30/2023
        list($from, $to)                = explode("-",$thedate);

        // from 
        list($f_month, $f_day, $f_year) = explode("/",$from);

        // to 
        list($t_month, $t_day, $t_year) = explode("/",$to);

        // formatted 
        $formatted_from         = trim($f_year)."-".trim($f_month)."-".trim($f_day);
        $formatted_to           = trim($t_year)."-".trim($t_month)."-".trim($t_day);
        $formatted_to_counter   = date("Y-m-d", strtotime("+1 days ".$formatted_to));

        $timeanddate = time_attendances::where("biometricid",$bioid)->whereBetween("theattendance",[$formatted_from,$formatted_to_counter])->get();
        $empdata     = personnel::where("biometricid",$bioid)->get();

        $name        = $empdata[0]->fname." ".$empdata[0]->mname." ".$empdata[0]->lname;
        // $position    = $empdata[0]->

        $skeds       = Schedules::where(["areaid"=>$empdata[0]->area_office_id,"groupid"=>"1"])->orderBy("theorder","asc")->get(["timeexact","thetime"])->toArray();

        $schedule["morning_flexi_in"]    = $skeds[0]['thetime']; //"9:00:00";
        $schedule["morning_flexi_out"]   = $skeds[1]['thetime']; //"12:00:00";
        $schedule["afternoon_flexi_in"]  = $skeds[2]['thetime']; //"13:00:00";
        $schedule["afternoon_flexi_out"] = $skeds[3]['thetime']; //"18:00:00";

        $thedtr      = DoleProcess::compute_tardy_undertime($timeanddate, $formatted_from, $formatted_to_counter, $schedule, $empdata[0]->perid);

        $dets = [
                "Inclusive Date"  => date("F d, Y", strtotime($formatted_from))." - ".date("F d, Y", strtotime($formatted_to)),
                "Full Name"       => $name,
                "system verified" => "success"
        ];

        $validcode   = DoleProcess::savevalidation("DTR",$empdata[0]->perid, $dets);

        $data        = [
                        "timeanddate"   => $thedtr,
                        "fullname"      => $name,
                        "body"          => "Please find in the attached email your DTR.",
                        "thedate"       => date("F d, Y", strtotime($formatted_from))." - ".date("F d, Y", strtotime($formatted_to)),
                        "from"          => $formatted_from,
                        "to"            => $formatted_to_counter,
                        "signname"      => $signname,
                        "signpost"      => $signpost,
                        "validcode"     => $validcode[1],
                        "srccode"       => url('/').$validcode[1],
                        "emptype"       => $empdata[0]->employment_type_id
                       ];
        
        $d["email"]   = $empdata[0]->email;
        $d["title"]   = "Your DTR for ".date("F d, Y", strtotime($formatted_from))." to ".date("F d, Y", strtotime($formatted_to));
        $d['name']    = $name;
        $d['dtrdate'] = date("F d, Y", strtotime($formatted_from))." to ".date("F d, Y", strtotime($formatted_to));

        $pdf = PDF::loadView('pdf.dtr', $data);
        $pdf->setOption(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        
        $pdf->set_paper('8.5x13', 'portrait');
        // $pdf->set_paper("legal");
        // $pdf->set_paper("A4");
        
        if ( strlen($d["email"]) == 0 ) {
            return response()->json("noemail");
        } else {
            Mail::send('emails.dtrsent', $data, function($message)use($d, $pdf) {
                $message->to($d["email"], $d["email"])
                        ->from("no-reply@dole.gov.ph","DOLE HR")
                        ->subject($d["title"])
                        ->attachData($pdf->output(), $d['name']." DTR for ".$d['dtrdate'].".pdf");
            });

            return response()->json(true);
        }
    }
    // end ajax calls

    public function downloaddtr(Request $req) {
        $theids = (array) $req->input("theids");

        $ids     = $theids;

        $thedate  = $req->input("thedate");
        $signname = $req->input('sign_name');
        $signpost = $req->input("sign_post");

        $areaid   = $req->input("arealocation");
        
        // 04/01/2023 - 04/30/2023
        list($from, $to)                = explode("-",$thedate);

        // from 
        list($f_month, $f_day, $f_year) = explode("/",$from);

        // to 
        list($t_month, $t_day, $t_year) = explode("/",$to);

        // formatted 
        $formatted_from         = trim($f_year)."-".trim($f_month)."-".trim($f_day);
        $formatted_to           = trim($t_year)."-".trim($t_month)."-".trim($t_day);
        $formatted_to_counter   = date("Y-m-d", strtotime("+1 days ".$formatted_to));

        // $scheds                          = Schedules::where(["groupid"=>1,"areaid"=>]);

        // $schedule["morning_flexi_in"]    = "9:00:00";
        // $schedule["morning_flexi_out"]   = "12:00:00";
        // $schedule["afternoon_flexi_in"]  = "13:00:00";
        // $schedule["afternoon_flexi_out"] = "18:00:00";

        $filename               = $formatted_from."-".$formatted_to." DTRs";
        $html                   = "";
        $name                   = null;

        $skeds                  = Schedules::where(["areaid"=>$areaid,"groupid"=>"1"])->orderBy("theorder","asc")->get(["timeexact","thetime"])->toArray();

        $schedule["morning_flexi_in"]    = $skeds[0]['thetime']; //"9:00:00";
        $schedule["morning_flexi_out"]   = $skeds[1]['thetime']; //"12:00:00";
        $schedule["afternoon_flexi_in"]  = $skeds[2]['thetime']; //"13:00:00";
        $schedule["afternoon_flexi_out"] = $skeds[3]['thetime']; //"18:00:00";

        foreach($ids as $id) {
            $timeanddate     = time_attendances::where("biometricid",$id)->get();
            $empdata         = personnel::where("biometricid",$id)->get();

            // $name        = $empdata[0]->lname.", ".$empdata[0]->fname." ".$empdata[0]->mname;
            $name        = $empdata[0]->fname." ".$empdata[0]->mname." ".$empdata[0]->lname;
            $thedtr      = DoleProcess::compute_tardy_undertime($timeanddate, $formatted_from, $formatted_to_counter, $schedule, $empdata[0]->perid);

            $dets = [
                "Inclusive Date"  => date("F d, Y", strtotime($formatted_from))." - ".date("F d, Y", strtotime($formatted_to)),
                "Full Name"       => $name,
                "system verified" => "success"
            ];

            $validcode   = DoleProcess::savevalidation("DTR",$empdata[0]->perid, $dets);

            $data        = [
                        "timeanddate"   => $thedtr,
                        "fullname"      => $name,
                        "body"          => "Please find in the attached email your DTR.",
                        "thedate"       => date("F d, Y", strtotime($formatted_from))." - ".date("F d, Y", strtotime($formatted_to)),
                        "from"          => $formatted_from,
                        "to"            => $formatted_to_counter,
                        "signname"      => $signname,
                        "signpost"      => $signpost,
                        "validcode"     => $validcode[1],
                        "srccode"       => url('/').$validcode[1],
                        "emptype"       => $empdata[0]->employment_type_id
                       ];

            $view   = view("pdf.dtr", $data);
            $html   .= $view->render();
        }

        $pdf        = PDF::loadHTML($html);

        //$customPaper = array(0,0,567.00,283.80);
        
        $pdf->setOption(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        // $pdf->set_paper("legal");
        $pdf->set_paper('8.5x13', 'portrait');

        if (count($theids) == 1) {
            $filename     .= " for ".$name;
        }
        
        return $pdf->download($filename.".pdf");

    }

    function getsignatories(Request $req) {
        $signatory = DB::table("area_offices")
                                ->join("personnels","area_offices.thesignatory","=","personnels.perid")
                                ->join("positions","personnels.position_id","=","positions.positionpk")
                                ->where("area_offices.areaofficepk",$req->input("areaid"))
                                ->get(["personnels.fname","personnels.mname","personnels.lname","positions.theposition"]);

        return response()->json(["name"=>trim($signatory[0]->fname)." ".trim($signatory[0]->mname)."".trim($signatory[0]->lname),"position"=>$signatory[0]->theposition]);
    }
}
