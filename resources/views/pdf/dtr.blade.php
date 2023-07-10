<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>

    <style>
        @page  {
          margin: 30px 0px 30px 20px;
          size: legal; 
        }

        * {
            font-size:.777rem;
            
        }

        .fullwidth {
            width:100%;
        }

        .mg-t-10 {
            margin-top:10px;
        }

        .mg-t-70 {
            margin-top:70px;
        }

        table {
            border-collapse: collapse;
        }

        table tr td {
            padding:6px 5px;
            font-family:calibri;
        }

        table tr td p {
            margin:0px;
        }

        .smalltd {
            width:60px;
            text-align:center;
            
        }

        .thesignaturetbl {
           margin-top:10px;
        }

        .table-wrapper-div {
            position:relative;
        }

        .broken-border-td {
            border-right:2px dashed #333 !important;
        }

        .border-td {
            /* border-right:1px solid #ccc; */
            border-bottom:1px solid #ccc;
            /* border-top:1px solid #ccc; */
        }

        .border-left {
            border-left:1px solid #ccc;
        }

        .border-right {
            border-right:1px solid #ccc;
        }

        .border-top {
            border-top:1px solid #ccc;
        }

        .border-bottom {
            border-bottom:1px solid #ccc;
        }

        .upperline-p {
            border-top:1px solid #ccc;
        }

        .center-it {
            text-align:center;
        }

        .bold-it {
            font-weight:bold;
        }

        .header-txt {
            font-size:12px;
            padding-bottom:10px;
        }

        .name-annex {
            font-size:13px;
            font-weight:bold;
        }

        .big-name-annex {
            font-size:16px;
            font-weight:bold;
        }

        .payperiod-annex {
            font-size:11px;
        }

        .whole-td {
            border:1px solid #ccc;
        }

        .summary-table{
            position:fixed;
            top:900px;
            width:100%;
        }

        .border-t-b {
            border-top:1px solid #ccc;
            border-bottom:1px solid #ccc;
            padding-top:3px;
            padding-bottom:3px;
        }
        
        .validatedtbl{
            margin-top:-38px;
        }

        .small-name-text {
            font-size: 12px;
        }

        .thecode {
            font-family:calibri;
            font-size: 10px;
            color:red;
            padding-left:10px;
            border-top: 1px dotted #ccc;
            border-bottom:1px dotted #ccc;
            padding-top:5px;
            padding-bottom:5px;
        }

        .autofit {

        }
    </style>
</head>
<body>
    <?php //for() {?>
        <div class='table-wrapper-div'>
            <table class="fullwidth border-td">
                <tr>
                    <td colspan='5'>
                        <img src="{{ public_path() }}/images/DOLEXI-Header-V2.png" style='width:90%;'>
                    </td>
                    <td colspan='3' class=''>
                        <?php 
                            $tc  = url('/').'/verify/'.$validcode; 
                            $url = base64_encode(QrCode::size(80)->generate($tc)) 
                        ?>
                        <img style='float:right;' src="data:image/png;base64, {!! $url !!} ">
                        <?php // echo QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8'); ?>
                        <!-- <p class='name-annex center-it'> &nbsp; </p> -->
                        <!-- <p class='center-it small-name-text'> <?php // echo $validcode; ?> </p> -->
                        <!-- <p class='center-it payperiod-annex border-t-b'> Tupad Coordinator </p> -->
                    </td>
                    <td>
                        <!-- <p class='center-it big-name-annex'> <?php // echo $fullname; ?> </p> -->
                        <!-- <p class='center-it payperiod-annex border-t-b'>  Tupad Coordinator  </p> -->
                    </td>
                </tr>
                <tr>
                    <td colspan='5'>
                        <p class='header-txt mg-t-10'> Daily Time Records : <strong class='payperiod-annex'> <?php echo $thedate; ?> </strong> </p>
                    </td>
                    <td colspan='10' class=''>
                        <!-- <p class='center-it small-name-text thecode'> <?php //echo $validcode; ?> </p> -->
                    </td>
                    <td>
                        <p> &nbsp; </p>
                    </td>
                </tr>
               
                <tr class='border-top'> 
                    <td class='bold-it'> DATE  </td>
                    <td class='bold-it center-it autofit'> IN </td>
                    <td class='bold-it center-it autofit'> OUT </td>
                    <td class='bold-it center-it autofit'> IN </td>
                    <td class='bold-it center-it broken-border-td autofit'> OUT </td>
                    <td class='bold-it center-it border-right border-left border-bottom'> TARDY </td>
                    <td class='bold-it center-it border-right border-left border-bottom'> UNDERTIME </td>
                    <td class='bold-it center-it border-right border-left border-bottom'> OT </td>
                    <td class='bold-it center-it border-td ' style="width:200px;"> REMARKS </td>
                </tr>
                <?php

                    $period = new DatePeriod(
                         new DateTime($from),
                         new DateInterval('P1D'),
                         new DateTime($to)
                    );

                    foreach ($period as $key => $value) {
                        $theval   = $value->format('m/d/Y');
                        $thedate  = $theval;

                        echo "<tr>";
                            echo "<td class=''> <strong>".$thedate."</strong> ". substr( date("l", strtotime($thedate)), 0,2)."</td>";
                            echo "<td class='center-it'> {$timeanddate[$theval]['am_start']} </td>";
                            echo "<td class='center-it'> {$timeanddate[$theval]['am_end']}  </td>";
                            echo "<td class='center-it'> {$timeanddate[$theval]['pm_start']} </td>";
                            echo "<td class='center-it broken-border-td'> {$timeanddate[$theval]['pm_end']} </td>";
                            echo "<td class='center-it border-right border-left border-bottom'> {$timeanddate[$theval]['tardy']} </td>";
                            echo "<td class='center-it border-right border-left border-bottom'> {$timeanddate[$theval]['undertime']} </td>";
                            echo "<td class='bold-it center-it border-td'>  </td>";
                            echo "<td class='bold-it center-it border-td'>  </td>";
                            echo "</tr>";
                    }
                
                ?>
                <!-- <tr>
                     <td colspan="20" class='thecode'> <?php // echo $validcode; ?> </td>
                </tr> -->
            </table>
            
            <div class='summary-table'>
                <table class='mg-t-10'>
                    <tr>
                        <td colspan='2'> Summary </td>
                    </tr>
                    <tr> 
                        <td> 
                            <table>
                                <tr>
                                    <td class='whole-td'> <strong> Particulars </strong> </td>
                                    <td class='whole-td'> <strong> Count </strong> </td>
                                    <td class='whole-td'> <strong> hrs </strong> </td>
                                    <td class='whole-td'> <strong> mins </strong> </td>

                                    <?php 
                                        if ($emptype == "1" || $emptype == 1) {
                                            echo "<td class='whole-td'> <strong> Total Minutes </strong> </td>";
                                        } else if ($emptype == "2" || $emptype == 2) {
                                            echo "<td class='whole-td'> <strong> Equivalent in days </strong> </td>";
                                        }
                                    ?>
                                    
                                </tr>
                                <tr>
                                    <td class='whole-td'> No. of working days </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                </tr>
                                <tr>
                                    <td class='whole-td'> Absences </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                    <td class='whole-td'> &nbsp; </td>
                                </tr>
                                <tr>
                                    <td class='whole-td'> Tardiness </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['tardy_count']; ?> </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['total_tardiness']['hour']; ?> </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['total_tardiness']['mins']; ?> </td>

                                    <?php 
                                        if ($emptype == "1" || $emptype == 1) {
                                            echo "<td class='whole-td' style='text-align:center;'>{$timeanddate['tardiness']['inmins']}</td>";
                                        } else if ($emptype == "2" || $emptype == 2) {
                                            echo "<td class='whole-td' style='text-align:center;'>{$timeanddate['tardiness']['equiv']}</td>";
                                        }
                                    ?>
                                    
                                </tr>
                                <tr>
                                    <td class='whole-td'> Undertime </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['under_count']; ?> </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['total_undertime']['hour']; ?> </td>
                                    <td class='whole-td' style='text-align:center;'> <?php echo $timeanddate['total_undertime']['mins']; ?> </td>

                                    <?php 
                                        if ($emptype == "1" || $emptype == 1) {
                                            echo "<td class='whole-td' style='text-align:center;'>{$timeanddate['undertime']['inmins']}</td>";
                                        } else if ($emptype == "2" || $emptype == 2) {
                                            echo "<td class='whole-td' style='text-align:center;'>{$timeanddate['undertime']['equiv']}</td>";
                                        }
                                    ?>
                                </tr>

                                <?php 
                                    if ($emptype == "1" || $emptype == 1) {
                                        echo "<tr>";
                                            echo "<td colspan='4' class='whole-td' style='text-align:center;'> <strong> Total in Minutes </strong> </td>";
                                            echo "<td class='whole-td' style='text-align:center;'> {$timeanddate["totaltardyunder"]['inmins']} </td>";
                                        echo "</tr>";
                                    } 
                                ?>
                                
                            </table>
                        </td>
                        <td> 
                            <table class='validatedtbl'>
                                <tr>
                                    <td class='whole-td'> <strong> Validated </strong> </td>
                                    <td class='whole-td' style='width:50px;'> <strong> Value </strong> </td>
                                </tr>
                                <tr>
                                    <td class='whole-td'> Total tardiness and undertime </td>
                                    <td class='whole-td'> &nbsp; </td>
                                </tr>
                            </table>
                            <table class='fullwidth mg-t-10'>
                                <tr>
                                    <td class='whole-td'> <strong> TOTAL </strong> </td>
                                    <td class='whole-td'> &nbsp; </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- <p class='center-it small-name-text thecode'> <?php // echo $validcode; ?> </p> -->
                <table class='thesignaturetbl fullwidth'>
                    <tr>
                        <td>
                            <p> I CERTIFY on my honor that the above is a true and correct report of the <br/> hours of work performed, record of which was made daily at the time of arrival <br/> and departure from office. </p>
                        </td>
                        <td>
                            <p> Verified as to the prescribed office hours: </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class='mg-t-70'> 
                                <p class='name-annex center-it'> <?php echo strtoupper($fullname); ?> </p>
                                <p class='payperiod-annex upperline-p center-it'> Employee Signature </p>
                            </div>    
                        </td>
                        <td>
                            <div class='mg-t-70'> 
                                <p class='name-annex center-it' style='text-transform: uppercase;'> <?php echo $signname; ?> </p>
                                <p class='payperiod-annex center-it upperline-p' style='text-transform: capitalize;'> <?php echo $signpost; ?> </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
        </div>
    <?php //} ?>
</body>
</html>