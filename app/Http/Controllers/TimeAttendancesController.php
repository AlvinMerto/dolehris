<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time_attendances;
use App\Models\personnel;

use App\Process\DoleProcess;

use DateTime;
use PDF;
use Mail;

class TimeAttendancesController extends Controller
{
    //

    function uploadtlog(Request $req) {
        $file 	 	  = $req->file("employeetimelog");        
        $tfile 		  = fopen($file,"r");

        $personalinfo = file($file);
            
        foreach($personalinfo as $p) {
            //$a = (string) $personalinfo[0];

            $a = $p;
            $a = trim($a);
            $b = explode(" ", $a);
            $c = implode(" ", $b);
            
            $new_c = str_replace("\t"," ", $c);

            // Array ( [0] => 24 [1] => 2023-04-01 [2] => 07:34:00 [3] => 1 [4] => 1 [5] => 1 [6] => 0 )
            list($id, $thedate, $thetime, $num1, $num2, $num3, $num4) = explode(" ", $new_c);
            
            // 1010 = IN
            // 1110 = OUT

            $tick = $num1.$num2.$num3.$num4;

            // 
            $cstatus = null;
            if ($tick == "1010") {
                $cstatus = "c/in";
            } else if ($tick == "1110") {
                $cstatus = "c/out";
            }

            $timeactual = null;
            if ($cstatus == "c/in") {
                if ( date("H", strtotime($thetime)) < 12 ) {
                    $timeactual = "am_start";
                } else if ( date("H", strtotime($thetime)) == 12) {
                    $timeactual = "pm_start";
                }
            } else if ($cstatus == "c/out") {
                if ( date("H", strtotime($thetime))  == 12 ) {
                    $timeactual = "am_end";
                } else if ( date("H", strtotime($thetime)) > 12 ) {
                    $timeactual = "pm_end";
                }
            }

            if ($timeactual != null) {
                $save = time_attendances::create([
                                    "biometricid"   => $id,
                                    "theattendance" => $thedate." ".$thetime,
                                    "cstatus"       => $cstatus,
                                    "timeactual"    => $timeactual,
                                    "status"        => 1
                                ]);
                // echo $save->id."<br/>";
                
            }   

            // if ($id == "24") {
            //     echo $thedate." ".$thetime." | =".date("H", strtotime($thetime))." | ".$cstatus." | ".$timeactual."<br/>";
            // }
        }

        // for csv files
            // $count       = 0;

            // while(! feof($tfile)) {
            //     $csvfile = fgetcsv($tfile);

            //     if ($csvfile != false) {
            //         if ($count != 0) {
            //             $save = time_attendances::create([
            //                     "biometricid"   => $csvfile[0],
            //                     "theattendance" => $csvfile[1],
            //                     "cstatus"       => $csvfile[2],
            //                     "timeactual"    => $csvfile[3],
            //                     "status"        => $csvfile[4]
            //                 ]);
            //         }
            //     }
            //     $count++;
            // }
        // end for csv

        return redirect()->route("attendancegenerate")->with(["msg"=>"Timelog has been uploaded."]);
        // return view("attendance.generate");
    }

    function calculate_tardy_under(Request $req) {
        $am_start        = $req->input("am_in");
        $am_end          = $req->input("am_out");
        $pm_start        = $req->input("pm_in");
        $pm_end          = $req->input("pm_out");

        $total_undertime = "00:00:00";
        $total_tardiness = "00:00:00";

        $under_equiv_day = "0";
        $tardy_equiv_day = "0";

        $under           = "0";
        $tardy           = "0";

        $ismonday = false;
                    if ($am_start != null && $am_end != null && $pm_start != null && $pm_end != null) {
                            $thold_am_in      = "09:00:00";
                            $thold_am_out     = "12:00:00";
                            $thold_pm_in      = "13:00:00";

                            if ($am_start > $thold_am_in) {
                                $supposed_pm_out  = "18:00:00";
                            } else {
                                // the threshold for the PM OUT is 9 hours from AM IN :: including the 12NN to 1PM break
                                $supposed_pm_out  = date("H:i:s", strtotime("+9 hours ".$am_start));
                            }
                            
                            if ($ismonday) {
                                $thold_am_in      = "08:00:00";
                                $thold_am_out     = "12:00:00";
                                $thold_pm_in      = "13:00:00";
                                $supposed_pm_out  = "17:00:00";
                            } else {
                                
                            } // end big else

                            // start tardiness
                                    // =====================================
                                    // compute for morning tardiness
                                    $am_time1 = new DateTime($am_start); 
                                    $am_time2 = new DateTime($thold_am_in);
                                    $interval = $am_time1->diff($am_time2);

                                    $am_tardy_hour = $interval->format("%h");
                                    $am_tardy_mins = $interval->format("%i");

                                    if ($am_time1 > $am_time2) {
                                        // tardy morning
                                         $tardy = $am_tardy_hour.":".$am_tardy_mins;
                                        // $tardy  = ($am_tardy_hour*60)+$am_tardy_mins;
                                    }
                                    // end computation of morning tardiness
                                   // =====================================

                                    // =====================================
                                    // computation for afternoon tardy
                                    $pm_time1    = new DateTime($pm_start);
                                    $pm_time2    = new DateTime($thold_pm_in);
                                    $interval_pm = $pm_time1->diff($pm_time2);

                                    $pm_tardy_hour = $interval_pm->format("%h");
                                    $pm_tardy_mins = $interval_pm->format("%i");

                                    if ($pm_time1 > $pm_time2) {
                                        $pm_tardy = $pm_tardy_hour.":".$pm_tardy_mins;
                                        
                                        $secs   = strtotime($tardy)-strtotime("00:00:00");
                                        $result = date("H:i:s",strtotime($pm_tardy)+$secs);

                                        $tardy  = $result;
                                    }
                                    // end computation of afternoon tardy
                                    // =====================================
                                // end tardiness

                                // undertime
                                    // morning undertime
                                        $am_under_t1       = new DateTime($am_end);
                                        $am_under_t2       = new DateTime($thold_am_out);
                                        $am_interval_under = $am_under_t1->diff($am_under_t2);

                                        $am_under_hour     = $am_interval_under->format("%h");
                                        $am_under_mins     = $am_interval_under->format("%i");

                                        if ($am_under_t1 < $am_under_t2) {
                                            // $under = ($am_under_hour*60)+$am_under_mins;
                                            $under    = $am_under_hour.":".$am_under_mins;
                                        }
                                    // end morning undertime

                                    // afternoon undertime 
                                        $pm_under_t1       = new DateTime($pm_end);
                                        $pm_under_t2       = new DateTime($supposed_pm_out);
                                        $pm_under_interval = $pm_under_t1->diff($pm_under_t2);

                                        $pm_under_hour     = $pm_under_interval->format("%h");
                                        $pm_under_mins     = $pm_under_interval->format("%i");

                                        if ($pm_under_t1 < $pm_under_t2) {
                                            $pm_under_time = $pm_under_hour.":".$pm_under_mins;

                                            $secs_under    = strtotime($under)-strtotime("00:00:00");
                                            $under_result  = date("H:i:s", strtotime($pm_under_time)+$secs_under);

                                            $under         = $under_result;
                                        } 
                                    // end afternoon undertime
                                // undertime 

                            // compute for the total undertime
                                $unders_secs       = strtotime($total_undertime)-strtotime("00:00:00");
                                $total_undertime   = date("H:i:s", strtotime($under)+$unders_secs);
                            // end for the computation of total undertime

                            // compute for the total tardiness 
                                $tardy_secs        = strtotime($total_tardiness)-strtotime("00:00:00");
                                $total_tardiness   = date("H:i:s", strtotime($tardy)+$tardy_secs);
                            // end for the computation of total tardiness

                            // undertime breakdown to hour and mins
                            $under_hour   = explode(":", $total_undertime)[0];
                            $under_mins   = explode(":", $total_undertime)[1];

                            // tardiness breakdown to hour and mins
                            $tardy_hour    = explode(":", $total_tardiness)[0]; 
                            $tardy_mins    = explode(":", $total_tardiness)[1];

                            $under_equiv_day         = DoleProcess::convert_to_days($tardy_hour, $tardy_mins);
                            $tardy_equiv_day         = DoleProcess::convert_to_days($under_hour, $under_mins);
                  
                        }
        $data = [
            "undertime" => $total_undertime,
            "tardiness" => $total_tardiness,
            "under_day" => $under_equiv_day,
            "tardy_day" => $tardy_equiv_day
        ];

        return response()->json($data);
    }

    function sendpayslip(Request $req) {
        $html = null;
        if ($req->method() == "POST") {
            $employees    = personnel::get(["employeeid","mname","fname","lname","email"])->toArray();
            $file         = $req->file("fileinput");        
            $tfile        = fopen($file,"r");

            $payslipitems = file($file);

            $count   = 0;

            $headers = [];
            $body    = [];

                while(! feof($tfile)) {
                   

                    $csvfile = fgetcsv($tfile);

                    if ($csvfile != false) {
                        if ($count == 0) {
                            foreach($csvfile as $hs) {
                                array_push($headers, $hs);
                            }
                        } else {
                            $localbody = [];
                            foreach($csvfile as $bs) {
                                array_push($localbody,$bs);
                            }
                            array_push($body,$localbody);
                        }
                    }

                    $count++;
                }

                    for($i=0; $i<= count($body)-1; $i++) {
                        $bb = ["headers"=>$headers,"body"=>$body[$i]];

                        $d['email']   = "ajbmerto@gmail.com";
                        $d['name']    = "Alvin Merto";
                        $d['dtrdate'] = "May 1, 2023";
                        $d['title']   = "Test Payslip";

                        $pdf = PDF::loadView('pdf.payslipformat', $bb);
                        $pdf->setOption(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
                            
                        $pdf->set_paper("A4");
                        // send to email here
                            Mail::send('emails.payslipformat', $bb, function($message)use($d, $pdf) {
                                $message->to($d["email"], $d["email"])
                                        ->from("no-reply@dole.gov.ph","DOLE HR")
                                        ->subject($d["title"])
                                        ->attachData($pdf->output(), $d['name']." DTR for ".$d['dtrdate'].".pdf");
                            });
                        // end sending email
                    }
               
        }

        return view("attendance.sendpayslip", compact("html"));
    }
}
