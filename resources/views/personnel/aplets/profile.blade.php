                    <div class='pd-15 body-wrap' id=''> <!-- body-wrap -->
                            <?php $thename = $selected[0]->lname.", ".$selected[0]->fname." ".$selected[0]->mname; ?>
                               <div class='border-bottom mg-b-0'>
                                        @include("personnel.aplets.insideheadername")
                                        @section('thename')
                                </div>
                            <?php // if (count($selected) > 0) { ?>
                                @include("personnel.aplets.insidenav",["navigation"=>"profile"])
                            <?php // } ?>
                            <?php if (count($selected) > 0) { ?>
                                <div class='body-div pd-t-10'> <!-- body div -->
                                    <div class='child-profile-div'> <!-- first child profile div -->
                                        <div class='top-div-box'> <!-- top div box -->
                                            <div class='smalldiv mg-b-20 center-it'>
                                                <small> PROFILE PICTURE </small>   
                                                <img src="{{ asset('upload/DSC_5694.png') }}" style='width:85%;' class='mg-b-5 mg-t-10 theprofpic'/>
                                                <small> CHANGE PROFILE PICTURE </small> 
                                            </div>
                                        </div> <!-- end top div box -->
                                        <div> <!-- below div box -->
                                            <div class='smalldiv mg-b-20'>
                                                <small> LAST NAME </small>
                                                <input  type='text' 
                                                        id  = "lastname"
                                                        data-key = "perid" 
                                                        data-tbl = "personnels" 
                                                        data-index = "<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" 
                                                        data-fld = "lname" class='form-control mg-t-10 thetextinput' 
                                                        value="<?php if(count($selected) > 0) { echo $selected[0]->lname; } ?>"/>
                                            </div>

                                            <div class='smalldiv mg-b-20'>
                                                <small> FIRST NAME </small>
                                                <input  type='text' 
                                                        id  = "firstname"
                                                        data-key = "perid" 
                                                        data-tbl = "personnels" 
                                                        data-index = "<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" 
                                                        data-fld = "fname" class='form-control mg-t-10 thetextinput' 
                                                        value="<?php if(count($selected) > 0) { echo $selected[0]->fname; } ?>"/>
                                            </div>
                                            
                                            <div class='smalldiv mg-b-20'>
                                                <small> MIDDLE NAME </small>
                                                <input  type='text' 
                                                        id  = "middlename"
                                                        data-key = "perid" 
                                                        data-tbl = "personnels" 
                                                        data-index = "<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" 
                                                        data-fld = "mname" class='form-control mg-t-10 thetextinput' 
                                                        value="<?php if(count($selected) > 0) { echo $selected[0]->mname; } ?>"/>
                                            </div>

                                            <div class='smalldiv mg-b-20'>
                                                <small> EMAIL ADDRESS </small>
                                                <input  type='text' 
                                                        id  = "emailaddr"
                                                        data-key = "perid" 
                                                        data-tbl = "personnels" 
                                                        data-index = "<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" 
                                                        data-fld = "email" class='form-control mg-t-10 thetextinput' 
                                                        value="<?php if(count($selected) > 0) { echo $selected[0]->email; } ?>"/>
                                            </div>

                                            <div class='smalldiv mg-b-20'>
                                                <small> POSITION </small>
                                                <select class='form-control thetextinput' data-key='perid' data-tbl='personnels' data-index="<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = "position_id">
                                                    <?php
                                                        foreach($positions as $p) {
                                                            $selected_option = null;
                                                            if (count($selected) > 0) { 
                                                                if ($selected[0]->position_id == $p->positionpk) {
                                                                    $selected_option = "selected";
                                                                }
                                                            }
                                                            echo "<option value='{$p->positionpk}' {$selected_option}>{$p->theposition}</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> <!-- end below div box -->
                                    </div> <!-- end first child profile div -->
                                    <div class='child-profile-div mg-l-20'> <!-- second child profile div -->
                                            <div class='top-div-box'>
                                                <div class='smalldiv mg-b-20'>
                                                    <small> AREA </small>
                                                    <select class='form-control mg-t-10 thetextinput' data-key='perid' data-tbl='personnels' data-index="<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = "area_office_id">
                                                        <?php
                                                            foreach($areas as $a) {
                                                                $sel  = null;
                                                                if (count($selected) > 0) {
                                                                    if ($a->areaofficepk == $selected[0]->area_office_id) {
                                                                        $sel = "selected";
                                                                    }
                                                                }

                                                                echo "<option value='{$a->areaofficepk}' {$sel}>{$a->theareaoffice}</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>  
                                                <!-- <div class='smalldiv mg-b-20'>
                                                    <small> OFFICE </small>
                                                    <select class='form-control mg-t-10 thetextinput' data-key='perid' data-tbl='personnels' data-index="<?php //if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = "office_id">
                                                        <option value='0'> -- no office -- </option>
                                                        <?php
                                                            // foreach($offices as $of) {
                                                            //     $sel  = null;
                                                            //     if (count($selected) > 0) {
                                                            //         if ($of->officepk == $selected[0]->office_id) {
                                                            //             $sel = "selected";
                                                            //         }
                                                            //     }

                                                            //     echo "<option value='{$of->officepk}' {$sel}>{$of->theoffice}</option>";
                                                            // }
                                                        ?>
                                                    </select>
                                                </div>   -->

                                            </div>
                                            <div>
                                                <div class='smalldiv mg-b-20'>
                                                    <small> EMPLOYMENT STATUS </small>
                                                    <select class='form-control mg-t-10 thetextinput' data-refresh='yes' data-key='perid' data-tbl='personnels' data-index="<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = "employment_type_id">
                                                    <?php
                                                            foreach($emp_status as $es) {
                                                                $sel = null;
                                                                if (count($selected)> 0) {
                                                                    if ($selected[0]->employment_type_id == $es->employmenttypepk) {
                                                                        $sel = "selected";
                                                                    }
                                                                }
                                                                echo "<option value='{$es->employmenttypepk}' {$sel}>{$es->theemploymenttype}</option>";
                                                            }
                                                    ?>
                                                    </select>
                                                </div> 

                                                <div class='smalldiv mg-b-20'>
                                                    <small> EMPLOYEE ID </small>
                                                    <input 
                                                        class = 'form-control mg-t-10 thetextinput' data-key='perid' data-tbl='personnels' data-index="<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = 'employeeid'
                                                        type='text' value='<?php if ( strlen($selected[0]->employeeid) > 0) { echo $selected[0]->employeeid; } ?>'/>
                                                </div>

                                                <div class='smalldiv mg-b-20'>
                                                    <small> BIOMETRIC ID </small>
                                                    <input 
                                                        class = 'form-control mg-t-10 thetextinput' data-key='perid' data-tbl='personnels' data-index="<?php if(count($selected) > 0) { echo $selected[0]->perid; } ?>" data-fld = 'biometricid'
                                                        type='text' value='<?php if ( strlen($selected[0]->biometricid) > 0) { echo $selected[0]->biometricid; } ?>'/>
                                                </div>
                                            </div>
                                    </div> <!-- end second profile div -->
                                    <div class='child-profile-div mg-l-20'> <!-- third child profile div -->
                                        <div class='top-div-box'> <!-- top div box -->
                                            <div class='smalldiv mg-b-20'>
                                                <small> ROLE </small>
                                                <select class='form-control mg-t-10'>
                                                    <option> Administrator </option>
                                                    <option> HR Personnel </option>
                                                    <option> Office Head </option>
                                                    <option> Division Head </option>
                                                    <option> Employee </option>
                                                </select>
                                            </div> 
                                                <div class='smalldiv mg-b-20'>
                                                    <small> PASSWORD </small>
                                                    <input type='text' class='form-control mg-t-10' id='password' name="password"/>
                                                </div>
                                                <div class='smalldiv mg-b-20'>
                                                    <small> CONFIRM PASSWORD </small>
                                                    <input type='text' class='form-control mg-t-10' id='confirm_password' name="confirm_password"/>
                                                </div>
                                                <div class='smalldiv mg-b-20'>
                                                    <!-- <small> PASSWORD </small> <br/> -->
                                                    <input type='submit' value='Save Account' id='saveaccount' class='btn btn-default'/>
                                                </div>
                                        </div> <!-- end top div box -->
                                        <div>
                                            &nbsp;
                                        </div>
                                    </div> <!-- end third profile div -->
                                    <!-- fourth child profile div -->
                                    <div class='child-profile-div mg-l-20'> 
                                        <!-- <div class='top-div-box'>
                                            <div class='smalldiv mg-b-20'>
                                                <small> SIGNATORY TO </small>
                                                <select class='form-control mg-t-10'>
                                            
                                                </select>
                                            </div> 
                                        </div> -->
                                    </div> 
                                    <!-- end fifth child profile div -->
                                </div> <!-- end of body div -->
                            <?php } ?>
                        </div>
                    </div> <!-- end of body-wrap -->