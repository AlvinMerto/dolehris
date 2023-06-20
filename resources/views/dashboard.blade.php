<x-app-layout>
    <div class='pd-30'>
    	<div class='row'> 
    		<div class='col-md-4'>
    			<div class='card pd-15'> 
    				<div class='center-it'>
    					<div class='small-profile-div'>
    						<img src="{{ asset('/upload/DSC_5694.png') }}"/>
    					</div>
    					<h5 class='mg-b-5 mg-t-15'> <?php echo $data[0]->fname." ".$data[0]->mname." ".$data[0]->lname; ?> </h5>
    					<p class='mg-0'>
                            [ <a href="{{url('/logout')}}"> Logout </a> ]       
                        </p>
    				</div>
    				<div class='details-div'>
    					<table class='table table-striped mg-t-20'>
    						<tr>
    							<td> Vacation Leave </td>
    							<td class='tbl_value'> --.-- </td>
    						</tr>
    						<tr>
    							<td> Sick Leave </td>
    							<td class='tbl_value'>--.-- </td>
    						</tr>
    						<tr>
    							<td> Forced Leave Count (2023) </td>
    							<td class='tbl_value'> - </td>
    						</tr>
    						<tr>
    							<td> Special Leave Count (2023) </td>
    							<td class='tbl_value'> --.-- </td>
    						</tr>
    						<tr>
    							<td> COC </td>
    							<td class='tbl_value'> --.-- </td>
    						</tr>
    					</table>
    				</div>
    			</div>
    		</div>
    		<div class='col-md-8'>
    			<div class='card pd-15'> 
    				<?php $navigation = "notifications"; ?>
    				<ul class='pd-0 mg-b-0 flex-it navigation-inline' id='inside-nav-ul'>
                        <li class="tabnav <?php if ($navigation == "notifications") { echo "selected-nav"; } ?>" data-nav='notifications' data-parent='dashboard'> Notifications </li>
                        <li class="tabnav <?php if ($navigation == "requests") { echo "selected-nav"; } ?>" data-nav='requests' data-parent='dashboard'> Daily Time Records </li>
                        <li class="tabnav <?php if ($navigation == "leavecredits") { echo "selected-nav"; } ?>" data-nav='leavecredits' data-parent='dashboard'> Accomplishment Report </li>
                        <li class="tabnav <?php if ($navigation == "leaveapplications") { echo "selected-nav"; } ?>" data-nav='leaveapplications' data-parent='dashboard'> Leave Applications </li>
                        <li class="tabnav <?php if ($navigation == "payslip") { echo "selected-nav"; } ?>" data-nav='payslip' data-parent='dashboard'> Payslips </li> 
                    </ul>
    			</div>
                <div class='pd-15 mg-t-10' id='theprofileinput'>
                    <p class='mg-0'> No file to show </p>
                </div>
    		</div>
    	</div>
    </div>
        
</x-app-layout>

<script src="{{asset('dolejs/dashboard.procs.js')}}"></script>