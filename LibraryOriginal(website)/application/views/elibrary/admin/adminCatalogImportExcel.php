<?php
 $aMessage = array();

if($this->input->post('importation_upload_btn')  && isset($_FILES['userfile']['name'])  ){
	$aAllowedExtensions  = array('xlsx');
 	//echo 'beginuploading work here jhare<pre>';
 	//print_r($_FILES['userfile']);
 	//echo '</pre>';
 	$aFile 	=	$_FILES['userfile'];
 	$sLocationToSave = './'.$aFile['name'];
 	$ext = explode('.', basename($aFile['name']));
 	$ext 	=	$ext[1];
 	 
 	if(in_array($ext, $aAllowedExtensions )){


	 	if( move_uploaded_file($aFile['tmp_name'] , $sLocationToSave )){
	 		$aMessage[] = '<div class="alert alert-success">Your file has been uploaded to the server.</div>';

	 		//$inputFileName = './sampleData/example1.xls' ;
			$this->load->library('elibrary/elibrary_excel'); 
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objReader->setReadDataOnly(true);
			 

			$objPHPExcel = $objReader->load($sLocationToSave); 
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

			$aReturnData 	=	array();		 
			$aData = array();
			$iRows 	=	count($sheetData);
			/*var_dump($iRows);
			die();*/
			if($iRows  > 1){

				for ($i=2; $i <= $iRows ; $i++) { 
					# code...
					$aReturnData 	=	$this->ElibrarySystem->saveCatalogForExcel($sheetData[$i]);

				}

				$aMessage[] =	'';
				
			}else{
				$aMessage[] = '<div class="alert alert-danger">You uploaded an empty record file.</div>';
			}

	 	}else{
	 		$aMessage[] = '<div class="alert alert-danger">Error(s) occured while uploading your file.</div>';
	 	}
	}else{
		$aMessage[] = '<div class="alert alert-danger">Please you should upload a file that has either of the following extensions : <strong> .'.implode(', .', $aAllowedExtensions).'</strong></div>';
	}	
}


//explode(delimiter, string)
?>

<div class="panel panel-primary">
    <div class="panel-heading">Library Catalogue Item Importation Form </div>
    <div class="panel-body">  

    	<?php 
    	foreach($aMessage as $sMesageValue){
    		echo $sMesageValue;
    	}
    	?>

		 
		<?php echo form_open_multipart(elibraryAdminUrl('catalog/import'), array('name'=>'importForm','class'=>'form-horizontal form', 'role' => 'form', 'method'=>'post')); ?>  

		<input type="file" name="userfile" size="20" />

		<br /><br />

		<input class="btn btn-primary" name="importation_upload_btn" type="submit" value="Upload Record(s)" />

		</form>


    </div>
</div>



