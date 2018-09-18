<?php
/*echo '<pre>';
print_r($mPreparedContent['search_result']);
echo '</pre>';
//die();*/
$bDetailed 	=	true;

$aVals = $mPreparedContent['search_result'];

$disabled 	= 		'<button type="button" class="btn btn-default" disabled >Download</button>  ';
		$sLink		=		'';
		if($aVals['lci_downloadable'] > 0){
			$disabled = '<a href="'.elibraryGeneratePortalCatalogueDownloadLink($aVals['lci_id']).'" type="button" class="btn btn-success"  >Download</a>';
			$sLink	  =	 $aVals['lci_download_link'];;
		}


$aSubject 	=	elibrarycatalogueSearchSubjectDisplay($this->ElibrarySystem->getCatalogLinkedSubjects($aVals['lci_id']));

		$aAuthors 	=	elibrarycatalogueSearchAuthorsDisplay($this->ElibrarySystem->getCatalogLinkedAuthors($aVals['lci_id']));

	$sContent = $this->load->view('elibrary/portal/reservationModalForm'). '
	<div class="panel panel-primary">
                            <div class="panel-heading">Catalogue Item Details </div>
                            <div class="panel-body">



		<div class="row">
			<div class="col-lg-12"> <h3> '.$aVals['lci_title'].' </h3> </div>
			 
		</div>	
		<div class="row">
			 
			 
			<span class="col-lg-8">
			 

				<div class="row">
			<div class="col-lg-12">
						<div class="table-responsive">
						  <table class="table table-striped  table-hover  table-condensed">
						   <tr > <th> <small>Author  </small></th> <td> '.ucfirst($aAuthors).'  </td>  </tr>
						   <tr > <th> <small> Published </small></th>  <td> '.$aVals['lci_year_published'].'  </td>   </tr>
						   <tr > <th> <small> Publisher </small></th>  <td> '.$aVals['lci_publisher'].'  </td>   </tr>
						   <tr > <th><small> ISBN </small></th>  <td> '.$aVals['lci_isbn'].'  </td>   </tr>
						   <tr > <th><small> Accession Number </small></th>  <td> '.$aVals['lci_accession'].'  </td>   </tr>
						   <tr > <th><small> Call Number </small></th>  <td> '.$aVals['lci_callnumber'].'  </td>   </tr>
						   <tr > <th><small> Library</small></th>  <td> '.$aVals['ll_title'].'  </td>   </tr>
						   <tr > <th><small> Subject</small></th>  <td> '.$aSubject .'  </td>   </tr>
						   <tr > <th><small> Format</small></th>  <td> '.$aVals['lcf_title'].'  </td>   </tr>
						   <tr > <th><small> Category</small></th>  <td> '.$aVals['lcc_title'].'  </td>   </tr>
						   <tr > <th><small> Description</small></th>  <td> '.$aVals['lci_description'].'  </td>   </tr>
						    
						   <tr > <th><small> Manage</small></th>  <td> 

						   <div class="btn-group">
							   
							 
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
		</div><hr/>


		</div> </div>
		';

		echo  $sContent.$this->load->view('elibrary/portal/add2shelfForm');
		?>