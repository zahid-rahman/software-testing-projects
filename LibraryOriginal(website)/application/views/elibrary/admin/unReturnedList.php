<?php
	$aReturned		=	$this->ElibrarySystem->adminReturnedRecords();

	/*echo '<pre>';
	print_r($aLibrary);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if(!count($aReturned)){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>
						  <div class="row"> <div class="col-lg-4">  <a href="<?php echo $this->config->item("base_url") ?>elibrary/admin/returned/new/" type="button" class="btn btn-success">Create New +</a></div> </div><br/> 
                        <div class="panel panel-primary">
                            <div class="panel-heading">Returned Resources Record List</div>
                            <div class="panel-body">
                              
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed dataTables table-hover" id="dataTables-borrowedResourceList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Borrow Code</th>
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
															foreach($aReturned as $aVals){
																if($aVals['lbci_offense']){
                                                    			$sViolationClass = 'warning';
                                                    		}
 																$o .= "<tr class='".$sViolationClass."'>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lbci_id']."</td>" ;
																	$o .= "<td><a href=\"".elibraryAdminCatalogPage($aVals['lci_id'])."\" title=\"".$aVals['lci_title']."\" > ".$aVals['lci_title']." </a></td>" ;
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
                            
                            
                            
                            




