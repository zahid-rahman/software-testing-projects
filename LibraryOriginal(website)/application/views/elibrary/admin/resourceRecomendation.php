<?php
	$aRecomended		=	$this->ElibrarySystem->getRecommededResource();

/*	echo '<pre>';
	print_r($aRecomended);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if($aRecomended != false){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>

                        <div class="panel panel-primary">
                            <div class="panel-heading">Recommended Resources</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-recommendationList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Resource Title</th>
                                                            <th>By</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                             
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$iI=1;
															foreach($aRecomended as $aVals){

																if($aVals['username'] == '' OR is_null($aVals['username'])){
                                                    			$aUser = $this->AppUser->getUserDetails($aVals['lrr_recomended_by']);
                                                    			$aVals['username'] = isset($aUser['username']) ? $aUser['username']  :'Unknown User' ;
                                                            }
                                                    		$aVals['username'] =  '<a href="#" onclick= "elibrary_admin_pull_user_details(\''.$aVals['lrr_recomended_by'].'\'); return false;"> '.ucfirst($aVals['username']).'</a>' ;


                                                    		
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= '<td><a href="'.elibraryAdminUrl('recommendation/'.$aVals['lrr_id']).'">'.$aVals['lrr_title'].'</a></td>' ;
																	$o .= "<td>".$aVals['username']."</td>" ;
																	$o .= "<td>".$aVals['lrr_date']."</td>" ;
																	$o .= "<td>".transalate_recommendation_status_admin($aVals['lrr_status'])."</td>" ;
																 



																	
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
                            
                            
                            
                            




                            