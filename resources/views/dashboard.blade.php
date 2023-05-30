<x-app-layout>
    <div class='pd-30'>
    	<div class='row'> 
    		<div class='col-md-3'>
    			<div class='card pd-15'> 
    				<div class='center-it'>
    					<div class='small-profile-div'>
    						<img src="{{ asset('/upload/DSC_5694.png') }}"/>
    					</div>
    					<h5 class='mg-b-5 mg-t-15'> <?php echo $data[0]->fname." ".$data[0]->mname." ".$data[0]->lname; ?> </h5>
    					<p class='mg-0'> TUPAD Coordinator - TSSD </p>
    				</div>
    				<div class='details-div'>
    					<table class='table table-striped mg-t-20'>
    						<tr>
    							<td> Vacation Leave </td>
    							<td class='tbl_value'> 23.63 </td>
    						</tr>
    						<tr>
    							<td> Sick Leave </td>
    							<td class='tbl_value'>23.63 </td>
    						</tr>
    						<tr>
    							<td> Forced Leave Count (2023) </td>
    							<td class='tbl_value'> 1 </td>
    						</tr>
    						<tr>
    							<td> Special Leave Count (2023) </td>
    							<td class='tbl_value'> 23.63 </td>
    						</tr>
    						<tr>
    							<td> COC </td>
    							<td class='tbl_value'> 23.63 </td>
    						</tr>
    					</table>
    				</div>
    			</div>
    		</div>
    		<div class='col-md-9'>
    			<div class='card pd-15'> 
    				<?php $navigation = "profile"; ?>
    				<ul class='pd-0 mg-b-0 space-between navigation-inline' id='inside-nav-ul'>
                        <li class="tabnav <?php if ($navigation == "profile") { echo "selected-nav"; } ?>" data-nav='profile'> Notifications </li>
                        <li class="tabnav <?php if ($navigation == "requests") { echo "selected-nav"; } ?>" data-nav='requests'> Daily Time Records </li>
                        <li class="tabnav <?php if ($navigation == "leavecredits") { echo "selected-nav"; } ?>" data-nav='leavecredits'> Accomplishment Report </li>
                        <li class="tabnav <?php if ($navigation == "leaveapplications") { echo "selected-nav"; } ?>" data-nav='leaveapplications'> Leave Applications </li>
                        <li class="tabnav <?php if ($navigation == "dtr") { echo "selected-nav"; } ?>" data-nav='dtr'> Leave Cards </li>
                        <li class="tabnav <?php if ($navigation == "payslip") { echo "selected-nav"; } ?>" data-nav='payslip'> Payslips </li> 
                        <li class="tabnav <?php if ($navigation == "memos") { echo "selected-nav"; } ?>" data-nav='memos'> Memos </li>
                        <li class="tabnav <?php if ($navigation == "splorders") { echo "selected-nav"; } ?>" data-nav='splorders'> Special Orders </li>
                        <li class="tabnav <?php if ($navigation == "servrecs") { echo "selected-nav"; } ?>" data-nav='servrecs'> Service Records </li>
                        <li class="tabnav <?php if ($navigation == "pds") { echo "selected-nav"; } ?>" data-nav='pds'> PDS </li>
                        <li class="tabnav <?php if ($navigation == "birfiles") { echo "selected-nav"; } ?>" data-nav='birfiles'> 201 Files </li>
                    </ul>
    			</div>
    		</div>
    	</div>
    </div>
</x-app-layout>