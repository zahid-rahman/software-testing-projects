<?php
	$aViolation		=	$this->ElibrarySystem->adminStudentViolations();
	/*echo '<pre>';
	print_r($aReservation); $aContent['aRecordList']			=	$this->MyLibrary->studentBorrowedResources($aForBorrowed);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if($aViolation != false){
		$sErrorMsg	=	'';
	}
?>
<?php   

?>						  

	                  <div class="panel panel-primary">
                            <div class="panel-heading">Offences record list </div>
                            <div class="panel-body">

                           <span id = "staus_change_response"></span>
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover datatables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Borrow Code</th>
                                                            <th>Student </th>
                                                            <th>Item </th>
                                                            <th>Offence</th>
                                                            
                                                            <th>Fine</th>

                                                            
                                                             
                                                            <th> Status</th>
                                                            <th> Manage</th>
                                                             
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															$bin = "odd";
															$row_total = 12;
															$iI=1;
															foreach($aViolation as $aVals){

															 
                                                    		$aVals['username'] =  '<a href="#" onclick= "elibrary_admin_pull_user_details(\''.$aVals['lbci_user_id'].'\'); return false;"> '.ucfirst($this->AppUser->getUserDetials($aVals['lbci_user_id'],true)).'</a>' ;



 																$o .= "<tr class='".$bin."'>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lbci_id']."</td>" ;
																	$o .= '<td>'.$aVals['username'].'</td>' ;
																	$o .= "<td>".$aVals['lci_title']."</td>" ;
																	$o .= "<td> ".$aVals['loft_title']."  </td>" ;
																	
																	$o .= "<td>".$aVals['loft_fee']."</td>" ;
																	 
																	$o .= "<td>".studentBorrowViolationStatus($aVals['lbci_cleared'])."</td>" ;
																	 if($aVals['lbci_cleared'] != 1 ){
																	 	$btn = '<button class= "btn btn-primary" onclick = "markascomplete('.$aVals['lbci_id'].'); return false;" > Make as cleared </button>';
																	 }else{
																	 	$btn  = '';
																	 }
																	$o .= '<td>'.$btn.'</td>' ;


																	
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
                            
                            
                            
                            




                            