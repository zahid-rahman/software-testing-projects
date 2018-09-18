 
<?php   
	/*if(!count($mPreparedContent['result'])){
		echo '<div class="alert alert-danger">Record does not exists.  </div>';
		return ;
	}*/	
/*echo '<pre>';
	print_r($mPreparedContent['result']);
	echo '</pre>';*/
	$this->load->view('elibrary/portal/add2shelfForm');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
?>						  
	<!-- Modal -->
				<div class="modal fade" id="deleteShelveItem" tabindex="-1" role="dialog" aria-labelledby="deleteShelveItemModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				      <div class="modal-content " >
				      <form id="deleteShelveItemModalID" target="" method="post" name="deleteShelveItemModalID"  >
				  

				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				          <h4 class="modal-title">Delete Item</h4>
				        </div>
					        <div class="modal-body" id="needed">
					         <div class="alert alert-info"> Are you sure you want to delete this record? </div>
					        <span id="deleteResponse"></span>

					          <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
				          <input type= "hidden" name="iFileId" value="0" id="iFileId" />
				          <input type= "hidden" name="iFolder" value="0" id="iFolder" />
				          <input id="deleteShelveItemModalIDSubmit" type="submit" class="btn btn-danger" value="Yes, delete record"  name= "sav"/>
				        

					        </div>
				        <div class="modal-footer">
				         </div>

				         </form>
				      </div><!-- /.modal-content -->
				    </div><!-- /.modal-dialog -->
				  </div><!-- /.modal -->


	                  <div class="panel panel-primary">
                            <div class="panel-heading">My Favourite Item List :: <?php echo $mPreparedContent['title']; ?></div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Item / Doc</th>
                                                            <th>Date Added</th>                                            
                                                             
                                                            <th> Manage</th>
                                                             
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
														 
															$iI=1;
															foreach($mPreparedContent['result'] as $aVals){
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td><a href=\"".generateElibraryCatalogueLink($aVals['lci_id'])."\" title=\"".$aVals['lci_title']."\" > ".$aVals['lci_title']." </a></td>" ;
																	$o .= "<td>".$aVals['lufli_date_added']."</td>" ;
																	 
																	 
																	$o .= '<td>



																	<!-- Split button -->
																		<div class="btn-group">
																		  <button type="button" class="btn btn-primary">Action</button>
																		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		    <span class="caret"></span>
																		  </button>
																		  <ul class="dropdown-menu" role="menu">
																		    <li><a href="'.generateElibraryCatalogueLink($aVals['lci_id']).'">View</a></li>
																		   <!--  <li><a href="#" onclick = "moveShelfItemDialog('.$aVals['lci_id'].','.$aVals['lufli_id'].','.$this->db->escape($aVals['lci_title']).'); return false;">Move </a></li> -->
																		     
																		    <li class="divider"></li>
																		    <li><a href="#" onclick = "confirmDeleteShielveResourceItem('.$aVals['lci_id'].'); return false;">Delete</a></li>
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
                            <script src="<?php echo $sRootDirLink ; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
                            <script>
								 $(document).ready(function () {
									 $('.dataTables').dataTable();
								 });
							</script>
                            
                            
                            




                            