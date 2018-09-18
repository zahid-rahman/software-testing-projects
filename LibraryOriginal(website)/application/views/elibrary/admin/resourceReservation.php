 <?php
	$aReservation		=	$this->ElibrarySystem->adminBookedReservationsList( );
	/*echo '<pre>';
	print_r($aReservation);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if($aReservation != false){
		$sErrorMsg	=	'';
	}
?>
<?php   

?>			

				<!-- Modal -->
				<form id="AdminReservationModalForm" target="<?php echo site_url('portal/reservation/delete/')?>" method="post" name="AdminReservationModalForm" onsubmit= "sendCancelReservationInstruction('CancelReservationModalID');  ">
				  <div class="modal fade" id="AdminReservationModal" tabindex="-1" role="dialog" aria-labelledby="AdminReservationModal" aria-hidden="true">
				    <div class="modal-dialog">
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				          <h4 class="modal-title">Cancel Reservation</h4>
				        </div>
					        <div class="modal-body">
					         <div class="alert alert-info"> Are you sure you want to delete this record? </div>
					        

					        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
				          <input type= "hidden" name="reservationID" value="0" id="reservationID" />
				          <input  type="submit" class="btn btn-danger" value="Yes, Cancel my reservation"  name= "sav"/>
				        </div>
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /.modal -->
				  </form>


 						<div id="pulling_modal"></div>
	                  <div class="panel panel-primary">
                            <div class="panel-heading">Library resources reservation  List </div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Ref. </th>
                                                            <th>Title</th>
                                                            <th>User</th>
                                                            <th>Date Booked</th>
                                                            <th>Booked against</th>
                                                             <th>return</th>
                                                            <th> Status</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php

                                                    	//print_r($_REQUEST);
															$o = "" ;
															 
															 
															$iI=1;
															foreach($aReservation as $aVals){
																if($aVals['username'] == '' OR is_null($aVals['username'])){
                                                    			$aUser = $this->AppUser->getUserDetails($aVals['lbr_reservedby']);
                                                    			$aVals['username'] = isset($aUser['username']) ? $aUser['username']  :'Unknown User' ;
                                                            }
                                                    		$aVals['username'] =  '<a href="#" onclick= "elibrary_admin_pull_user_details(\''.$aVals['lbr_reservedby'].'\'); return false;"> '.ucfirst($aVals['username']).'</a>' ;

                                                    		
 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lbr_id']."</td>" ;
																	$o .= "<td><a href=\"".elibraryAdminUrl("reservations/".$aVals['lbr_id'])."\" title=\"".$aVals['lci_title']." reservation details\" > ".$aVals['lci_title']." </a></td>" ;
																	$o .= "<td>".$aVals['username']." </td>" ;
																	$o .= "<td>".$aVals['lbr_date_reserved']."</td>" ;
																	$o .= "<td>".$aVals['lbr_date_reserverd_for']."</td>" ;
																	$o .= "<td>".$aVals['lbr_date_to_be_returned']."</td>" ;
																	$o .= "<td>".elibrary_return_reservation_status_display($aVals['lbr_status'])."</td>" ;
																	 



																	
																$o .= "</tr>" ;
																
																 
																$iI++;
															}
															echo $o;


															
														?>
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                            </div>
                            <script src="<?php echo elibraryAssetsLocation('plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    						<script src="<?php echo elibraryAssetsLocation('plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>
                            <script>
								 $(document).ready(function () {
									 $('.dataTables').dataTable();
								 }); 
							</script>
                            
                            
                            




                            