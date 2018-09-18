<?php
	//$aRecordList		=	$this->MyLibrary->studentBorrowedResources((int)$this->AppUser->getUserId());
	/*echo '<pre>';
	print_r($aReservation); $aContent['aRecordList']			=	$this->MyLibrary->studentBorrowedResources($aForBorrowed);
	echo '</pre>';*/
	

?>						  

	                  <div class="panel panel-primary">
                            <div class="panel-heading">My borrowed library resources   </div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Call No.</th>
                                                            <th>Title</th>
                                                            <th>Date Collected</th>
                                                            <th>Date Due</th>
                                                            <th>Date Returned</th>
                                                            <th>Violation</th>
                                                            <th> Status</th>
                                                            
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
                                                    		$sViolationClass = '';
                                                    		

															$o = "" ;
															 
															$row_total = 12;
															$iI=1;
															foreach($mPreparedContent as $aVals){
																if($aVals['lbci_offense']){
                                                    			$sViolationClass = 'warning';
                                                    		}
 																$o .= "<tr class='".$sViolationClass."'>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lci_callnumber']."</td>" ;
																	$o .= "<td><a href=\"". generateElibraryCatalogueLink($aVals['lci_id'])."\" title=\"".$aVals['lci_title']."\" > ".$aVals['lci_title']." </a></td>" ;
																	$o .= "<td>".$aVals['lbci_date_collected']."</td>" ;
																	$o .= "<td>".$aVals['lbci_date_to_be_returned']."</td>" ;
																	$o .= "<td>".$aVals['lbci_date_returned']."</td>" ;
																	$o .= "<td>".$aVals['loft_title']."</td>" ;
																	$o .= "<td>".elibrary_return_borrow_status_display($aVals['lbci_returned'])."</td>" ;
																	
																	
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
                            <script src="<?php echo $sRootDirLink ; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
                            <script>
								 $(document).ready(function () {
									 $('.datatable').dataTable();
								 });
							</script>
                            
                            
                            




                            