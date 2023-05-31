<div class='pd-15 body-wrap' id=''> <!-- body-wrap -->
    <?php $thename = $selected[0]->lname.", ".$selected[0]->fname." ".$selected[0]->mname; ?>
       <div class='border-bottom mg-b-0'>
            @include("personnel.aplets.insideheadername")
            @section('thename')
        </div>
        @include("personnel.aplets.insidenav",["navigation"=>"leavecredits"])
        <div class='body-div'> <!-- body div -->
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th colspan="20" style='padding-left:0px;'>
                            <button class='btn btn-primary'> COC </button>
                            <button class='btn btn-primary'> Forced Leave </button>
                            <button class='btn btn-primary'> Special Leave </button>
                            <button class='btn btn-primary'> Add Leave </button>
                            <button class='btn btn-primary' id='fbbtn'> Forward Balance </button>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="" class='border-bottom border-top border-left'>
                            
                        </th>
                        <th colspan="4" class='border-bottom border-top border-right'>
                            <p class='mg-0 center-it'> Particulars </p>
                        </th>
                        <th colspan="4" class='border-bottom border-top border-right'>
                            <p class='mg-0 center-it'> Vacation Leave </p>
                        </th>
                        <th colspan="4" class='border-bottom border-top border-right'>
                            <p class='mg-0 center-it'> Sick Leave </p>
                        </th>
                    </tr>
                    <tr>
                        <th class='border-bottom border-left'> Period </th>
                        <th class='border-bottom border-right'> &nbsp; </th>
                        <th class='border-bottom border-right'> Day/s </th>
                        <th class='border-bottom border-right'> Hrs </th>
                        <th class='border-bottom border-right'> Mins </th>

                        <th class='border-bottom border-right'> Earned </th>
                        <th class='border-bottom border-right'> With Pay </th>
                        <th class='border-bottom border-right'> Balance </th>
                        <th class='border-bottom border-right'> W/O Pay </th>

                        <th class='border-bottom border-right'> Earned </th>
                        <th class='border-bottom border-right'> With Pay </th>
                        <th class='border-bottom border-right'> Balance </th>
                        <th class='border-bottom border-right'> W/O Pay </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Jan. 1, 2, 3 , 4, 2023 </td>
                        <td> SPL(2) </td>
                        
                        <td> 4 </td>
                        <td> &nbsp; </td>
                        <td> &nbsp; </td>

                        <td> 1.25 </td>
                        <td> 0.177 </td>
                        <td> 11.982 </td>
                        <td> &nbsp; </td>

                        <td> 1.25 </td>
                        <td> &nbsp; </td>
                        <td> 12.625 </td>
                        <td> &nbsp; </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
</div>