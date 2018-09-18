<?php
	//$aRecomended		=	$this->ElibrarySystem->getRecommededResource();

	/*echo '<pre>';
	print_r($aLibrary);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	 

	//$aUsers 	=	 array();
	$aUsers 	=	 $this->ElibrarySystem->getLibUsers();

/* echo '<pre>';
	print_r($aUsers);
	echo '</pre>';
*/

?>
<?php  
if(count($aUsers)){
 

?>
				 		<div class="row">
				 		<div class="col-lg-4">  <a href="<?php echo elibraryAdminUrl("users/create") ?>" type="button" class="btn btn-success">Create User</a>  <a href="<?php echo elibraryAdminUrl("users/export") ?>" type="button" class="btn btn-primary">Export to excel</a></div> </div><br/> 
<?php
}
?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">Library Users</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables"  >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Lib. ID No.</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Account Type</th>
                                                            <th>Account Status </th>
                                                      <!--       <th></th> -->
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$iI=1;
															 
															foreach($aUsers as $aVals){

																if($aVals['username'] == '' OR is_null($aVals['username'])){
                                                    			$aUser = $this->AppUser->getUserDetails($aVals['user_code']);
                                                    			$aVals['username'] = isset($aUser['username']) ? $aUser['username']  :'Unknown User' ;
                                                            }
                                                    		$aVals['username'] =  '<a href="'.userRootUrl('users/create/'.@$aVals['user_code']).'" > '.ucfirst($aVals['username']).'</a>' ;


                                                    		
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['user_code']."</td>" ;
																	$o .= "<td>".$aVals['username']."</td>" ;
																	$o .= "<td>".$aVals['lu_email']."</td>" ;
																	 $o .= "<td>".ucfirst(lu_acc_type_display($aVals['lu_acc_type']))."</td>" ;
																	$o .= "<td>".elibrary_account_status_display($aVals['lu_acc_status'])."</td>" ;
																	//$o .= "<td class='center'>";


																	//	$o .= '<button type="button" class="btn btn-primary">Manage</button></td>';
 
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
                            
                            
                            
                            




                            