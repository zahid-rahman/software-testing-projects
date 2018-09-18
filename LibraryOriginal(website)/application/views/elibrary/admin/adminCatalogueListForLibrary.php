<?php
	$aCatalogue		=	$this->ElibrarySystem->getCataloguesInLibrary($catalogue_item_query, (int)$lib_id);
	/*echo '<pre>';
	print_r($lib_id);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if($aCatalogue != false){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>					
				
		<div class="modal fade" id="deleteCataloguesModal" tabindex="-1" role="dialog" aria-labelledby="deleteCataloguesModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteCataloguesModalFormID" target=" " method="post" name="deleteCataloguesModalFormID"  >
              <?php /*echo form_open(current_url(), array('id'=>'deleteCataloguesModalFormID','name'=>'deleteCataloguesModalFormID','class'=>'form-horizontal', 'role' => 'form', 'method'=>'post'));*/ ?>  

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Record</h4>
                </div>
                  <div class="modal-body" id="needed"><span id="deleteResponse"> 
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div> </span>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="catalogueDeleteHiddenID" value="0" id="catalogueDeleteHiddenID" />
                  <input id="deleteCatalogueModalIDSubmit" type="submit" class="btn btn-danger" value="Yes, delete record."  name= "deleteCatalogueModalIDSubmit"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <?php  if(count($aCatalogue)){
            //  print_r($_SERVER['QUERY_STRING']);

            echo '<div class="row"> <div class="col-lg-4">    <a href="'.elibraryAdminUrl('catalog/export/').'?template=false&amp;'.$_SERVER['QUERY_STRING'].'" target="_blank" type="button" class="btn btn-warning">Download Search Result (Excel)</a> </div> </div><br/> 
                      ';

            } ?>
	                  <div class="panel panel-primary">
                            <div class="panel-heading">Library Catalogue   Result 
                            </div>
                            <div class="panel-body">

                           
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Library</th>
                                                            <th>Call Number</th>
                                                            <!-- <th>Acquired </th>
                                                            <th>Remaining </th> -->
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$iI=1;
															foreach($aCatalogue as $aVals){
 																	$o .= "<tr>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td><a href=\"".elibraryAdminCatalogPage($aVals['lci_id'])."\" class=\"catalogueListDetailsClass\"  >".$aVals['lci_title']."</a></td>" ;
																	$o .= "<td>".$aVals['ll_title']."</td>" ;
																	$o .= "<td>".$aVals['lci_callnumber']."</td>" ;
																	/*$o .= "<td>".$aVals['lci_qty_acquired']."</td>" ;
																	$o .= "<td>".$aVals['lci_qty_remaining']."</td>" ;*/
																	$o .= "<td>".$aVals['lci_date_added']."</td>" ;
															/*		$o .= "<td class='center'>";


																		$o .= '<button type="button" class="btn btn-danger" onclick = "elibraryAdminDeleteCatalogueLauncher(\''.$aVals['lci_id'].'\'); return false;" >Delete ?</button>

																	</td>';*/

                                  $o .= "<td class='center'>";


                                    $o .= '<div class="btn-group">
                                      <button type="button" class="btn btn-primary btn-xs">Action</button>
                                      <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="'.elibrary_catalogue_print_page($aVals['lci_id'],1).'" target ="_blanck">Author Card </a></li>
                                        <li><a href="'.elibrary_catalogue_print_page($aVals['lci_id'],2).'" target ="_blanck">Subject Card </a></li>
                                        <li><a href="'.elibrary_catalogue_print_page($aVals['lci_id'],3).'" target ="_blanck">Title Card </a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" class="" onclick = "elibraryAdminDeleteCatalogueLauncher(\''.$aVals['lci_id'].'\'); return false;">Delete</a></li>
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
                         
                            
                            
                            




                            