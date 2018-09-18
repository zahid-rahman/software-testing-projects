<?php
	$aViolation		=	$this->MyLibrary->studentViolations(array('iStudent'=>(int)$this->AppUser->getUserId()));
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
                            <div class="panel-heading">Offences linked to my account</div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Borrow Code</th>
                                                            <th>Item </th>
                                                            <th>Offence</th>
                                                            
                                                            <th>Fine</th>

                                                            
                                                             
                                                            <th> Status</th>
                                                             
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															$bin = "odd";
															$row_total = 12;
															$iI=1;
															foreach($aViolation as $aVals){
 																$o .= "<tr class='".$bin."'>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lbci_id']."</td>" ;
																	$o .= "<td>".$aVals['lci_title']."</td>" ;
																	$o .= "<td> ".$aVals['loft_title']."  </td>" ;
																	
																	$o .= "<td>".$aVals['loft_fee']."</td>" ;
																	 
																	$o .= "<td>".studentBorrowViolationStatus($aVals['lbci_cleared'])."</td>" ;
																	 



																	
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
                            <script src="<?php echo $sRootDirLink ; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
                            <script>
								 $(document).ready(function () {
									 $('.datatable').dataTable();
								 });
							</script>
                            
                            
                            




                            