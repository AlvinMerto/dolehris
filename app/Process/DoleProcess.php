<?php 
	namespace App\Process;

    use Illuminate\Support\Facades\Hash;
    use App\Models\validationcode;
    use App\Models\details;
    
    use App\Models\tardyundertimetbls;
    use App\Models\inclusivedates;
    use App\Models\leavecards;

	use DateTime;

	class DoleProcess {
		public static function compute_tardy_undertime($datetime, $periodfrom, $periodto, $schedule , $personnelid = false ) {
			$period = new \DatePeriod(
                     new \DateTime($periodfrom),
                     new \DateInterval('P1D'),
                     new \DateTime($periodto)
                );

                $total_undertime = "00:00:00";
                $total_tardiness = "00:00:00";

                // counts 
                $tardy_count     = 0;
                $under_count     = 0;

                $thedtr          = [];
                foreach ($period as $key => $value) {
                    $theval   = $value->format('m/d/Y');
                    $thedate  = $theval;

                    $am_start = null;
                    $am_end   = null;
                    $pm_start = null;
                    $pm_end   = null;

                    $ismonday = false;
                    foreach($datetime as $td) {
                        if ( strtolower(date("l", strtotime($thedate))) == "monday") {
                            $ismonday = true;
                        } else {
                            $ismonday = false;
                        }

                        if (date("m/d/Y", strtotime($td->theattendance)) == date("m/d/Y", strtotime($thedate)) ) {
                            if ($td->timeactual == "am_start") {
                                if ($am_start == null) {
                                    $am_start = date("h:i A", strtotime($td->theattendance));
                                }
                                // $am_start = date("H:i:s", strtotime($td->theattendance));
                            }

                            if ($td->timeactual == "am_end") {
                                if ($am_end == null) {
                                    $am_end = date("h:i A", strtotime($td->theattendance));
                                }
                            }

                            if ($td->timeactual == "pm_start") {
                                if ($pm_start == null) {
                                    $pm_start = date("h:i A", strtotime($td->theattendance));
                                }
                            }

                            if ($td->timeactual == "pm_end") {
                                if ($pm_end == null) {
                                    $pm_end = date("h:i A", strtotime($td->theattendance));
                                }
                            }
                        }
                    }

                    $tardy = null;
                    $under = null;

                    if ( strtolower(date("l", strtotime($thedate))) != "saturday" && strtolower(date("l", strtotime($thedate))) != "sunday" ) {
                        // break 1;
                        
                        $passthrough = true;
                        // if ($ismonday) {
                        //     if ($am_start != null) {
                        //         $passthrough = true;
                        //     }
                        // } else {
                        //     if ($am_start != null && $am_end != null && $pm_start != null && $pm_end != null) {
                        //         $passthrough = true;
                        //     }
                        // }

                        if ($passthrough) {
                            $pass_tardy_am = false;
                            $pass_under_am = false;
                            $pass_tardy_pm = false;
                            $pass_under_pm = false;

                        // if ($am_start != null && $am_end != null && $pm_start != null && $pm_end != null) {

                            if ($am_start != null) {
                                $pass_tardy_am = true;
                            }

                            if ($am_end != null) {
                                $pass_under_am = true;
                            }

                            if ($pm_start != null) {
                                $pass_tardy_pm = true;
                            }

                            if ($ismonday) {
                                $thold_am_in      = "08:00:00";
                                $thold_am_out     = "12:00:00";
                                $thold_pm_in      = "13:00:00";

                                if ($pm_end != null) {
                                    $pass_under_pm = true;
                                }

                                if ($am_start != null) {
                                    if ($am_start < $thold_am_in) {
                                        $supposed_pm_out  = date("H:i:s", strtotime("+9 hours ".$am_start));
                                    } else {
                                        $supposed_pm_out  = "17:00:00";
                                    }
                                } else {
                                    $supposed_pm_out  = "17:00:00";
                                }
                            } else {
                                $thold_am_in      = $schedule['morning_flexi_in'];
                                $thold_am_out     = $schedule['morning_flexi_out'];
                                $thold_pm_in      = $schedule['afternoon_flexi_in'];

                                if ($am_start != null && $pm_end != null) {
                                    $pass_under_pm = true;
                                }

                                if ($am_start != null) {
                                    if ($am_start > $thold_am_in) {
                                        $supposed_pm_out  = $schedule['afternoon_flexi_out'];
                                    } else {
                                        // the threshold for the PM OUT is 9 hours from AM IN :: including the 12NN to 1PM break
                                        $supposed_pm_out  = date("H:i:s", strtotime("+9 hours ".$am_start));
                                    }
                                } else {
                                    $supposed_pm_out  = $schedule['afternoon_flexi_out'];
                                }
                            }

                            // start tardiness
                                    // =====================================
                                    // compute for morning tardiness
                                    if ($pass_tardy_am) {
                                        $am_time1 = new DateTime($am_start); 
                                        $am_time2 = new DateTime($thold_am_in);
                                        $interval = $am_time1->diff($am_time2);

                                        $am_tardy_hour = $interval->format("%h");
                                        $am_tardy_mins = $interval->format("%i");

                                        if ($am_time1 > $am_time2) {
                                            // tardy morning
                                             $tardy = $am_tardy_hour.":".$am_tardy_mins;
                                            // $tardy  = ($am_tardy_hour*60)+$am_tardy_mins;
                                            $tardy_count++;
                                        }
                                    }
                                    // end computation of morning tardiness
                                    // =====================================

                                    // =====================================
                                    // computation for afternoon tardy
                                    if ($pass_tardy_pm) {
                                        $pm_time1      = new DateTime($pm_start);
                                        $pm_time2      = new DateTime($thold_pm_in);
                                        $interval_pm   = $pm_time1->diff($pm_time2);

                                        $pm_tardy_hour = $interval_pm->format("%h");
                                        $pm_tardy_mins = $interval_pm->format("%i");

                                        if ($pm_time1 > $pm_time2) {
                                            $pm_tardy  = $pm_tardy_hour.":".$pm_tardy_mins;
                                            
                                            $secs   = strtotime($tardy)-strtotime("00:00:00");
                                            $result = date("H:i:s",strtotime($pm_tardy)+$secs);

                                            $tardy  = $result;
                                            $tardy_count++;
                                        }
                                    }
                                    // end computation of afternoon tardy
                                    // =====================================
                                // end tardiness

                                // undertime
                                    // morning undertime
                                    if ($pass_under_am) {
                                        $am_under_t1       = new DateTime($am_end);
                                        $am_under_t2       = new DateTime($thold_am_out);
                                        $am_interval_under = $am_under_t1->diff($am_under_t2);

                                        $am_under_hour     = $am_interval_under->format("%h");
                                        $am_under_mins     = $am_interval_under->format("%i");

                                        if ($am_under_t1 < $am_under_t2) {
                                            // $under = ($am_under_hour*60)+$am_under_mins;
                                            $under    = $am_under_hour.":".$am_under_mins;
                                            $under_count++;
                                        }
                                    }
                                    // end morning undertime

                                    // afternoon undertime 
                                    if ($pass_under_pm) {
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
                                            $under_count++;
                                        } 
                                    }
                                    // end afternoon undertime
                                // undertime 
                        }

                    } // end else if for saturday and sunday 

                    // compute for the total undertime
                        $unders_secs       = strtotime($total_undertime)-strtotime("00:00:00");
                        $total_undertime   = date("H:i:s", strtotime($under)+$unders_secs);
                    // end for the computation of total undertime

                    // compute for the total tardiness 
                        $tardy_secs        = strtotime($total_tardiness)-strtotime("00:00:00");
                        $total_tardiness   = date("H:i:s", strtotime($tardy)+$tardy_secs);
                    // end for the computation of total tardiness

                    $thedtr[date("m/d/Y", strtotime($thedate))] 				  = [];
                    $thedtr[date("m/d/Y", strtotime($thedate))]['am_start'] 	  = $am_start;
                    $thedtr[date("m/d/Y", strtotime($thedate))]['am_end'] 		  = $am_end;
                    $thedtr[date("m/d/Y", strtotime($thedate))]['pm_start'] 	  = $pm_start;
                    $thedtr[date("m/d/Y", strtotime($thedate))]['pm_end'] 		  = $pm_end;
                    $thedtr[date("m/d/Y", strtotime($thedate))]['tardy']		  = $tardy;
                    $thedtr[date("m/d/Y", strtotime($thedate))]['undertime']	  = $under;
                    $thedtr['tardy_count']    = $tardy_count;
                    $thedtr['under_count']    = $under_count; 

                    if ($tardy != null) {
                        DoleProcess::savetardyundertime($personnelid, "t" , $tardy, $thedate);
                    }
                    
                    if ($under != null) {
                        DoleProcess::savetardyundertime($personnelid, "u" , $under, $thedate);
                    }
                    
				} // end of for loop

                // undertime breakdown to hour and mins
                $thedtr['total_undertime']['hour']    = explode(":", $total_undertime)[0];
                $thedtr['total_undertime']['mins']    = explode(":", $total_undertime)[1];

                // tardiness breakdown to hour and mins
                $thedtr['total_tardiness']['hour']    = explode(":", $total_tardiness)[0]; 
                $thedtr['total_tardiness']['mins']    = explode(":", $total_tardiness)[1];

                $tardy_indays                         = DoleProcess::convert_to_days($thedtr['total_tardiness']['hour'], $thedtr['total_tardiness']['mins']);
                $under_indays                         = DoleProcess::convert_to_days($thedtr['total_undertime']['hour'], $thedtr['total_undertime']['mins']);

                $thedtr['tardiness']['equiv']         = $tardy_indays[0];
                $thedtr['undertime']['equiv']         = $under_indays[0];

                $thedtr['tardiness']['inmins']        = $tardy_indays[1];
                $thedtr['undertime']['inmins']        = $under_indays[1];
		        
                $thedtr["totaltardyunder"]['inmins']  = $tardy_indays[1]+$under_indays[1];

                return $thedtr;
		}

        public static function convert_to_days($hour, $mins) {
            // $hrs_days  = number_format($hour/8,3); 
            // $mins_days = number_format($mins/480,3);

            // converted to days
            // $hrs_days   = ($hour/8);    // in days
            // $mins_days  = ($mins/480);  // in days

            $hrs_in_days = [
                "0"  => "0.000",
                "00" => "0.000",
                "1"  => "0.125",
                "01" => "0.125",
                "2"  => "0.250",
                "02" => "0.250",
                "3"  => "0.375",
                "03" => "0.375",
                "4"  => "0.500",
                "04" => "0.500",
                "5"  => "0.625",
                "05" => "0.625",
                "6"  => "0.750",
                "06" => "0.750",
                "7"  => "0.875",
                "07" => "0.875",
                "8"  => "1.000",
                "08" => "1.000"
            ];

            $mins_in_days = [
                "0"  => "0.000",
                "00" => "0.000",
                "1"  => "0.002",
                "01" => "0.002",
                "2"  => "0.004",
                "02" => "0.004",
                "3"  => "0.006",
                "03" => "0.006",
                "4"  => "0.008",
                "04" => "0.008",
                "5"  => "0.010",
                "05" => "0.010",
                "6"  => "0.012",
                "06" => "0.012",
                "7"  => "0.015",
                "07" => "0.015",
                "8"  => "0.017",
                "08" => "0.017",
                "9"  => "0.019",
                "09" => "0.019",
                "10" => "0.021",
                "11" => "0.023",
                "12" => "0.025",
                "13" => "0.027",
                "14" => "0.029",
                "15" => "0.031",
                "16" => "0.033",
                "17" => "0.035",
                "18" => "0.037",
                "19" => "0.040",
                "20" => "0.042",
                "21" => "0.044",
                "22" => "0.046",
                "23" => "0.048",
                "24" => "0.050",
                "25" => "0.052",
                "26" => "0.054",
                "27" => "0.056",
                "28" => "0.058",
                "29" => "0.060",
                "30" => "0.062",
                "31" => "0.065",
                "32" => "0.067",
                "33" => "0.069",
                "32" => "0.071",
                "33" => "0.069",
                "34" => "0.071",
                "35" => "0.073",
                "36" => "0.075",
                "37" => "0.077",
                "38" => "0.079",
                "39" => "0.081",
                "40" => "0.083",
                "41" => "0.085",
                "42" => "0.087",
                "43" => "0.090",
                "44" => "0.092",
                "45" => "0.094",
                "46" => "0.096",
                "47" => "0.098",
                "48" => "0.100",
                "49" => "0.102",
                "50" => "0.104",
                "51" => "0.106",
                "52" => "0.108",
                "53" => "0.110",
                "54" => "0.112",
                "55" => "0.115",
                "56" => "0.117",
                "57" => "0.119",
                "58" => "0.121",
                "59" => "0.123",
                "60" => "0.125"
            ];

            $hrs_days   = $hrs_in_days[$hour];
            $mins_days  = $mins_in_days[$mins];

            // added all to minutes
            $hrstomins     = $hour*60;     // in minutes

            // index 0 returns days
            // index 1 returns minutes
            return [$hrs_days+$mins_days,$hrstomins+$mins];
        }

        public static function savevalidation($typeofdocument,$personnelid, $details = false) {
            $thecode      = Hash::make(date("mdYhis").rand().$personnelid);

            $pattern      = '/\//i';
            $thecleancode = preg_replace($pattern, '_', $thecode);
            
            $grpid        = date("mdYHis").$personnelid;

            $d = validationcode::create([
                "typeofdocument"    => $typeofdocument,
                "thecode"           => $thecleancode,
                "personnelid"       => $personnelid,
                "detailsid"         => $grpid
            ]);

            $detailsid = null;

            foreach($details as $key => $ds) {
                $detailsid = details::create([
                    "groupid"   => $grpid,
                    "thefield"  => $key,
                    "thevalue"  => $ds
                ]);
            }

            return [$d,$thecleancode];
        }

        public static function checksettings($nav) {
            if (session($nav) == NULL ) {
                // add code here 
                    // -------

                    // -------
                // end adding of code here
                die("It seems like you are accessing something thats beyond your control, your footprint has been recorded. You are not allowed here.");
            }
        }

        public static function savetardyundertime($personnelid, $typeofitem, $thevalue, $thedate) {
            // $dateinquestionid = dateoftheundertime_typeofitem_personnelid
            $dateinquestionid    = date("mdY", strtotime($thedate))."_".$typeofitem."_".$personnelid;
            // tardyundertimetbls

            // tardiness
            // -- save to tardy undertime table
            // -- save to leavecard table
            // -- save to inclusivedates table

            $checkexistence = tardyundertimetbls::where("thedateinquestion",$dateinquestionid)->get(["thedateinquestion"]);

            if (count($checkexistence) > 0) {
                return;
            }

            // to tardy and undertime table
                $tardyundertbl = tardyundertimetbls::insertGetId([
                    "typeofitem"        => $typeofitem,
                    "thevalue"          => $thevalue,
                    "personnelid"       => $personnelid,
                    "thedateinquestion" => $dateinquestionid
                ]);
            // end tardy and undertime table

            // to inclusivedates table 
                $inclusivedates = inclusivedates::insertGetId([
                    "leaveapplicationid"    => $dateinquestionid,
                    "thedate"               => date("Y-m-d", strtotime($thedate))
                ]);
            // end to inclusivedates table

            // get the previous data 
                $prev_data = leavecards::where(["personnelid"=>$personnelid,"leavecardtype"=>1])
                                        ->orWhere("leavecardtype","fb")
                                        ->orderBy("leavecardpk","DESC")
                                        ->first();

                if ($prev_data != NULL) {
                    $prev_data = $prev_data->toArray();
                }
            // end getting the previous data

            // breakdown for the leave cards table 
                $theexploded  = explode(":", $thevalue);
       
                if (count($theexploded) > 1) {
                    $part_hrs     = $theexploded[0];
                    $part_mins    = $theexploded[1]; 
                } else {
                    $part_hrs     = 0;
                    $part_mins    = 0;
                }
               
                $leavebalance = 0;
                $leavewithpay = null;
                $leavewopay   = null;

                $indays = DoleProcess::convert_to_days($part_hrs, $part_mins)[0];

                if ($prev_data != null) {
                    if (count($prev_data) > 0) {
                        $prev_leavebalance = $prev_data['leave_balance'];

                        if ($prev_leavebalance > 0) {
                            $leavewithpay = $indays;
                            $leavebalance = $prev_leavebalance-$leavewithpay;
                        } else {
                            $leavewopay   = $indays;
                            $leavebalance = 0-$leavewopay;
                        }
                    }
                 }

            // end breakdown

            // leavecards table 
                $leavecards     = leavecards::insertGetId([
                    "particulartype"        => $typeofitem,
                    "particularid"          => $tardyundertbl,
                    "operand"               => "-",
                    "particulars_days"      => NULL,
                    "particulars_hrs"       => $part_hrs,
                    "particulars_mins"      => $part_mins,
                    "leave_earned"          => NULL,
                    "leave_withpay"         => $leavewithpay,
                    "leave_balance"         => $leavebalance,
                    "leave_wopay"           => $leavewopay,
                    "leavecardtype"         => "1",
                    "status"                => "1",
                    "personnelid"            => $personnelid
                ]);
            // end 
        }
	}
?>