<x-app-layout>
    
        <!-- <div class='br-pagebody'> -->
            <div class="pd-t-30 pd-l-30 pd-r-30 pd-b-10">
                <h6 class="tx-gray-800 mg-b-5">Generate Daily Time Records 
                    <a href="{{ url('attendance/upload') }}" class='btn uploadattbtn' > Upload Attendance </a> </h6>
                <!-- <p class="mg-b-0">Generate time records to all area offices</p> -->
            </div>
            <div class="br-pagebody mg-t-5 pd-x-30"> 
                <div class='pd-l-15 pd-r-15 pd-0 card pd-b-30 pd-t-30 bd-0 shadow-base'>
                    <form method='get' action="{{ route('downloaddtr') }}" enctype='multipart/form-data'>
                        @csrf
                        <div class='row'>
                            <div class='col-md-2 '>
                                <input type='text' id='dtrdate' name='thedate' class='form-control mg-b-5'/>
                                <select class='form-control mg-b-5' id='arealocation' name='arealocation'>
                                    <option value='none'> Area </option>
                                    <?php
                                        foreach($areas as $a) {
                                            echo "<option value='{$a->areaofficepk}'>{$a->theareaoffice}</option>";
                                        }
                                    ?>
                                </select>
                                <!-- <select class='form-control mg-b-5' id='officedivision' name='officedivision'> -->
                                    <!-- see OFFICE table -->
                                    <!-- <option value='none'> Division </option> -->
                                    <?php
                                        // foreach($offices as $of) {
                                        //     echo "<option value='{$of->officepk}'> {$of->theoffice} </option>";
                                        // }
                                    ?>
                                <!-- </select>  -->
                                <!-- see UNIT table -->
                                <!-- <select class='form-control mg-b-5' id='divisions' name='divisions'>
                                    <option value='none'> Unit </option>
                                    <?php 
                                        // foreach($divisions as $d) {
                                        //     echo "<option value='{$d->divisionpk}'> {$d->thedivision} </option>";
                                        // }
                                    ?>
                                </select> -->
                                 <select class='form-control mg-b-5' id='employmenttype' name='employmenttype'>
                                    <option value='none'> Employment Type </option>
                                    <?php
                                        foreach($emp_status as $es) {
                                            echo "<option value='{$es->employmenttypepk}'>{$es->theemploymenttype}</option>";
                                        }
                                    ?>
                                </select>
                                <input  type='text' class='form-control mg-b-5' id='signatoryname' name='sign_name' placeholder="Signatory" />
                                <input  type='text' class='form-control mg-b-5' id='positionbox' name='sign_post' placeholder="Position" />
                                <button class='btn btn-info' id='showemployees'> Show Employees </button>
                            </div>
                            <div class='col-md-10' style='min-height: 600px;'>
                                <div class='col-md-12 border-bottom pd-l-0 pd-b-10'>
                                    <button class='btn btn-info' id='senddtrtoemail'> Send to email </button>
                                    <input type='submit' value='Print' class='btn btn-info'/>
                                </div>

                                <table id='employee_table' class='table table-striped'>
                                    <thead style="background: #e1e1e1;">
                                        <tr>
                                            <th style='width:30px; padding: 10px 12px;'> <input type='checkbox' id='checkallcheckboxes'/> </th>
                                            <th> Name </th>
                                            <th> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody id='therowstr'>
                                        <tr>
                                            <td> </td>
                                            <td> Please use the filter on the left to display the employees</td>
                                            <td> </td>
                                        </tr>
                                    </tbody>
                                    <tfoot style="background: #e1e1e1;">
                                        <tr>
                                            <th style='width:30px; padding: 10px 12px;'> <input type='checkbox' id='checkallcheckboxes'/> </th>
                                            <th> Name </th>
                                            <th> Status </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>      
                        </div>   
                        <div class='row'>
                            <div class='col-md-2'>
                                
                            </div>
                            <div class='col-md-10'>
                                <button class='btn btn-info' id='senddtrtoemail'> Send to email </button>
                                <input type='submit' value='Print' class='btn btn-info'/>
                            </div>
                        </div>
                    </form>
                    <?php $msg = session()->get('msg'); echo $msg; ?>
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
</x-app-layout>

    <script>
        $('#dtrdate').daterangepicker({
            "autoApply": true,
        }, function(start, end, label) {
            
        });

        // if (table) {
        //     table.destroy();
        // }

        // var table = $('#employee_table').DataTable({
        //     responsive: true,
        //     language: {
        //         searchPlaceholder: 'Search...',
        //         sSearch: '',
        //         lengthMenu: '_MENU_',
        //     },
        //     searching: false
        // });
    </script>