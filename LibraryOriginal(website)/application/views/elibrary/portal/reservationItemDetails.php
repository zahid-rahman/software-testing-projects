<?php
/*echo '<pre>';
print_r($mPreparedContent['search_result']);
echo '</pre>';
//die();*/

$aVals = $mPreparedContent['search_result'];
?>

<?php

	$sContent =  '
	<div class="panel panel-primary">
                            <div class="panel-heading">Reservation  Details </div>
                            <div class="panel-body">



		<div class="row">
			<div class="col-lg-12"> <h3> '.$aVals['lci_title'].' </h3> </div>
			 
		</div>	
		<div class="row">
			 
			 
			<span class="col-lg-8">
			 

				<div class="row">
			<div class="col-lg-12">
						<div class="table-responsive">
						  <table class="table table-striped  table-hover  table-condensed">
						   <tr > <th> <small>Author  </small></th> <td> '.ucfirst($aVals['lci_author']).'  </td>  </tr>
						   <tr > <th> <small> Published </small></th>  <td> '.$aVals['lci_year_published'].'  </td>   </tr>
						   <tr > <th><small> Call Number </small></th>  <td> '.$aVals['lci_callnumber'].' ` </td>   </tr>

						   <tr > <th><small> Date Booked</small></th>  <td> '.$aVals['lbr_date_reserved'].'  </td>   </tr>
						   <tr > <th><small> Booked Against </small></th>  <td> '.$aVals['lbr_date_reserverd_for'].'  </td>   </tr>
						   <tr > <th><small> Approved return date </small></th>  <td> '.$aVals['lbr_date_to_be_returned'].'  </td>   </tr>
						   <tr > <th><small> Transaction reference code </small></th>  <td> '.$aVals['lbr_id'].'  </td>   </tr>
						   <tr > <th><small> Transaction Status</small></th>  <td> '.elibrary_return_reservation_status_display($aVals['lbr_status']).'  </td>   </tr>
						   <tr > <th><small> Comment / Message</small></th>  <td> '.$aVals['lbr_user_note'].'  </td>   </tr>
						   <tr > <th><small>Admin  Comment / Message</small></th>  <td> '.$aVals['lbr_admin_note'].'  </td>   </tr>
						  </table>
						</div>
			</div>
			</div>



			 </span>
			<span class="col-lg-3"><img src ="'.generatePortalEndCatalogueImageLink($aVals['lci_snapshot']).'" class="img-responsive img  img-rounded" alt=" '.$aVals['lci_title'].'"/> </span>
		</div><hr/>


		</div> </div>
		';

		echo  $sContent;
		?>