<?php
	$aMyFiles		=	$this->MyLibrary->myPrivateFiles($this->AppUser->getUserId());

/*	echo '<pre>';
	print_r($aMyFiles);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	
	if(!count($aMyFiles)){
		$sErrorMsg	=	'';
	}
?>						<!-- Beginning of modal code for upload -->
					    <div id="full-width" class="modal container fade" tabindex="-1" style="display: none;">
					    <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h4 class="modal-title">Full Width</h4>
					    </div>
					    <div class="modal-body">
					    <p>This modal will resize itself to the same dimensions as the container class.</p>
					    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin ipsum ac ante fermentum suscipit. In ac augue non purus accumsan lobortis id sed nibh. Nunc egestas hendrerit ipsum, et porttitor augue volutpat non. Aliquam erat volutpat. Vestibulum scelerisque lobortis pulvinar. Aenean hendrerit risus neque, eget tincidunt leo. Vestibulum est tortor, commodo nec cursus nec, vestibulum vel nibh. Morbi elit magna, ornare placerat euismod semper, dignissim vel odio. Phasellus elementum quam eu ipsum euismod pretium.</p>
					    </div>
					    <div class="modal-footer">
					    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
					    <button type="button" class="btn btn-primary">Save changes</button>
					    </div>
					    </div>


						<!-- End of modal code for upload  -->


						<!-- Modal -->
				<div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileModal" aria-hidden="true">
				    <div class="modal-dialog">
				      <div class="modal-content " >
				      <form id="deleteFileModalForm" target="" method="post" name="deleteFileModalForm"  >
				  

				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				          <h4 class="modal-title">Delete File</h4>
				        </div>
					        <div class="modal-body" id="needed"> <span id="response"></span>
					         <div class="alert alert-info"> Are you sure you want to delete this file? </div>
					        

					          <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
				          <input type= "hidden" name="file_key" value="0" id="file_key" />
				          <input id="deleteFileModalFormSubmit" type="submit" class="btn btn-danger" value="Yes, Continue"  name= "deleter"/>
				        

					        </div>
				        <div class="modal-footer">
				         </div>

				         </form>
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /.modal -->





						<div class="row"> <div class="col-lg-4">  <a href="<?php echo current_url();?>/upload/" type="button" class="btn btn-success">Upload New File+</a></div> </div><br/> 
                        <div class="panel panel-primary">
                            <div class="panel-heading">Your Files</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables" id="dataTables-courses">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Name</th>
                                                            <th>Size</th>
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;

															$iI=1;
															foreach($aMyFiles as $aVals){
 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['luu_title']."</td>" ;
																	$o .= "<td>".elibrary_human_filesize($aVals['luu_size'])."</td>" ;
																	$o .= "<td>".$aVals['luu_date']."</td>" ;
																	$o .= "<td class='pull-right'>";


																		$o .= '<div class="btn-group">
																		  <button type="button" class="btn btn-primary">Action</button>
																		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		    <span class="caret"></span>
																		  </button>
																		  <ul class="dropdown-menu" role="menu">
																		    <li><a href="'.studentFileDownloadLink($aVals['luu_id']).'">Download File</a></li>
																		    <li><a href="#" onclick="return deleteFilePopUp( \''.$aVals['luu_id'].'\' ); return false;">Delete</a></li>
																		   </ul>
																		</div>

																	</td>';



																	
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
                           
                            
                            
                            