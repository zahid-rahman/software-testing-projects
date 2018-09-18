<?php
	//$aInbox 	=	$this->MyLibrary->myInbox((int)$this->AppUser->getUserID());
	if(!count($aSent)){
		//echo 'na here';
		echo '<div class="alert alert-warning"> Empty record </div>';
		return ;
		//exit();
	}
?>


 <div class="panel panel-primary">
                            <div class="panel-heading">Sent messages </div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Reciever</th>
                                                            <th>Subject</th>
                                                            <!-- <th>Attachment</th> -->
                                                            <th>Date</th>
                                                            
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php

                                                    	//print_r($_REQUEST);
															$o = "" ;
														 	
															$iI=1;
															foreach($aSent as $aVals){
																if($this->AppUser->getUserId() == $aVals['lur_reciever_id']){
														 			$sChecker = $aVals['lur_sender_id'];
														 		}else{
														 			$sChecker = $aVals['lur_reciever_id'];
														 		}

 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>  ".(!empty($aVals['user']) ? $aVals['user']: $this->AppUser->getUserByUniqueId($sChecker))." </td>" ;
																	$o .= "<td><a href=\"".adminMessageLinkGenerator($aVals['lur_id'])."\" title=\"".$aVals['lur_msg_subject']."\" > ".$aVals['lur_msg_subject']." </a></td>" ;
																	
																	/*$o .= "<td>".$aVals['lur_msg_subject']."</td>" ;*/
																	$o .= "<td>".$aVals['lur_msg_date']."</td>" ;
																	 																	
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
                            

