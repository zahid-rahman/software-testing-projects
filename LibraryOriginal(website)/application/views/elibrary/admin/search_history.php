<?php
	$aMySearches		=	$this->MyLibrary->StudentSearchHistory($this->AppUser->getUserId());

/*	echo '<pre>';
	print_r($aMyFiles);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if(!count($aMySearches)){
		$sErrorMsg	=	'';
	}
?>						<!-- Beginning of modal code for upload -->
					  <div class="panel panel-primary">
                            <div class="panel-heading">My Previous Searches</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-courses">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Keywords</th>
                                                            <th>Search Type</th>
                                                            <!-- <th>No of search</th> -->
                                                            <th>Date Added</th>
                                                            <th>Last Searched</th>
                                                            
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															
															$iI=1;
															foreach($aMySearches as $aVals){
 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td><a href=\"".elibraryAdminUrl($aVals['luss_search_type'].'/?'.$aVals['luss_query'])."\"  title=\"Search for \"".$aVals['luss_query']."\"  target = \"_blank\">".$aVals['luss_keyword']." </a></td>" ;
																	$o .= "<td>".eLibrarytransalateCatalogueSearchType($aVals['luss_search_type'])."</td>" ;
																	
																	/*$o .= "<td>";
																	$o .= $aVals['luss_no_of_visits']. '</td>';*/

																	$o .= "<td>";
																	$o .= $aVals['luss_date_added']. '</td>';

																	
																	$o .= "<td>".$aVals['luss_last_search']."</td>" ;
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
									 $('.dataTables').dataTable();
								 });
							</script>
                            
                            
                            