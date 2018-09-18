<?php
	$aLibrary		=	$this->ElibrarySystem->getAllExternalLibrariesRecord();


	/*echo '<pre>';
	print_r($aLibrary);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if(!count($aLibrary)){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>	
<div class="modal fade" id="deleteLibrarysModal" tabindex="-1" role="dialog" aria-labelledby="deleteLibrarysModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteExternalLibraryModalFormID"   method="post" name="deleteExternalLibraryModalFormID"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Record</h4>
                </div>
                  <div class="modal-body" id="needed"><span id="deleteResponse"> 
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div> </span>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="libraryDeleteHiddenID" value="0" id="libraryDeleteHiddenID" />
                  <input id="deleteLibraryModalIDSubmit" type="submit" class="btn btn-danger" value="Yes, delete record."  name= "deleteLibraryModalIDSubmit"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->


	<div class="row"> <div class="col-lg-4">  <a href="<?php echo elibraryAdminUrl("external_library/new") ?>" type="button" class="btn btn-success">Create New External Library +</a></div> </div><br/> 
                                 
                        <div class="panel panel-primary">
                            <div class="panel-heading">External Library Record List</div>
                            <div class="panel-body">
                                           <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Library Title</th>
                                                           <!--  <th>Library Query Address</th> -->
                                                            <th>Enabled</th>
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$row_total = 12;
															$iI=1;
															foreach($aLibrary as $aVals){
 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= '<td><a href="'.$aVals['lel_homepage'].'" target="_blanck">'.$aVals['lel_title'].'</a></td>'; 
																	/*$o .= "<td><a href= \"".$aVals['lel_searc_page']."\" target=\"_blanck\"> ".myTruncate($aVals['lel_searc_page'],10,'.')."</a></td>" ;*/
																	$o .= "<td>".active_status($aVals['lel_enabled'])."</td>" ;
																	$o .= "<td>".$aVals['lel_date_added']."</td>" ;
																	$o .= "<td class='center'>";


																		$o .= '<div class="btn-group">
																		  <button type="button" class="btn btn-primary">Action</button>
																		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		    <span class="caret"></span>
																		  </button>
																		  <ul class="dropdown-menu" role="menu">
																		    <li><a href="'.elibraryAdminUrl('external_library/new/'.$aVals['lel_id']).'">View / Edit </a></li>
																		    
																		    <li class="divider"></li>
																		    <li><a href="#" class="" onclick = "elibraryAdminDeleteLibraryLauncher(\''.$aVals['lel_id'].'\'); return false;">Delete</a></li>
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
                          
                            




                            