						<div class='mg-t-10'>
							<p> Applying for Vacation Leave </p>
							<table class='max-width'>
								<thead>
									<th colspan='2' class='pd-t-15 pd-b-10'> In case of Vacation/Special Privilege Leave: </th>
								</thead>
								<tbody>
									<?php foreach($vacationloc as $vloc) { ?>
										<tr>
											<td class='center-it pd-t-5 pd-b-5' 
												style='width: 25px;'> 
												<input type='radio' name='vacayloc[]' 
													   id='vac_loc_<?php echo $vloc->vacationlocpk; ?>' 
													   value='<?php echo $vloc->vacationlocpk; ?>'/> 
											</td>
											<td class='pd-t-5 pd-b-5'> 
												<label for='vac_loc_<?php echo $vloc->vacationlocpk; ?>' 
													   class='mg-b-0'> <?php echo $vloc->thevalue; ?> 
												</label> 
											</td>
										</tr>
									<?php } ?>
									<!-- <tr>
										<td class='center-it pd-t-5 pd-b-5' style='width: 25px;'> <input type='radio'  name='vacayloc[]' id='abroadchck' value='2'/> </td>
										<td class='pd-t-5 pd-b-5'> <label for='abroadchck' class='mg-b-0'> Abroad </label> </td>
									</tr>
									<tr>
										<td> &nbsp;</td>
										<td> <input type='text' class='form-control max-width'/> </td>
									</tr> -->
								</tbody>
							</table>

							<table class='max-width'>
								<thead>
									<th colspan='2' class='pd-t-15 pd-b-10'> Commutation: </th>
								</thead>
								<tbody>
									<?php foreach($commutation as $c) { ?>
										<tr>
											<td class='center-it pd-t-5 pd-b-5' style='width: 25px;'> 
												<input type='radio' name='commutation[]' 
														id='commutation_<?php echo $c->commutationpk; ?>' 
														value='<?php echo $c->commutationpk ?>'/> 
											</td>
											<td class='pd-t-5 pd-b-5'> 
												<label for='commutation_<?php echo $c->commutationpk; ?>' 
														class='mg-b-0'> <?php echo $c->thevalue; ?> </label> 
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>

							<table class='max-width border-tbl mg-t-40'>
								<thead>
									<th colspan='2' class='pd-t-15 pd-b-15'> Certification of Leave Credits </th>
								</thead>
								<tbody>
									<tr>
										<th class='center-it pd-t-5 pd-b-5'> &nbsp; </th>
										<th class='pd-t-5 pd-b-5'>  Vacation Leave  </th>
									</tr>
									<tr>
										<th class='center-it pd-t-5 pd-b-5' style='width: 200px;'> Less this Application </th>
										<th class='pd-t-5 pd-b-5'>  &nbsp; </th>
									</tr>
								</tbody>
							</table>

						</div>