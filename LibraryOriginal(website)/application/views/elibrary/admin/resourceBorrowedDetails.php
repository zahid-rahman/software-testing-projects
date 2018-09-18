<?php
/*echo '<pre>';
print_r($mPreparedContent['search_result']);
echo '</pre>';
//die();*/

$aVals = $mPreparedContent;
if($aVals['username'] == '' OR is_null($aVals['username'])){
                                                          $aUser = $this->AppUser->getUserDetails($aVals['lbci_user_id']);
                                                         $aVals['username'] = isset($aUser['username']) ? $aUser['username']  :'Unknown User' ;
                                                            }
                                                        $aVals['username'] =  '<a href="#" onclick= "elibrary_admin_pull_user_details(\''.$aVals['lbci_user_id'].'\'); return false;"> '.ucfirst($aVals['username']).'</a>' ;




                                                        
                                                        
?>
	
	<?php $sContent ='
 	<form action ="'.elibraryAdminUrl("borrowed/update").'" method="post" name="resourceBorrowDetailsForms" id="resourceBorrowDetailsForms" >
	<div class="panel panel-primary">
                            <div class="panel-heading">Transaction  Details </div>
                            <div class="panel-body">


                            <input type="hidden"  name="reservation_key_holder" value="'.$aVals['lbr_id'].'" id="reservation_key_holder" />
		 	
		<div class="row">
			 
			 
			<span class="col-lg-8">
			 

				<div class="row">
			<div class="col-lg-12">
						<div class="table-responsive">
						  <table class="table table-striped  table-hover  table-condensed">
						  <tr > <th> <small>Transaction Code </small></th> <td><strong> '. ($aVals['lbr_id']).'  </strong></td>  </tr>
						   <tr > <th> <small>Item title </small></th> <td><strong> '.ucfirst($aVals['lci_title']).'  </strong></td>  </tr>
						    
						  
						   <tr > <th><small> Call Number </small></th>  <td> '.$aVals['lci_callnumber'].'  </td>   </tr>

						    <tr > <th> <small> Borrowed By </small></th>  <td> '.$aVals['username'].'  </td>   </tr>


						   <tr > <th><small> Date Collected</small></th>  <td> '.$aVals['lbr_date_reserved'].'     </tr>
						   <tr > <th><small> Date to be returned (Due Date) </small></th>  <td> '.$aVals['lbr_date_to_be_returned'].'

                             </td>   </tr>
						   <tr > <th><small> Date returned </small></th>  <td> <div class="input-group input-append date" id="returnatevalueAppend" data-date="'.$aVals['lbr_date_to_be_returned'].'" data-date-format="dd-mm-yyyy">
                                <input id="returnatevalue" name="returnatevalue" required class="form-control" value="'.$aVals['lbr_date_to_be_returned'].'"   type="date" data-provide="datepicker" >
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div> 

                             </td>   </tr>
                             <tr > <th><small> Violation</small></th>  <td> <select name="admin_reserve_status" required class="form-control">'.elibrary_form_select_element(reservationStatus(), $aVals['lbr_status'],'id','title','--CHANGE STATUS--').'
                   
                </select>  </td>   </tr>


                             <tr > <th><small> Transaction Status</small></th>  <td> <select name="admin_reserve_status" required class="form-control">'.elibrary_form_select_element(borrowStatus(), $aVals['lbr_status'],'id','title','--CHANGE STATUS--').'
                   
                </select>  </td>   </tr>

						    
						   <tr > <th><small> Admin Comment / Message</small></th>  <td> <textarea class="form-control" name="admin_comment">'.$aVals['lbr_admin_note'].'</textarea></td>   </tr>
						   
						   
						  </table>
						</div>
			</div>
			</div>

 

			 </span> <hr/>
			<span class="col-lg-3"><img src ="'.generatePortalEndCatalogueImageLink($aVals['lci_snapshot']).'" class="img-responsive img  img-rounded" alt=" '.$aVals['lci_title'].'"/> </span>
		</div> 

		<input name="saveReservationDetailsByAdminBtn" id="saveReservationDetailsByAdminBtn" type="submit" class="btn btn-primary" value="Save Record"/>
		
		<span class="ajaxResponseReception pull-right" id="ajaxResponseReceptionID"> </span>

		</div> </div>
		</form>
		';

		echo  $sContent;
		?>



		<?php echo '<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Reservation Form</h4>
        </div>
        <div class="modal-body">
          <form  id="saveReservationModalFormID" name="sectionForm" class="form-horizontal" role="form" action="" method="post"  >
  <div class="form-group">
    <label for="secTitle" class="col-lg-3 control-label requiured">Item Title</label>
    <div class="col-lg-9">
      <input id="itemTitle" name="itemTitle" readonly="readonly" type="text" class="form-control col-lg-12" />
    </div>
  </div>
  <input id="itemID" name="itemID" type="hidden" />

  <div class="form-group">
    <label for="secTitle" class="col-lg-3 control-label requiured">Library</label>
    <div class="col-lg-9">
      <input  id="libs" readonly="readonly" type="text" class="form-control col-lg-12" />
    </div>
  </div>

  <div class="form-group">
    <label for="sectionType" class="col-lg-3 control-label requiured">Pick Up Date</label>
    


    					<div class="col-lg-9">
                            <div class="input-group input-append date" id="pickerDateAppend" data-date="'.date("d-m-Y",time()).'" data-date-format="dd-mm-yyyy">
                                <input id="pickupdatevalue" name="pickupdatevalue" required class="form-control" value="'.date("d-m-Y",time()).'"   type="date" data-provide="datepicker" >
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>

  </div>
  
   
 
   <div class="form-group">
    <label for="secDescription" class="col-lg-3 control-label ">Note</label>
    <div class="col-lg-9">
       <textarea name="secDescription" id="secDescription" class="form-control col-lg-12" rows="3" placeholder="Description / Note"></textarea>
    </div>
  </div>
  
  
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
      <button id="saveReservationButton" type="submit" class="btn btn-info">Submit Reservation</button>
    </div>
    
    
  </div>
  <div id="userResponseFiles"></div>
  
</form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --><script>  $(\'#pickerDate\').datepicker()</script>';

