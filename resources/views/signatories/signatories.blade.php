<x-app-layout>
	<div class='pd-30'>
		<div class='card pd-30'>
			<div class='row'>
				<div class='col-md-4'>
					<h6> Change Signatories </h6>
						<select class='form-control' id='theoffice'>
							<?php
								foreach($offices as $o) {
									echo "<option value='{$o->areaofficepk}'>";
										echo $o->theareaoffice;
									echo "</option>";
								}
							?>
						</select>
					
					<div class="">
						<select class="form-control select2-show-search" data-placeholder="Choose one" id='thesignatory_select'>
							<?php
								foreach($personnel as $p) {
									echo "<option value='{$p->perid}'>";
										echo $p->lname.", ".$p->fname." ".$p->mname;
									echo "</option>";
								}
							?>
						</select>
					</div>
					
					<button class='btn btn-primary mg-t-10 savesignatory' 
						    data-indexkey="theoffice" 
						    data-updatewith="thesignatory_select" 
						    data-tbl='area_offices' 
						    data-fld='thesignatory' 
						    data-key='areaofficepk'> Save as the Signatory </button>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>