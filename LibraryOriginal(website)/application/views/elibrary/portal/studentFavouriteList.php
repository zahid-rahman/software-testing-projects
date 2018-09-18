<?php
	//$aViolation		=	$this->MyLibrary->studentViolations((int)$this->AppUser->getUserId());
	$aFavList       =   $this->MyLibrary->studentFavouriteFolderAndItemCount($this->AppUser->getUserId());
	/*echo '<pre>';
	print_r($aReservation); $aContent['aRecordList']			=	$this->MyLibrary->studentBorrowedResources($aForBorrowed);
	echo '</pre>';*/
	 
?>
 						  
	<div class="row"> <div class="col-lg-4">  <a  data-toggle="modal" href="#shelf_creation_modal" type="button" class="btn btn-success">Create New Shelf +</a></div> </div><br/> 
	                  <div class="panel panel-primary">
                            <div class="panel-heading">My Shelves</div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Shelves</th>
                                                            <th>Date Created</th>
                                                            <th>No. Items</th>
                                                             
                                                            
                                                             
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
														 
															$iI=1;
															foreach($aFavList as $aVals){
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td><a href=\"".elibraryPortalUrl('favourite/'.$aVals['lufl_id'])."\" title=\"".$aVals['lufl_title']."\" > ".$aVals['lufl_title']." </a></td>" ;
																	$o .= "<td>".$aVals['lufl_date_added']."</td>" ;
																	$o .= "<td>".$aVals['rec_count']."</td>" ;
																	 
																 
																	 



																	
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

                             <div class="modal fade" id="shelf_creation_modal" tabindex="-1" role="dialog" aria-labelledby="shelf_creation_modal_ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Shelf Form</h4>
        </div>
        <div class="modal-body">
          <form  id="shelfFormID" name="shelfForm" class="form-horizontal" role="form" action="" method="post"  >
  <div class="form-group">
    <label for="shelfTitle" class="col-lg-2 control-label requiured"> Title</label>
    <div class="col-lg-10">
      <input name="shelfTitle"  required="required" type="text" class="form-control col-lg-12" id="shelfTitle" placeholder="Shelf title">
    </div>
  </div>
  
  <input name="shelfKey"  required="required" type="hidden"   id="shelfKey" value="0">
    
  
  
  
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-info">Save Record</button>
    </div>
    
    
  </div>
  <div id="sectionAjaxResponse">  </div>
  
</form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

                            <script src="<?php echo $sRootDirLink ; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
                            <script>
								 $(document).ready(function () {
									 $('.dataTables').dataTable();
								 });
							</script>
                            
                            
                            




                            