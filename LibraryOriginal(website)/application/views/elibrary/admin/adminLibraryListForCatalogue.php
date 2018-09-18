<?php
	$aLibrary		=	$this->ElibrarySystem->getLibraries();
	/*echo '<pre>';
	print_r($aLibrary);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if(count($aLibrary)){
		$sErrorMsg	=	'';
	}
?>
					 <div class="row"> 
						 <div class="col-lg-12">
						 <a href="<?php echo $this->config->item("base_url") ?>elibrary/admin/catalog/new/" type="button" class="btn btn-success">Create New Catalogue +</a>
						<?php echo '   <a href="'.elibraryAdminUrl('catalog/import').'" type="button" class="btn btn-primary">Import Record (s)</a>  ';?>

	 					</div>
					 </div><br/> 
                      
                        <div class="panel panel-primary">
                            <div class="panel-heading">Library Catalogue Management</div>
                         
                            <div class="panel-body">
                                 
                                           <form class="form-inline" role="form" action ="<?php echo  $this->config->item('base_url');?>elibrary/admin/catalog" method="get">
											  <div class="form-group col-lg-5">
											    <label class="sr-only" for="catalogue_item_query">Catalogue Query Info</label>
											    <input name="catalogue_item_query" type="text" class="form-control" id="catalogue_item_query" placeholder="Enter catalogue query info ">
											  </div>
											  <div class="form-group col-lg-5">
											    <label class="sr-only" for="cat_library_pick">Library</label>
											     <select id="cat_library_pick" name="cat_library_pick" class="chzn-select form-control"  />
														<option value=""> All Library </option>
													 	<?php  foreach($aLibrary as $aVal){
													 		echo "<option value='".$aVal['ll_id']."'>".$aVal['ll_title']."</option>" ;
													 		}

													 	?>
													</select>
											  </div>
											   
											  <input  name="pull_record" type="submit" class="btn btn-primary" value="Load Catalogue" />
											</form>

  

 
                                </div>
                        </div>


                            <div id ="catReciever"> <?php
                          //  print_r($this->input->post('cat_library_pick'));
                        /*    print_r($this->input->post());*/
                            if($this->input->get('pull_record') ){
                            	$aData['lib_id']  					= (int)$this->input->get('cat_library_pick');
                            	$aData['catalogue_item_query']  	= $this->input->get('catalogue_item_query');
                            	$this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
                            }
                            
                            ?>
                             </div>
                            
                            
                            
                            