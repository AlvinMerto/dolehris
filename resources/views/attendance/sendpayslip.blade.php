<x-app-layout>
	<div class='pd-30'>
		<form method="POST" action="{{route('sendpayslip')}}" enctype="multipart/form-data">
			@csrf 
			<input type='file' name='fileinput'/> <br/>
			<input type='text' placeholder='Subject' name='subjectinput'/> <br/>
			<input type='submit' value='Send Payslip' name='sendbtn'/>
		</form>

		<?php
			if ($html != null) {
				echo $html;
			}
		?>
	</div>
</x-app-layout> 