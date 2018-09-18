	<div class="panel panel-primary">
	   <div class="panel-heading">Query Form </div>
	   <div class="panel-body">
	   <div class="alert alert-info" > Please enter the resource query info to proceed with this request.</div>

	   		<!-- <form  action= "<?php echo elibraryAdminUrl('borrowed/new/'); ?>" class="form-inline" role="form" method="get" name="borrower_picker"> -->
			  
	 <?php echo form_open(elibraryAdminUrl('borrowed/new/'), array('name'=>'borrower_picker','class'=>'form-inline', 'role' => 'form', 'method'=>'get')); ?>  

			  

 

			  
			   <div class="input-group">
				<input value = "<?php echo  $this->input->get_post('c_id');?>" required name="c_id" type="text" class="form-control" id="c_id" placeholder="Item search parameter  e.g call no, title  etc ">
				<span class="input-group-btn">
				    <button type="submit" class="btn btn-primary"  >Fetch Record!</button>
				      </span>
				</div><!-- /input-group -->
				    
			   



			   



 
			   </form>
			  </div>
		 



	   </div>





	   <?php
		   if($this->input->get_post('c_id')){
		   		// pull th e student record of item not retured to the school.

		   	/*
		   	Algoruthm:
		   	Check if the user has exceeded his/ her maximum limit, abort transaction else proceed.
		   	check to see if the item is available for collection then show it else notify that it can't be collected
		
		   	*/
		   	// check if
		   	$content = '<hr/>';
		   

		   		/*if(){

		   		}*/


		   		
		   


		   		$aResultlistBorrowableCatalogue = $this->ElibrarySystem->listBorrowableCatalogue($this->input->get_post('c_id',true));
		    	//print_r($aResultlistBorrowableCatalogue);
		    	if(!count($aResultlistBorrowableCatalogue)){
		    	echo '<div class="panel panel-info">
						  <div class="panel-heading">No record found</div>
						  <div class="panel-body">
						    <div class="alert alert-info"> Your search for  <span class="alert alert-link" >" '.$this->input->get_post('c_id').' "</span>  did not return any result.</div>
						  	
						  </div>
						</div>';
						return;
					}




					$iStudentID 		= 		$this->input->get_post('b_id');

			// get the user details if exists proceed or th bring out an error to show that the user does not exists.
		   		/*$aStudentDetails = $this->AppUser->getUserDetials($iStudentID);
		   		if(!count($aStudentDetails)){
		    	echo '<div class="panel panel-info">
						  <div class="panel-heading">User does not exists</div>
						  <div class="panel-body">
						    <div class="alert alert-info"> The user   <span class="alert alert-link" >" '.$this->input->get_post('b_id').' "</span>  does not exists in our records.</div>
						  	
						  </div>
						</div>';
						return;
					}*/

					

				$aResult 			=		$this->ElibrarySystem->getStudentUnreturnedtems(array('iStudentID'=>$iStudentID));
		   	/*print_r($aResult);*/
		   		$iCurrentlyCollected 			=   count($aResult);
		   		$iMaximumAllowableCOllection 	=	3;

		   		if($iCurrentlyCollected > ($iMaximumAllowableCOllection-1)){
		   			//  you need to return the collecte items first before we can think of getting another one
		   				echo '<div class="panel panel-danger">
						  <div class="panel-heading">Detected</div>
						  <div class="panel-body">
						    <div class="alert alert-danger"> This user already has the maximum borrowable item that has not been returned associated to his/ her account</div>
						  	<div class="alert alert-info"> Please click <a href="'.elibraryAdminUrl("returned/new/?".$iStudentID).'" class="alert alert-link">HERE </a> to view the collected item record list </div>
						  </div>
						</div>';
						return;
		   		}




		   	?>


		   	


			<div class="panel panel-success">
			  <div class="panel-heading">Query Result</div>
			  <div class="panel-body">
		   		<div class="table-responsive" id="wrapNotification">
		   		<span id="ajax_response1"> </span>

		   		<div class="form-group col-lg-12">
			    <label class="sr-only" for="b_id">Borrower</label>
			    <input value= "<?php echo  $this->input->get_post('b_id'); ?>" required name="b_id" type="text" class="form-control " id="b_id" placeholder="User's (Student / staff) Unique Library Identification code  or Email">
			  </div>

                                                <table class="table table-striped  table-hover dataTables" id="dataTables-catalogueList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Library</th>
                                                            <th> Accession No.</th>
                                                            <th>Call No.</th>
                                                            <th>Date Charged</th>
                                                            <th>Date Due</th>
                                                            <th>Save</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															 
															$iI=1;
															foreach($aResultlistBorrowableCatalogue as $aVals){
 																$o .= "<tr class=' '>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= "<td>".myTruncate($aVals['lci_title'],20,' ')."</td>" ;
																	$o .= "<td>".$aVals['ll_title']."</td>" ;
																	$o .= "<td>".$aVals['lci_accession']."</td>" ;
																	$o .= "<td>".$aVals['lci_callnumber']."</td>" ;
																	$o .= '<td><input type="text" id="book_date_picked_'.$aVals['lci_id'].'" name="book_date_picked_'.$aVals['lci_id'].'" class="form-control datepicker" /></td>' ;
																	$o .= '<td><input type="text" id="book_date_return_'.$aVals['lci_id'].'" name="book_date_picked_'.$aVals['lci_id'].'" class="form-control datepicker" /></td>' ;
																	$o .= "<td class='center'>";


																		$o .= '<button type="button" class="btn btn-info" onclick ="processAdminBookCollection(\''.$aVals['lci_id'].'\'); return false;">Save</button>

																	</td>';



																	
																$o .= "</tr>" ;
																
															 
																$iI++;
															}
															echo $o;


															
														?>
                                                    </tbody>
                                                </table>
                                            </div></div></div>

                                           
                                            <?php
                                        }
	   ?>
 