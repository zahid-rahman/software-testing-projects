<?php
 
	if(!count($mPreparedContent['search_result'])){
		echo '<div class="alert alert-danger">Record does not exists.  </div>';
		return ;
		exit();
	}
	$bDetailed 	=	false;
 	$sPaginationLink = $this->pagination->create_links() ;
    //  ($this->pagination->create_links() != '') ? ( 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->pagination->total_rows) :'';
     
 
	$iCount = 1;

	$sContent =$this->load->view('elibrary/portal/add2shelfForm').
	  '
		<div class="row"> <div class="col-lg-12"> '.$sPaginationLink.'  </div> </div> <hr/>'; 

 

	foreach($mPreparedContent['search_result']  as $aVals){
		$disabled 	= 		'<button type="button" class="btn btn-default" disabled >Download</button>  ';
		$sLink		=		'';
		if($aVals['lci_downloadable'] > 0){
			$disabled = '<a href="'.elibraryGeneratePortalCatalogueDownloadLink($aVals['lci_id']).'" type="button" class="btn btn-success"  >Download</a>';
			$sLink	  =	 $aVals['lci_download_link'];
		}

		$aAuthors 	=	elibrarycatalogueSearchAuthorsDisplay($this->ElibrarySystem->getCatalogLinkedAuthors($aVals['lci_id']));
		

		/*echo '<pre>';
		print_r($this->ElibrarySystem->getCatalogLinkedAuthors($aVals['lci_id']));
		echo '</pre>';*/

		$sContent .=  '
		<div class="row">
			<span class="col-lg-2">'.$iCount.'. </span>
			<!-- <span class="col-lg-1"> <input name="cat_id_selector[]" type="checkbox" class="" value="'.$aVals['lci_id'].'" />  </span> -->
			<span class="col-lg-7">
			<a href="'. generateElibraryCatalogueLink($aVals['lci_id']).'" class=""><strong> '.$aVals['lci_title'].' </strong> </a> <br/>

				<div class="row">
			<div class="col-lg-12">
						<div class="table-responsive">
						  <table class="table table-striped  table-hover  table-condensed">
						   <tr > <th> <small>Author(s)  </small></th> <td> '.$aAuthors.'  </td>  </tr>
						   <tr > <th> <small> Published </small></th>  <td> '.$aVals['lci_year_published'].'  </td>   </tr>
						   <tr > <th> <small> Publisher </small></th>  <td> '.$aVals['lci_publisher'].'  </td>   </tr>
						   <tr > <th><small> Accession No. </small></th>  <td> '.$aVals['lci_accession'].'  </td>   </tr>
						   <tr > <th><small> Call Number </small></th>  <td> '.$aVals['lci_callnumber'].'  </td>   </tr>
						   <tr > <th><small> Library</small></th>  <td> '.$aVals['ll_title'].'  </td>   </tr>
						   <tr > <th><small> Manage</small></th>  <td> 


						   <div class="btn-group">
							  <a href="'. generateElibraryCatalogueLink($aVals['lci_id']).'" type="button" class="btn btn-info">View Details</a>
							 
							  '.$disabled.'
							  <button type="button" class="btn btn-warning" onclick="return __elibraryModalReservationForm(\''.quotes_to_entities($aVals['ll_title']).'\',\''.$aVals['lci_id'].'\',\''.$aVals['lci_title'].'\');">Reserve</button>
							  <button type="button" class="btn btn-primary" onclick = "__elibraryModalAddToShelveForm(\''.$aVals['lci_id'].'\',\''.$aVals['lci_title'].'\');  return false;" >Add to Shelf</button>
							</div>





						     </td>   </tr>
						  </table>
						</div>
			</div>
			</div>



			 </span>
			<span class="col-lg-3"><img src ="'.generatePortalEndCatalogueImageLink($aVals['lci_snapshot']).'" class="img-responsive img  img-rounded" alt=" '.$aVals['lci_title'].'"/> </span>
		</div><hr/>';
		$iCount++;
	}
	$sContent .=  '
		<div class="row"> <div class="col-lg-12"> '.$sPaginationLink.'  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p></div> </div>'; 


		$sContent  .=$this->load->view('elibrary/portal/reservationModalForm');
	echo $sContent;
 