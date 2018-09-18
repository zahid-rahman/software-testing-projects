<?php
	$aReservation		=	$this->MyLibrary->myBookedReservations($this->AppUser->getUserId());
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
				<div class="modal fade" id="CancelReservationModal" tabindex="-1" role="dialog" aria-labelledby="CancelReservationModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				      <div class="modal-content " >
				      <form id="CancelReservationModalID" target="<?php echo site_url('portal/reservation/delete/')?>" method="post" name="CancelReservationModalName"  >
				  

				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				          <h4 class="modal-title">Delete Reservation Record</h4>
				        </div>
					        <div class="modal-body" id="needed">
					         <div class="alert alert-info"> Are you sure you want to delete this record? </div>
					        

					          <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
				          <input type= "hidden" name="reservationID" value="0" id="reservationID" />
				          <input id="CancelReservationModalIDSubmit" type="submit" class="btn btn-danger" value="Yes, Cancel my reservation"  name= "sav"/>
				        

					        </div>
				        <div class="modal-footer">
				         </div>

				         </form>
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /.modal -->
				  


  			     <div class="alert alert-info"> <h4> Information [How to reserve library resouces]</h4> 
							
							Please navigate to the "OPAC" link and search for any library resources you want to add to your reservation list. </div>  
                         

	                  <div class="panel panel-primary">
                            <div class="panel-heading">My library resources reservation  List </div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Title</th>
                                                            <th>Date Booked</th>
                                                            <th>Booked against</th>
                                                            <th> Status</th>
                                                            <th>Manage</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php

                                                    	//print_r($_REQUEST);
															$o = "" ;
															$bin = "odd";
															$row_total = 12;
															$iI=1;
															foreach($aReservation as $aVals){
 																$o .= "<tr class='".$bin."'>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td><a href=\"".generateElibraryCatalogueLink($aVals['lci_id'])."\" title=\"".$aVals['lci_title']."\" > ".$aVals['lci_title']." </a></td>" ;
																	$o .= "<td>".$aVals['lbr_date_reserved']."</td>" ;
																	$o .= "<td>".$aVals['lbr_date_reserverd_for']."</td>" ;
																	$o .= "<td>".elibrary_return_reservation_status_display($aVals['lbr_status'])."</td>" ;
																	$o .= "<td class='center'>";


																		$o .= '<div class="btn-group">
																		  <button type="button" class="btn btn-primary">Manage</button>
																		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		    <span class="caret"></span>
																		  </button>
																		  <ul class="dropdown-menu" role="menu">
																		    <li><a href="'.generateElibraryCatalogueLink($aVals['lci_id']).'">View Item Details</a></li>
																		    <li><a href="'.generateElibraryReservationDetailsLink($aVals['lbr_id']).'">View Reservation Details</a></li>
																		    <li><a href="#"></a></li>';

																		  if($aVals['lbr_status']  ==0  || $aVals['lbr_status']  ==1){

																		  	$o .= '<li class="divider"></li>
																		    <li><a href="#"   onclick="return deleteReservationPopUp(\''.quotes_to_entities($aVals['lci_title']).'\',\''.$aVals['lbr_id'].'\' ); return false;" >Delete Reservation</a></li>
																		  ';

																		  }  

																		  $o .= '</ul>
																		</div>

																	</td>';



																	
																$o .= "</tr>" ;
																
																if($bin == "odd"){ $bin = "even"; 
																}else if($bin == "even"){ $bin = "odd"; }
																$iI++;
															}
															echo $o;


															
														?>
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                            </div>
                         
						 
						  
                            
                            
                            




                            