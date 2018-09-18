	<div id="allWrapper">
	 <div class="panel panel-primary">
	   <div class="panel-heading">Return Borrowed library Item </div>
	   <div class="panel-body">
	   <div class="alert alert-info" > Please enter the student unique identification code to Check eligibility status.</div>

	   		<form class="form-horizontal" role="form" method="get" name="borrower_picker">
			  <div class="form-group">
			    <label for="b_id" class="col-lg-2 control-label">User's ID</label>
			    <div class="col-lg-8">
			      

			        <div class="input-group">
				      <input value = "<?php echo  $this->input->get('r_id');?>" required name="r_id" type="text" class="form-control" id="r_id" placeholder="User's Unique identification code">
				      <span class="input-group-btn">
				        <button type="submit" class="btn btn-primary"  >Fetch Profile!</button>
				      </span>
				    </div><!-- /input-group -->


			    </div>
			  </div>
			   
			   </form>
			  </div> 
	   </div>


	   <?php
		   if($this->input->get_post('r_id')){
		   		// pull th e student record of item not retured to the school.

		   	$content = '<hr/>';
		   	$aResult 			=		$this->ElibrarySystem->getStudentUnreturnedtems(array('iStudentID'=>$this->input->get_post('r_id')));
		   	//print_r($aResult);
		   		if(!count($aResult)){
		    	echo '<div class="panel panel-info">
						  <div class="panel-heading">No record found</div>
						  <div class="panel-body">
						    <div class="alert alert-info"> This account does not have any unreturned item .</div>
						  	
						  </div>
						</div></div>';
						return;
					}
		   
		   	$offenses = $this->ElibrarySystem->getViolations();//array();
		    

		   	$o ='<div class="panel panel-info">
						  <div class="panel-heading">Record(s) found</div>
						  <div class="panel-body">
						  	<div class="table-responsive">
		   		<div id="returnResponse"> </div>
                                                <table class="table table-striped  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tran. Code</th>
                                                            <th>Call No.</th>
                                                            <th>Date Collected</th>
                                                            <th>Date Due</th>
                                                            <th>Return Date</th>
                                                            <th>Violation</th>
                                                            <th> Save</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	
															';
																										 
															$iI=1;
															foreach($aResult as $aVals){
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".$aVals['lbci_id']."</td>" ;
																	$o .= "<td>".$aVals['lci_callnumber']."</td>" ;
																	$o .= "<td>".$aVals['lbci_date_collected']."</td>" ;
																	$o .= "<td>".$aVals['lbci_date_to_be_returned']."</td>" ;
																	$o .= '<td>	

																		 
													                         <input  id="return_form_date_returned'.$iI.'" name="return_form_date_returned'.$iI.'"  class="form-control datepicker" type="date"     />
													                    

																	</td>' ;
																	$o .= "<td>";

																	$o .= '<input type="hidden" id="cat_id'.$iI.'" name="cat_id'.$iI.'"  value="'.$aVals['lbci_catalog_item_id'].'" /><select name="return_offenses'.$iI.'" id="return_offenses'.$iI.'" class="form-control  input-sm chzn-select">
      
       
																        '. elibrary_form_select_element($offenses,"","loft_id","loft_title","--SELECT VIOLATION--").' </select></td>' ;
																	$o .= '<td class="center"> <button type="button" class="btn btn-warning" onclick="saveReturnCatalogueItem(\''.$aVals['lbci_id'].'\',\''.$iI.'\'); return false;"> Save </button></td>'; 
																	$o .= "</tr>" ;
																
																 
																$iI++;
															}
															 


															
													$o .= '
                                                    </tbody>
                                                </table>
                                            </div>

                                            </div></div>
						</div>';

 


		   	echo $o;
		   }

	   ?>
 </div>