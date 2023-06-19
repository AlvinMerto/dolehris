<div class='row'>
	<div class='col-md-7 pd-l-0'>
		<div class=''>
			<h6 class='unbold'> Apply for Leave </h6>
			<div class='card pd-30 box-shadow-it border-radius-it mg-t-25'>
				<p class='mg-b-15'> <strong> Inclusive Dates </strong>
					<span id='moredates'> </span>
				</p>
				<div class="input-group mg-b-10">
					<input type='text' class='form-control mg-b-10 datepick_txtbox'/>
					<!-- <button class='btn btn-default btn-xs' id='queuedate'> Add date </button> -->
				</div>
				<select class="form-control select2-show-search" data-placeholder="Choose one" id='leavetypeselect'>
					<option value='0'> -- SELECT -- </option>
					<optgroup label="Leave Applications">
						<?php
							foreach($leavetypes as $lt ) {
								if ($lt->groupid == 1) {
									echo "<option value='{$lt->leavetypepk}_{$lt->navigation}'> {$lt->theleave} </option>";
								}
							}
						?>
					</optgroup>

					<optgroup label='Official Business'>
						<?php
							foreach($leavetypes as $lt ) {
								if ($lt->groupid == 2) {
									echo "<option value='{$lt->leavetypepk}_{$lt->navigation}'> {$lt->theleave} </option>";
								}
							}
						?>
					</optgroup>

					<optgroup label='Compensatory Time-Off'>
						<?php
							foreach($leavetypes as $lt ) {
								if ($lt->groupid == 3) {
									echo "<option value='{$lt->leavetypepk}_{$lt->navigation}'> {$lt->theleave} </option>";
								}
							}
						?>
					</optgroup>

					<optgroup label='Other Purpose'>
						<?php
							foreach($leavetypes as $lt ) {
								if ($lt->groupid == 4) {
									echo "<option value='{$lt->leavetypepk}_{$lt->navigation}'> {$lt->theleave} </option>";
								}
							}
						?>
					</optgroup>
				</select>

				<!-- start of changing components -->
					<div id='changecomponents'>
						
					</div>
				<!-- end of changing components -->

					<div class="mg-t-25" style="text-align: right;">
						<button class="btn btn-primary"> Print </button>
						<button class="btn btn-primary" id='sendapplication' data-id='<?php echo $empid; ?>'> Send Application </button>
					</div>
			</div>
		</div>
	</div>
	<div class='col-md-5'>
		<h6 class='unbold'> Leave Applications </h6>

		<div id='theapplications' class='mg-t-25'>
			<div class='theitems'>
				<div class='thedatediv'>
					<p class='themonthname'> JANUARY 2023 </p>
					<hr/> 
				</div>
				<div class='infodiv'>
					<div class='item-details-div'>
						<p class='leavetype'> <i class="fa fa-circle" aria-hidden="true"></i> Vacation Leave </p>
						<p class='inclusivedates'> <i class="fa fa-calendar-o" aria-hidden="true"></i> Month 2X, 2XXX </p>
						<p class='statustext approved'> Approved </p>
					</div>
					<div class='item-details-div'>
						<p class='leavetype'> <i class="fa fa-circle" aria-hidden="true"></i> Sick Leave </p>
						<p class='inclusivedates'> <i class="fa fa-calendar-o" aria-hidden="true"></i> Month 2X, 2XXX </p>
						<p class='statustext declined'> Declined </p>
					</div>
				</div>
			</div>
			<div class='theitems'>
				<div class='thedatediv'>
					<p class='themonthname'> FEBRUARY 2023 </p>
					<hr/> 
				</div>
				<div class='infodiv'>
					<div class='item-details-div'>
						<p class='leavetype'> <i class="fa fa-circle" aria-hidden="true"></i> Vacation Leave </p>
						<p class='inclusivedates'> <i class="fa fa-calendar-o" aria-hidden="true"></i> Month 2X, 2XXX </p>
						<p class='statustext approved'> Approved </p>
					</div>
					<div class='item-details-div'>
						<p class='leavetype'> <i class="fa fa-circle" aria-hidden="true"></i> Sick Leave </p>
						<p class='inclusivedates'> <i class="fa fa-calendar-o" aria-hidden="true"></i> Month 2X, 2XXX </p>
						<p class='statustext declined'> Declined </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


