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
					<button class='btn btn-default btn-xs'> Add date </button>
				</div>
				<select class="form-control select2-show-search" data-placeholder="Choose one" id='leavetypeselect'>
					<option value='0'> -- SELECT -- </option>
					<optgroup label="Leave Applications">
						<option value='vacationleave'> Vacation Leave (Sec. 51, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option value='forcedleave'> Mandatory/Forced Leave (Sec. 25, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option value='sickleave'> Sick Leave (Sec. 43, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option> Maternity Leave (R.A. No. 11210 / IRR issued by CSC, DOLE and SSS) </option>
						<option> Paternity Leave (R.A. No. 8187 / CSC MC No. 71, s. 1998, as amended) </option>
						<option> Special Privilege Leave (Sec. 21, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option> Solo Parent Leave (RA No. 8972 / CSC MC No. 8, s. 2004) </option>
						<option> Study Leave (Sec. 68, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option> 10-Day VAWC Leave (RA No. 9262 / CSC MC No. 15, s. 2005) (Specify Illness) </option>
						<option> Rehabilitation Privilege (Sec. 55, Rule XVI, Omnibus Rules Implementing E.O. No. 292) </option>
						<option> Special Leave Benefits for Women (RA No. 9710 / CSC MC No. 25, s. 2010) </option>
						<option> Special Emergency (Calamity) Leave (CSC MC No. 2, s. 2012, as amended) Completion of Master's Degree </option>
						<option>Adoption Leave(R.A. No. 8552) </option>
					</optgroup>
					<optgroup label='Official Business'>
						<option> Apply for OB </option>
					</optgroup>
					<optgroup label='Compensatory Time-Off'>
						<option> Apply for CTO </option>
					</optgroup>
					<optgroup label='Compassionate Time-Off'>
						<option> Apply for Compassionate time-off </option>
					</optgroup>
					<optgroup label='Other Purpose'>
						<option> Monetization of Leave Credits </option>
						<option> Terminal Leave </option>
					</optgroup>
				</select>

				<!-- start of changing components -->
					<div id='changecomponents'>
						
					</div>
				<!-- end of changing components -->

					<div class="mg-t-25" style="text-align: right;">
						<button class="btn btn-primary"> Print </button>
						<button class="btn btn-primary" id='sendapplication'> Send Application </button>
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

<script src="{{asset('dolejs/dashboard.procs.js')}}"></script>

<script>
	$('.datepick_txtbox').daterangepicker({
            "autoApply": true,
        }, function(start, end, label) {
            
        });
</script>