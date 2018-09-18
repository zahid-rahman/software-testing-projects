<?php
	$aRecomended		=	$this->ElibrarySystem->getMyRecommendedResources();

	/*echo '<pre>';
	print_r($aRecomended);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if($aRecomended != false){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>
					<div class="row"> 
						<div class="col-lg-12">
							<?php echo '   <a href="'.(  strtolower($this->AppUser->getUserType()) == 'student' ? elibraryPortalUrl('recommend/now/')  :  elibraryAdminUrl('recommend/now/') ).'" type="button" class="btn btn-info">Recommend a resource+</a>  ';?>
						</div>

					</div>
					<br/>

                        <div class="panel panel-primary">
                            <div class="panel-heading">Recommended Resources</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-recommendationList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Resource Title</th>
                                                            
                                                            <th>Date Sent</th>
                                                            <th>Status</th>
                                                          
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$iI=1;
															foreach($aRecomended as $aVals){

																 
																
                                                    		
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	 
																 	$o .= '<td><a href="'.(  strtolower($this->AppUser->getUserType()) == 'student' ? elibraryPortalUrl('recommend/now/'.$aVals['lrr_id'])  :  elibraryAdminUrl('recommend/now/'.$aVals['lrr_id']) ).'">'.$aVals['lrr_title'].'</a></td>' ;
																	
																	$o .= "<td>".$aVals['lrr_date']."</td>" ;
																	$o .= "<td>".transalate_recommendation_status($aVals['lrr_status'])."</td>" ;
																	 


																	
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
                            
                            
                            
                            




                            