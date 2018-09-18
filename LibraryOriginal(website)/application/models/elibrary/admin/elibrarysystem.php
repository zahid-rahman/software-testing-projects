<?php
//require_once(realpath('../elibrarymodel.php'));
//echo urldecode('https://ibanking.stanbicibtcbank.com/corp/BANKAWAYTRAN;jsessionid=0001VBkDyVH9sjBem4MCwgoqIn7:15reeablg?bwayparam=U6yGO8BJ898oX7GgQ7gM75R%2BSLk%2BWW25M7CufawdTIl%2BnXz3INlUqRE4uxDNn7AS2qFNTws%3D');
//echo base64_decode('U6yGO8BJ898oX7GgQ7gM75R+SLk+WW25M7CufawdTIl+nXz3INlUqRE4uxDNn7AS2qFNTws=');
class ElibrarySystem extends CI_Model{
	public function __construct(){
		parent::__construct();
		//$this->preparePagination();
		 
	}






	public function catalogExcelExport($sIsFormat = 'false', $catalogue_item_query='',$lib_id=0){
		ob_start();
		$this->load->library('elibrary/elibrary_excel');
		//$aSubjects 	=	 array();
		$aLibrary 	=	 array();
		$aCategory 	=	 array();
		$aFormat 	=	 array();
		$excel 		=  	 new Elibrary_excel();
		$aHeaings	=	elibraryExcelCellsPositioning();
		$iCatalog 	=	0;

		$aSubjectss      =   elibraryArrayStripper($this->ElibrarySystem->loadSubjects(),'lcis_title');
		$aLibrariess     =   elibraryArrayStripper($this->ElibrarySystem->getLibraries(),'ll_title');
		$aCategoriess    =   elibraryArrayStripper($this->ElibrarySystem->getCategories(),'lcc_title');
		$aFormatss       =   elibraryArrayStripper($this->ElibrarySystem->getCatalogueFormats(),'lcf_title');


		/*var_dump($bIsFormat);
		die();*/
		
		$sPortType	=	'Template';
		//$excel->createSheet();

		/*print_r($this->getSingleValue('library_catalog_item_source','lcis_title','lcis_id', 2));
		die();*/
		$aData  	=	array(/*'Julius','Oluwashina'*/);
		$excel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
		foreach($aHeaings as $key=> $value){
			$counter  = 1; 
			$i =1; 

			$sCell 	=	getElibraryExcellCellPosition($aHeaings, $key,$i,1);
			$excel->getActiveSheet()->setCellValue($sCell, getElibraryExcellCellPosition($aHeaings, $key,$i,0));
 			

 			$sCell  	=	 str_replace($i, '', $sCell );

 		//	die($sCell);
 			switch($key){
				case 'lci_library_id' 	: { setInputValidation($excel, $sCell,$aLibrariess);  break;}		 			 
				case 'lci_category'   	: { setInputValidation($excel, $sCell,$aCategoriess); break;}
				case 'lci_source' 	  	: { setInputValidation($excel, $sCell,$aSubjectss);  break;}
				case 'lci_format' 	  	: { setInputValidation($excel, $sCell,$aFormatss); break;}
							 
				//default : $mProcessedValue = $mValue;
			}

 			//setInputValidation($excel, $sCell,$aData);

 		}

 		 
		if($sIsFormat  == 'false'){

		 

		 $sPortType	=	'Export';
			$aCatalogue		=	$this->getCataloguesInLibrary($catalogue_item_query, (int)$lib_id);
			 $total 	=	count($aCatalogue);
			if($total){
 
				foreach($aCatalogue	 as $iKey => $aValues){
					 $iCatalog 	=	 $aValues['lci_id'];
					 
					$counter++; 
					foreach ($aValues as $sKey => $mValue) { 

						/*	echo '<pre>';
					print_r($aValues);
					die();*/
						$iLibraryId 	=	0;
						$sPostion = getElibraryExcellCellPosition($aHeaings, $sKey,$counter,1);
						if($sPostion==''){
							continue;
						}

						switch($sKey){
							case 'lci_library_id' : { $mValue = $this->getSingleValue('	library_libraries','ll_title','ll_id', $mValue);  break;}
							case 'lci_subject_id' : { $mValue = makeSubjectNameOk($this->getCatalogLinkedSubjects($iCatalog));    break;}
							//case 'lci_is__active' : { $mValue = $this->getSingleValue('library_catalog_item_source','lcis_title','lcis_id', $mValue);  break;}
							case 'lci_category'   : { $mValue = $this->getSingleValue('library_catalogue_categories','lcc_title','lcc_id', $mValue);  break;}
							//case 'lci_downloadable' : { $mValue = $this->getSingleValue('library_catalog_item_source','lcis_title','lcis_id', $mValue);  break;}
							case 'lci_source' 	  : { $mValue = $this->getSingleValue('library_catalog_item_source','lcis_title','lcis_id', $mValue);  break;}
							case 'lci_format' 	  : { $mValue = $this->getSingleValue('library_catalogue_format','lcf_title','lcf_id', $mValue);    break;}
							case 'lci_author' 	  : { $mValue = makeAuthorNameOk($this->getCatalogLinkedAuthors($iCatalog));   break;}
							default : $mProcessedValue = $mValue;
						}

						$excel->getActiveSheet()->setCellValue($sPostion, $mValue);
						$excel->getActiveSheet()->getProtection()->setSheet(true);

					}

					
				}

			}

		}else{


		} 


		
    	$excel->getActiveSheet()->setTitle($excel->cleanExcelTitle($sPortType));

		$excel->setFileTitle('just')/*;//*/->dispatch();

	}

	function getSingleLibraryTitle($mKey = '',$mValue = ''){
		return $mKey.'-'.$mValue;
	}

	function getSingleValue($sTable = '', $sColumn = '', $mWatcher = '',$mValue = ''){
		if($sTable == '' || $sColumn == '' || $mWatcher == '' || $mValue == '' ){
			return '';
		}

		//print_r($mValue);
		$sSql	=	"SELECT  ".$sColumn." FROM  ".$sTable." WHERE ".$mWatcher." = ".$this->db->escape($mValue)." LIMIT 1";
  		
  	//	die($sSql);
		/*echo '<br/>';
		echo $sSql;*/
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;

			//return $result_array;
			$result_array =  isset($result_array[0]) ? $result_array[0] : $result_array ;

			return isset($result_array[$sColumn]) ? $result_array[$sColumn] : $result_array ;

		}
		return '';


	}
 




	public function fileRecommendation(){
		 
		$sUser 			=		$this->db->escape($this->AppUser->getUserId());

		$resource_title 		= 		$this->db->escape($this->input->post('resource_title'));
		$resource_authors 		= 		$this->db->escape($this->input->post('resource_authors'));
		$resource_isbn 		= 		$this->db->escape($this->input->post('resource_isbn'));

 		$resource_body 			= 		$this->db->escape($this->input->post('resource_body'));	
 		$resource_release_year 		= 		$this->db->escape($this->input->post('resource_release_year'));
 		$recommendation_key 			= 		(int)($this->input->post('recommendation_key'));


 		//$sSemester 		= 		$this->db->escape($this->AppUser->getMySetSemester());	
 		//$sSql = "SELECT * FROM result_filed_complaints  WHERE rfc_subject =  ".$sSubject." AND  rfc_course = ".$sCourse." AND rfc_semester = ".$sSemester."  AND rfc_session = ".$sSession." AND rfc_student  = ".$sUser;
 		$sSql	=	"SELECT * FROM library_recomended_resources WHERE lrr_title = ".$resource_title ." AND lrr_author = ".$resource_authors." 
 		AND lrr_release_year = ".$resource_release_year." AND lrr_isbn = ".$resource_isbn;
 		$oChecker  = $this->db->query($sSql);

 		if($oChecker->num_rows() > 0){
 			return false;
 		}

 		if($recommendation_key > 0){
 			$sSql = "UPDATE library_recomended_resources SET lrr_isbn =  ".$resource_isbn.", lrr_author =  ".$resource_authors.",  lrr_title =  ".$resource_title.",lrr_recomender_note = ".$resource_body.", lrr_release_year = ".$resource_release_year."  WHERE lrr_id = ".$recommendation_key ." AND lrr_recomended_by=".$sUser." LIMIT 1" ;
 		}else{
		$sSql = "INSERT INTO library_recomended_resources(lrr_title,lrr_recomender_note,lrr_author,lrr_recomended_by,lrr_release_year,lrr_isbn)
		 VALUES(".$resource_title.",".$resource_body.",".$resource_authors.",".$sUser.",".$resource_release_year.",".$resource_isbn.");";
		}
		$this->db->query($sSql);
		if($this->db->_error_number()){
			return false;
			//return  '<div class="alert alert-danger">We have an issue processing your request</div>';
		}

		return true;

		//return '<div class="alert alert-success">Your request has been processed successfully.</div>';
	}





	public function getLibraries(){
	  //	$this->db->query();

		$sSql	=	"SELECT * FROM library_libraries l  WHERE l.ll_is_active  = 1 ORDER BY l.ll_title";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}


	public function getLibUsers(){
  
		$return 	=	 array();
		//	$sSql	=	"SELECT * FROM library_libraries l  WHERE l.ll_is_active  = 1 ORDER BY l.ll_title";
		$sSql	=	"SELECT sbi.*, sbi.lu_acc_status as acc_status, sbi.lu_phn as phn_no, sbi.lu_email  as email_address,   sbi.lu_id AS user_code,sbi.lu_full_name AS username FROM library_users  sbi  ";
		
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$return = $query->result_array() ;
		//	return $result_array ;
		}
 
	 
		return $return;
	}


	public function getCatalogLinkedAuthors102($iCatalog = 0){
		$query 	=	 $db->query("SELECT * FROM  library_catalog_item_authors WHERE  lcia_catalog_id = ".(int)$iCatalog);

		//$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}

		return array();

	}

	public function getExternalLibrariesRecord(){
	//	$this->db->query();

		$sSql	=	"SELECT * FROM library_external_libraries l  WHERE l.lel_enabled  = 1 ORDER BY l.lel_title";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}

	public function getAllExternalLibrariesRecord(){
	//	$this->db->query();

		$sSql	=	"SELECT * FROM library_external_libraries l     ORDER BY l.lel_title";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}


	


	public function getLibraryInfo($mID = '',$key = 'll_id',$isActive = false){
		$mID = ($key == 'll_id')? (int)$mID :  $mID;
		
		if(($key == 'll_id') && $mID < 1){ // propoer id was not passed
			return false;
		}
		$isActive  =  ' ';
		if($isActive){
			$isActive  =   'l.ll_is_active  = 1  
			AND ';
		}
		//echo $mID;
		//$sAnswer = (($key == "ll_id")? (int)$mID : "'".$mID."'");
		$sSql	=	"SELECT * FROM library_libraries l  
			WHERE ".$isActive." l.".$key."= ".(($key == "ll_id")? (int)$mID : "'".$mID."'")."
			LIMIT 1";

			//echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return false;
	}


	public function getExternalLibraryInfo($mID = '',$key = 'lel_id',$isActive = false){
		$mID = ($key == 'lel_id')? (int)$mID :  $mID;
		
		if(($key == 'lel_id') && $mID < 1){ // propoer id was not passed
			return false;
		}
		$isActive  =  ' ';
		if($isActive){
			$isActive  =   'l.lel_enabled  = 1  
			AND ';
		}
		//echo $mID;
		//$sAnswer = (($key == "ll_id")? (int)$mID : "'".$mID."'");
		$sSql	=	"SELECT * FROM library_external_libraries l  
			WHERE ".$isActive." l.".$key."= ".(($key == "lel_id")? (int)$mID : "'".$mID."'")."
			LIMIT 1";

			//echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return false;
	}


	public function adminDeleteCatalogueItem($iItemId  = 0){
		 $iItemId  	=	(int)$iItemId;
		$sSql 	=	"DELETE FROM  library_catalog_item   WHERE  lci_id = ".(int)$iItemId." LIMIT 1";
		$this->db->query($sSql);


		if($this->db->_error_number()){
			return false;
		}

		$this->dropCatlogueSubjects($iItemId);
		$this->dropCatlogueAuthors($iItemId);
		return true;
	}

	public function getCatalogLinkedSubjects($iCatalog =  0){
		/*$iCatalog 	=	(int)$iCatalog;
		if($iCatalog < 1){
			return array();
		}
		
		$oRecList	= $this->db->query("SELECT  DISTINCT * FROM library_catalog_item_subjects lcis JOIN library_catalog_item_subject lciss  ON lciss.lcis_id = lcis.lcis_title WHERE  lcis_catalog_id = ".$iCatalog." GROUP BY lciss.lcis_title");

		//$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
 
			return $result_array ;
		}

		return array();
		*/




		$iCatalog 	=	(int)$iCatalog;
		if($iCatalog < 1){			
			return array();
		}
		
		//$oRecList	= $this->db->query();
		$sSql 		=	"SELECT * FROM library_catalog_item_subjects  WHERE  lcis_catalog_id = ".$iCatalog;
		// die($sSql);
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
 
			return $result_array ;
		}
		 
		return array();

 
	}


	public function getCatalogLinkedAuthors($iCatalog =  0){

		$iCatalog 	=	(int)$iCatalog;
		if($iCatalog < 1){			
			return array();
		}
		
		//$oRecList	= $this->db->query();
		$sSql 		=	"SELECT * FROM library_catalog_item_authors  WHERE  lcia_catalog_id = ".$iCatalog;
		// die($sSql);
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
 
			return $result_array ;
		}
		 
		return array();

	}



	private function dropCatlogueSubjects($iCatalog = 0){
		$this->db->query("DELETE FROM library_catalog_item_subjects  WHERE  lcis_catalog_id = ".$iCatalog); 

	}

	private function dropCatlogueAuthors($iCatalog = 0){
		$this->db->query("DELETE FROM library_catalog_item_authors  WHERE  lcia_catalog_id = ".$iCatalog); 

	}



	public function getCatalogueInfo($mID = '',$key = 'lci_id'){
		$mID = ($key == 'lci_id')? (int)$mID :  $mID;
		
		if(($key == 'lci_id') && $mID < 1){ // propoer id was not passed
			return false;
		}
		//echo $mID;
		//$sAnswer = (($key == "ll_id")? (int)$mID : "'".$mID."'");
		$sSql	=	"SELECT * FROM library_catalog_item lci  
			WHERE /*lci.lci_is__active  = */ 1  
			AND lci.".$key."= ".(($key == "lci_id")? (int)$mID :  $this->db->escape($mID) )."
			LIMIT 1";

			//echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			$result_array[0]['getCatalogLinkedSubjects'] 		=	$this->getCatalogLinkedSubjects($result_array[0]['lci_id']);
			$result_array[0]['getCatalogLinkedAuthors'] 		=	$this->getCatalogLinkedAuthors($result_array[0]['lci_id']);

			/*echo '<pre>';
			print_r($result_array);
			die();*/

			 
			return $result_array ;
		}

		return false;
	}

	public function getExternalLibraries(){
	//	$this->db->query();

		$sSql	=	"SELECT * FROM library_external_libraries l  WHERE l.lel_enabled  = 1 ORDER BY l.lel_title";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}


	public function getCataloguesInLibrary($sCat_query = '', $iLibrary = 0){
		/*if($iLibrary < 1){

			return array();
		}*/
		$sWhere = '';
		if($sCat_query){
			$sWhere .= " AND CONCAT(lci.lci_title,lci.lci_year_published,lci.lci_date_acquired,lci.lci_author,lci.lci_callnumber)  LIKE '%".$this->db->escape_like_str($sCat_query)."%'";
		}

		if($iLibrary){
			$sWhere .= " AND lci.lci_library_id = ".(int)$iLibrary;
		}

		$sSql	=	"SELECT * FROM library_catalog_item lci LEFT JOIN library_libraries ll ON lci.lci_library_id = ll.ll_id WHERE 1 ".$sWhere;
		//echo $sSql;
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();

	}






	public function loadSubjects(){

		$sSql	=	"SELECT * FROM library_catalog_item_source lcis  WHERE lcis.lcis_is_active =  1";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	public function getCategories(){

		$sSql	=	"SELECT * FROM library_catalogue_categories lcc  WHERE lcc.lcc_enabled =  1";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	function saveExternalLibraryRecord($aArgs = array()){
		//print_r(func_get_args());
		if(!count($aArgs)){
			$aArgs 		=		$this->input->post();
		}
		$this->form_validation->set_message('saveLibraryRecord', 'This Record already exists');

		//print_r($aArgs);
		if(isset($aArgs['library_key']) && ($aArgs['library_key'] < 1)){

			/*  check to see if the record does not alrady exist in the data
			*/

			//echo $aArgs;
			$mCheck 	=	$this->getExternalLibraryInfo($aArgs['library_name'],'lel_title',false);
			//var_dump($mCheck);
			if(!$mCheck && !is_array($mCheck)){
				$sSql	=	"INSERT INTO library_external_libraries (lel_enabled,lel_title,lel_description,lel_searc_page,lel_homepage)
						VALUES(".(int)$aArgs['lib_status'].", '".$aArgs['library_name']."','".$aArgs['lib_description']."','".$aArgs['lib_query_address']."','".$aArgs['lib_address']."')";

			}else{
				$this->form_validation->set_message('saveLibraryRecord', 'This Record already exists');
				return false;
			}

			

		}else{
			$sSql	=	"UPDATE library_external_libraries
			SET lel_enabled = ".(int)$aArgs['lib_status']." ,  lel_title = '".$aArgs['library_name']."',lel_description = '".$aArgs['lib_description']."' , lel_homepage = '".$aArgs['lib_address']."' , lel_searc_page = '".$aArgs['lib_query_address']."'
			WHERE lel_id = ".($aArgs['library_key']);
		}
		
		$query = $this->db->query($sSql);
		return true;
	} 

	private function getFirstLibraryID(){
		$rResult 	=	 $this->db->query("SELECT ll_id FROM Library_libraries ORDER BY ll_id LIMIT  1");
		if($rResult->num_rows()){
			$result_array = $rResult->result_array() ;
			//print_r($result_array);
			return @$result_array[0]['ll_id'];
		}
		return '';
	} 


	function saveCatalogForExcel($aData = array()){
		//$mCheck 	=	$this->getLibraryInfo($aArgs['library_name'],'ll_title',false);
		if(!is_array($aData)){
			return;
		}
		$aParamToPass 	=	 array();
		$bCheckedForPrimaryId 		= 	false;
		$sCheckedForPrimaryValue 	= 	'';
		$bCheckedForPrimaryId2  	=	false; 
		$sCheckedForPrimaryValue2 	=	'';
		$bRecordExists 	=	 false;
		$iLibrary 	=	 0;
		$catolgue 	=	 0;
	 	 
	 	$sStatement = '';
		foreach ($aData as $key => $value) {
   		 	$sField 	=	'';
			$aField 	=	 elibrary_hardcoded_array_find_deep( elibraryExcelCellsPositioning() , $key , array());
 			
 			if(isset($aField[0])){
 				$sField 	=	$aField[0];
 			}

 			switch($sField){

 				case 'lci_author'		: 	{ $aParamToPass['cat_author'] = isset($aData[$key]) ? explode(',', $aData[$key])   : array(); unset($aData[$key]); continue;	break;	}
 				case 'lci_subject_id'	: 	{ $aParamToPass['cat_subject'] = isset($aData[$key]) ? explode(',', $aData[$key])   : array(); unset($aData[$key]); continue;	break;	}
 				case 'lci_category' 	:	{ $aData[$key]	=	$this->getSingleValue( 'library_catalogue_categories',   'lcc_id',  'lcc_title',$aData[$key]); continue; break;	}
 				case 'lci_source' 		:	{ $aData[$key]	=	$this->getSingleValue( 'library_catalog_item_source',   'lcis_id',  'lcis_title',$aData[$key]); continue; break;	}
 				case 'lci_format' 		:	{ $aData[$key]	=	$this->getSingleValue( 'library_catalogue_format',   'lcf_id',  'lcf_title',$aData[$key]); continue; break;	}
 				case 'lci_library_id' 	:	{ $aData[$key]	=	$this->getSingleValue( 'library_libraries',   'll_id',  'll_title',$aData[$key]);  if((int)$aData[$key] < 1){ $aData[$key] = $this->getFirstLibraryID();} continue; break;	}
 				case 'lci_isbn' 		:	{ $sCheckedForPrimaryValue  = $aData[$key];  $bCheckedForPrimaryId  =true; continue; break;	}
 				case 'lci_title' 		:	{ $bCheckedForPrimaryId2  =true; $sCheckedForPrimaryValue2  = $aData[$key]; continue; break;	}
 			}
 
 			if(isset($aData[$key] ) ){
 				$sStatement .= $sField.'='.$this->db->escape($aData[$key]).' , ';
 			}

 		//	echo $sField ."<br/>";

		}
		if(!$bCheckedForPrimaryId  || trim($sCheckedForPrimaryValue)  =='' || !$bCheckedForPrimaryId2 || trim($sCheckedForPrimaryValue2)  ==''){
		//	var_dump($sCheckedForPrimaryValue);
			return array();
		}

		$sSqlConfirmation 	=	 "SELECT lci_id FROM  library_catalog_item  WHERE lci_title = ".$this->db->escape($sCheckedForPrimaryValue2 )."   AND lci_isbn = ".$this->db->escape($sCheckedForPrimaryValue )."  LIMIT 1";
		$q 	=	$this->db->query($sSqlConfirmation);

		 
		
		//$mResultOfConfirmation 	=	 $this->getCatalogueInfo($sCheckedForPrimaryValue);		
		if($q->num_rows()   == 1){
			$bRecordExists =  true;
			$aRow =  $q->row_array(); 
			$catolgue 	=	 $aRow['lci_id'];

		}
		 
	 
		$sStatement 	=	substr($sStatement , 0, strlen($sStatement) - 2);
	 
		if($bRecordExists ){
			$sSql 	=	"UPDATE library_catalog_item SET ".$sStatement." WHERE lci_id =".$catolgue ."  LIMIT 1";
			$this->db->query($sSql);


		}else{
			$sSql 	=	"INSERT INTO library_catalog_item SET ".$sStatement;
			$this->db->query($sSql);
			$catolgue 	=	 $this->db->insert_id();
		}
		 
 		$aParamToPass['catalog_unique_id'] 	 = 	$catolgue ;
		$this->saveCatalogItemSubject($aParamToPass);
		$this->saveCatalogItemAuthors($aParamToPass);

		return true;

	}





	function saveLibraryRecord($aArgs = array()){
		//print_r(func_get_args());
		if(!count($aArgs)){
			$aArgs 		=		$this->input->post();
		}
		$this->form_validation->set_message('saveLibraryRecord', 'This Record already exists');

		//print_r($aArgs);
		if(isset($aArgs['library_key']) && ($aArgs['library_key'] < 1)){

			/*  check to see if the record does not alrady exist in the data
			*/

			//echo $aArgs;
			$mCheck 	=	$this->getLibraryInfo($aArgs['library_name'],'ll_title',false);
			//var_dump($mCheck);
			if(!$mCheck && !is_array($mCheck)){
				$sSql	=	"INSERT INTO library_libraries (ll_is_active,ll_type,ll_title,ll_description,ll_location)
						VALUES(".(int)$aArgs['lib_status'].",'".$aArgs['lib_type']."','".$aArgs['library_name']."','".$aArgs['lib_description']."','".$aArgs['lib_address']."')";

			}else{
				$this->form_validation->set_message('saveLibraryRecord', 'This Record already exists');
				return false;
			}

			

		}else{
			$sSql	=	"UPDATE library_libraries
			SET ll_is_active = ".(int)$aArgs['lib_status']." ,ll_type = ".(int)$aArgs['lib_type']." , ll_title = '".$aArgs['library_name']."',ll_description = '".$aArgs['lib_description']."', ll_location = '".$aArgs['lib_address']."'
			WHERE ll_id = ".($aArgs['library_key']);
		}
		
		$query = $this->db->query($sSql);
		return true;
	} 

	//method to delete library from database either just the library or with every item associated with it.
	public function deleteLibrary($aArgs = array()){
		$id 	=	isset($aArgs['id']) ?  (int)$aArgs['id'] :0;
		$sSql 	=	"DELETE FROM library_libraries WHERE ll_id = ".$id ." LIMIT 1";
		$this->db->query($sSql);
		return true;
	}

	function deleteLibraryRecord($iLibrary = 0){
		$iLibrary  = (int)$iLibrary ;
		$this->db->query("DELETE FROM library_libraries WHERE ll_id = ".$iLibrary);
		if($this->db->_error_number()){
			return false;
		}
		return true;
	}

	function deleteExternalLibraryRecord($iLibrary = 0){
		$iLibrary  = (int)$iLibrary ;
		$this->db->query("DELETE FROM library_external_libraries WHERE lel_id = ".$iLibrary);
		if($this->db->_error_number()){
			return false;
		}
		return true;
	}


	private function  saveCatalogItemSubject($aArgs 	=	array()){
		//library_catalog_item_authors
		if(!isset($aArgs['catalog_unique_id'])){
			return;
		}
		$id 	=	$aArgs['catalog_unique_id'];
		$sSql 	=	"DELETE FROM library_catalog_item_subjects WHERE lcis_catalog_id = ".$id ;
		$this->db->query($sSql);
		$iCounter 	=	 count($aArgs['cat_subject']);
		//cat_subject
		for($i =0; $i < $iCounter; $i++){
			if( trim($aArgs['cat_subject'][$i]) == ''){
				continue;
			}
			$sSql 	=	"INSERT INTO library_catalog_item_subjects(lcis_title,lcis_catalog_id) VALUES(".$this->db->escape($aArgs['cat_subject'][$i]).", ".( (int)$aArgs['catalog_unique_id']).")";
			$this->db->query($sSql);
		}

	}
	private function  saveCatalogItemAuthors($aArgs 	=	array()){
		if(!isset($aArgs['catalog_unique_id'])){
			return;
		}
		$id 	=	$aArgs['catalog_unique_id'];
		$sSql 	=	"DELETE FROM library_catalog_item_authors WHERE lcia_catalog_id = ".$id ;
		$this->db->query($sSql);
		$iCounter 	=	 count($aArgs['cat_author']);
		//cat_subject
		/*echo '<pre>';
		print_r($aArgs['cat_author']);

		echo '</pre>';*/
		for($i =0; $i < $iCounter; $i++){
		/*		echo '<pre>';
		print_r($aArgs['cat_author'][$i]);

		echo '</pre>';*/


			if(!isset($aArgs['cat_author'][$i])){
				continue;
			}
			if( trim($aArgs['cat_author'][$i]) == ''){
				continue;
			}
			$sSql 	=	"INSERT INTO library_catalog_item_authors(lcia_title,lcia_catalog_id) VALUES(".$this->db->escape($aArgs['cat_author'][$i]).", ".( (int)$aArgs['catalog_unique_id']).")";
			$this->db->query($sSql);
		}


	}

	public function eLibraryImportSaver(){

	}

	





	function saveCatalogueRecord($aArgs = array()){
		/*echo '<pre>';
		print_r($this->input->post(null));
		echo '</pre>';
		die();*/
		if(!count($aArgs)){
			$aArgs 		=		$this->input->post(null,true);
		}
		$this->form_validation->set_message('saveLibraryRecord', 'This Record already exists');

		//print_r($aArgs);
		$target = '';
		$iDownloadable 			= 0;
		$sDownloadLink 			= '';
		//echo $this->input->post('cat_key');
		//if($this->input->post('cat_key') &&  $this->input->post('cat_key') < 1  ){
		//var_dump(isset($aArgs['cat_key']) && ((int)$aArgs['cat_key'] < 1));
		if(isset($aArgs['cat_key']) && ((int)$aArgs['cat_key'] < 1)){
			/*  check to see if the record does not alrady exist in the data
			*/

			//echo $aArgs['library_key'];
			//$mCheck 	=	$this->getCatalogueInfo( ($this->input->post('cat_title')),'lci_title');

			$sSqlConfirmation 	=	 "SELECT lci_id FROM  library_catalog_item  WHERE lci_title = ".$this->db->escape( $this->input->post('cat_title') )."  AND  lci_accession = ".$this->db->escape($this->input->post('cat_accession'))."   AND lci_isbn = ".$this->db->escape($this->input->post('cat_isbn') )."  LIMIT 1";
			$q 	=	$this->db->query($sSqlConfirmation);
			$mCheck 	=	$q->result_array();
			$mCheck  	=	isset($mCheck[0])?$mCheck[0]:$mCheck;
			//print_r($mCheck);
			if( !count($mCheck)){
				
				// try uploading a file
				//print_r($_FILES['cat_screen']);
				if(!empty($_FILES['cat_screen']['name'])  && isset($_FILES['cat_screen']['name'])){
					// upload the file
					$oScreenShot = $_FILES['cat_screen'];
					//print_r($_FILES);
					$ext = explode('.', basename($oScreenShot['name']));
			    	$target = getElibraryCatalogScreenshotFileUploadDir()  . md5(uniqid()) . "." . array_pop($ext);
					/*$sContentOfFile = file_get_contents($oScreenShot['tmp_name']);
					var_dump(file_put_contents($target.'stream_', $sContentOfFile));*/
					if(!move_uploaded_file($oScreenShot['tmp_name'], $target)){
						$this->form_validation->set_message('screenshotUpload', 'There was an error while uploading the screenshot to this server.');
						
						return '<div class="alert alert-info"> Error occured while trying to upload the snapshot on this server </div>';
					}
					 
				}

				if(!empty($_FILES['cat_downloadable']['name']) && isset($_FILES['cat_downloadable']['name'])){
					// upload the file
					$oDownloadLink = $_FILES['cat_downloadable'];
					$ext = explode('.', basename($oDownloadLink['name']));
			    	$sDownloadLink = getElibraryDownloadableFileUploadDir()  . md5(uniqid()) . "." . array_pop($ext);
					if(!move_uploaded_file($oDownloadLink['tmp_name'], $sDownloadLink)){
						$this->form_validation->set_message('downloadableUpload', 'There was an error while uploading the downloadble file to this server.');
						return '<div class="alert alert-info"> Error occured while uploading the downloadble file on this server </div>';
					}

					$iDownloadable 			= 1;
					  
				} 
				
				$sSql	=	"INSERT INTO library_catalog_item (lci_accession, lci_source, lci_cost, lci_edition,lci_place_of_publish,lci_qty_remaining,lci_page_past_no,lci_preliminary_page_no,lci_note,lci_qty_acquired, lci_callnumber, lci_category, lci_downloadable, lci_download_link, lci_isbn,lci_format, lci_snapshot, lci_publisher,  lci_library_id, lci_description, lci_title, lci_year_published, lci_date_acquired)
						VALUES(".$this->db->escape($this->input->post('cat_accession'))." , ".$this->db->escape($this->input->post('cat_source'))." , ".$this->db->escape($this->input->post('cat_cost')).", ".$this->db->escape($this->input->post('lci_edition'))." , ".$this->db->escape($this->input->post('place_of_publish'))." , ".(int)($this->input->post('lci_qty_acquired')).",".$this->db->escape($this->input->post('cat_pln'))." ,".$this->db->escape($this->input->post('cat_ppn'))." ,".$this->db->escape($this->input->post('notes'))." , ".(int)($this->input->post('lci_qty_acquired')).", ".$this->db->escape($this->input->post('cat_callno')).", ".(int)($this->input->post('cat_category')).", ".$iDownloadable.", '".basename($sDownloadLink)."', ".$this->db->escape($this->input->post('cat_isbn')).", ".(int)($this->input->post('cat_format')).", ".$this->db->escape(basename($target)).", ".$this->db->escape($this->input->post('cat_publisher')).",  ".(int)($this->input->post('library_key')).", ".$this->db->escape($this->input->post('description'))." , ".$this->db->escape($this->input->post('cat_title'))." ,".$this->db->escape($this->input->post('cat_publish_year'))." ,".$this->db->escape($this->input->post('date_acquired')).")";

			}else{
				$this->form_validation->set_message('saveCatalogueRecord', 'This Record already exists');
				$mCheck = isset($mCheck[0])?$mCheck[0] : $mCheck;
				return '<div class="alert alert-warning"> Similar record was found. click <a href="'.elibraryAdminCatalogPage(@$mCheck['lci_id']).'" class="alert alert-link" title="'.@$mCheck['lci_title'].'"> HERE </a>to view the record. </div>';
			}

			

		}else{
			$mCheck 	=	$this->getCatalogueInfo( ($this->input->post('cat_title')),'lci_title');
			//var_dump($mCheck);
			$mCheck = isset($mCheck[0])?$mCheck[0] : $mCheck;

			//die();
			// try uploading a file
				if(!empty($_FILES['cat_screen']['name'])  && isset($_FILES['cat_screen']['name'])){
					// upload the file
					$oScreenShot = $_FILES['cat_screen'];
					$ext = explode('.', basename($oScreenShot['name']));
			    	$target = getElibraryCatalogScreenshotFileUploadDir()  . md5(uniqid()) . "." . array_pop($ext);
					//echo  ($target);
					if(!move_uploaded_file($oScreenShot['tmp_name'], $target)){
						$this->form_validation->set_message('screenshotUpload', 'There was an error while uploading the screenshot to this server.');
						return '<div class="alert alert-info"> Error occured while trying to upload the snapshot on this server </div>';
					}

					 
				}else{
					$target 	=	$mCheck['lci_snapshot'];
				}

				if(!empty($_FILES['cat_downloadable']['name']) && isset($_FILES['cat_downloadable']['name'])){
					// upload the file
					$oDownloadLink = $_FILES['cat_downloadable'];
					$ext = explode('.', basename($oDownloadLink['name']));
			    	$sDownloadLink = getElibraryDownloadableFileUploadDir()  . md5(uniqid()) . "." . array_pop($ext);
					if(!move_uploaded_file($oDownloadLink['tmp_name'], $sDownloadLink)){
						$this->form_validation->set_message('downloadableUpload', 'There was an error while uploading the downloadble file to this server.');
						return '<div class="alert alert-info"> Error occured while uploading the downloadble file on this server </div>';
					}

					$iDownloadable 			= 1;
					  
				}else{
					$iDownloadable 			= $mCheck['lci_downloadable'];
					$sDownloadLink 			= $mCheck['lci_download_link'];	
				}
 
			$sSql	=	"UPDATE library_catalog_item
			SET   lci_accession = ".$this->db->escape($this->input->post('cat_accession'))." , lci_source = ".$this->db->escape($this->input->post('cat_source'))." , lci_cost = ".$this->db->escape($this->input->post('cat_cost'))." ,  lci_edition = ".$this->db->escape($this->input->post('lci_edition'))." ,  lci_place_of_publish = ".$this->db->escape($this->input->post('place_of_publish'))." , lci_preliminary_page_no  = ".$this->db->escape($this->input->post('cat_ppn'))."  ,  lci_page_past_no  = ".$this->db->escape($this->input->post('cat_pln'))."  ,   lci_note  = ".$this->db->escape($this->input->post('notes'))."  ,   lci_qty_acquired = ".(int)($this->input->post('lci_qty_acquired')).",   lci_download_link = '".basename($sDownloadLink)."', lci_downloadable = ".$this->db->escape($iDownloadable).", lci_callnumber = ".$this->db->escape($this->input->post('cat_callno')).", lci_category =  ".(int)($this->input->post('cat_category')).",  lci_isbn =  ".$this->db->escape($this->input->post('cat_isbn')).",  lci_format =".(int)($this->input->post('cat_format')).",  lci_snapshot =   ".$this->db->escape(basename($target)).", lci_publisher = ".$this->db->escape($this->input->post('cat_publisher')).",      lci_library_id =   ".(int)($this->input->post('library_key')).",   	lci_description =  ".$this->db->escape($this->input->post('description'))." , lci_title = ".$this->db->escape($this->input->post('cat_title'))." ,  lci_year_published = ".$this->db->escape($this->input->post('cat_publish_year'))." , lci_date_acquired = ".$this->db->escape($this->input->post('date_acquired'))."
			WHERE lci_id = ".(int)($this->input->post('cat_key'));
		}

		$query = $this->db->query($sSql);
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">This Record already exists.   Please review and try again. </div>';
		}
		$id 	=	( (int)($this->input->post('cat_key')) >0 ) ? (int)($this->input->post('cat_key')) : $this->db->insert_id();

		$aLastPass 							=	$this->input->post(null);
		$aLastPass['catalog_unique_id'] 	=	$id; 
		$this->saveCatalogItemSubject($aLastPass);
		$this->saveCatalogItemAuthors($aLastPass);
		 

		return '<div class="alert alert-success">Record saved successfully.</div>';
	} 


	public function getExternalLibraryDetails($mID = '',$key = 'lel_id'){
		$mID = ($key == 'lel_id')? (int)$mID :  $mID;
		
		if(($key == 'lel_id') && $mID < 1){ // propoer id was not passed
			return false;
		}
		//echo $mID;
		//$sAnswer = (($key == "ll_id")? (int)$mID : "'".$mID."'");
		$sSql	=	"SELECT * FROM library_external_libraries l  
			WHERE /*l.lel_enabled  = 1  
			AND*/ l.".$key."= ".(($key == "lel_id")? (int)$mID : "'".$mID."'")."
			LIMIT 1";

		//	echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return false;
	}


	public function dashboardReservedResources($sWhere = 'WHERE 1'){
		//return;
		$sSql	=	"SELECT lbr_id FROM library_book_reservation  lbr ".$sWhere ;
		$this->db->query($sSql);
		return $this->db->query($sSql)->num_rows();
		
	}

	public function dashboardBorrowed($sWhere = 'WHERE 1'){
		//return;
		$sSql	=	"SELECT lbci_id FROM library_borrowed_catalog_item  lbci ".$sWhere ;
		$this->db->query($sSql);
		return $this->db->query($sSql)->num_rows();
		
	}

	public function dashboardReservedResourcess($sWhere = 'WHERE 1'){
		//return;
		$sSql	=	"SELECT lbr_id FROM library_book_reservation lbr   ".$sWhere ;
		$this->db->query($sSql);
		return $this->db->query($sSql)->num_rows();
		
	}

	public function getLibrariesWithCatalogueNumber(){
		$sSql	=	"SELECT   l.ll_title, l.ll_is_active, l.ll_id, (SELECT COUNT(lci.lci_qty_remaining) FROM library_catalog_item lci WHERE lci.lci_library_id = l.ll_id  ) AS ll_count FROM library_libraries l  WHERE l.ll_is_active  = 1 ORDER BY ll_count DESC";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	public function dashboardAdminOffenderViews($sWhere = 'WHERE 1'){
		//return;
		$sSql	=	"SELECT * FROM library_borrowed_catalog_item    ".$sWhere ;


		$this->db->query($sSql);
		return $this->db->query($sSql)->num_rows();
		
	}
	public function adminStudentViolations($aArgs = array()){
    	/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}	*/

		 
		//$iFolder = (int)$aArgs['iStudent'] ;
		$sSql = "SELECT * FROM library_offenders lo  
		JOIN library_offense_fine_types loft ON lo.lo_offence_id = loft.loft_id    ";
		
		$sSql= "SELECT lbi.*,lbci.*,loft.*,  CONCAT(sbi.library_users_surname,' ',sbi.library_users_firstname,' ',sbi.library_users_othername  ) AS username  FROM library_catalog_item lbi JOIN library_borrowed_catalog_item lbci  ON lbi.lci_id = lbci.lbci_catalog_item_id LEFT JOIN library_offense_fine_types loft ON lbci.lbci_offense = loft.loft_id JOIN  library_users sbi ON  lbci.lbci_user_id = sbi.lu_id WHERE lbci.lbci_offense > 0 ORDER BY lbci.lbci_id DESC";
		
		$sSql= "SELECT lbi.*,lbci.*,loft.*  FROM library_catalog_item lbi JOIN library_borrowed_catalog_item lbci  ON lbi.lci_id = lbci.lbci_catalog_item_id LEFT JOIN library_offense_fine_types loft ON lbci.lbci_offense = loft.loft_id  WHERE lbci.lbci_offense > 0 ORDER BY lbci.lbci_id DESC";
		
		
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
    }

	public function preparePagination(){
		$this->load->library('pagination');
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config); 

	}

	function adminReturnBorrowedItem(){
		if(!$this->input->post('item')){
			return '<div class="alert alert-danger">There was an error while processing your request. Please review the submitted data carefully. .</div>';
		
		}

		//var_dump( $this->input->post('lbci_date_returned'));

		$sSql ="UPDATE library_borrowed_catalog_item SET lbci_offense =".(int)$this->input->post('offense').", lbci_returned = 1, lbci_date_returned  = ".$this->db->escape(toMysqlDate($this->input->post('returndate')))."  WHERE lbci_id = ". (int)$this->input->post('trans')." LIMIT 1";
		//echo $sSql;
		$this->db->query($sSql);
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">There was an error while processing your request. Please try again later.</div>';
		}
		$this->db->query("UPDATE library_catalog_item SET lci_qty_remaining = (lci_qty_remaining + 1 ) WHERE lci_id =".(int)$this->input->post('item')." LIMIT 1 ");
		
		return '<div class="alert alert-success">Your request was processed successful.</div>';
	}
	public function adminBorrowResourceToStudent($user = 0){
		
		// FIRST CHECK IF THE RECORD EXIST 
		$oQuery = $this->db->query("SELECT * FROM library_borrowed_catalog_item WHERE lbci_returned = 0 AND   lbci_user_id =  ".$this->db->escape($user)." AND lbci_catalog_item_id =  ".(int)$this->input->post('item')." LIMIT 1");
		//var_dump($oQuery);
		if($oQuery->num_rows()){
			$result_array = $oQuery->result_array();
		 
			$result_array = (isset($result_array[0]) ) ? $result_array[0]: $result_array;
			return ('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  This item already exits in the account ('.$this->input->post('user').') and has not been returned.  ( Date Collected: '.$result_array["lbci_date_collected"].' - To be returned : '.$result_array["lbci_date_to_be_returned"].')');
		}
		//echo 'here';
		//print_r($_REQUEST);
		$sSql = "INSERT INTO library_borrowed_catalog_item(lbci_user_id, lbci_date_collected, lbci_catalog_item_id, lbci_date_to_be_returned)
		 VALUES(".$this->db->escape($user).",".$this->db->escape(toMysqlDate($this->input->post('oPick_up_date'))).", ".(int)$this->input->post('item').", ".$this->db->escape(toMysqlDate($this->input->post('oReturn_up_date'))).");";

		$oQuery = $this->db->query($sSql);
		if($this->db->_error_number()){
			return false;
		}
		$this->db->query("UPDATE library_catalog_item SET lci_qty_remaining = (lci_qty_remaining -1 ) WHERE lci_id =".(int)$this->input->post('item')." LIMIT 1 ");
		return true;
	}

	public function adminBorrowResourceToStudent2(){
		// FIRST CHECK IF THE RECORD EXIST 
		$oQuery = $this->db->query("SELECT * FROM library_borrowed_catalog_item WHERE lbci_returned = 0 AND   lbci_user_id =  ".$this->db->escape($this->input->post('user'))." AND lbci_catalog_item_id =  ".(int)$this->input->post('item')." LIMIT 1");
		if($oQuery->num_rows()){
			$result_array = $oQuery->result_array();
			print_r($result_array);
			die('<div class="alert alert-danger">This item already exits in the account ('.$this->input->post('user').') and has not been returned. Date Collected - to be returned : ');
		}

		$sSql = "INSERT INTO library_borrowed_catalog_item(lbci_user_id, lbci_date_to_be_returned, lbci_catalog_item_id, lbci_date_to_be_returned)
		 VALUES(".$this->db->escape($this->input->post('user')).",".$this->db->escape($this->input->post('oReturn_up_date')).", ".(int)$this->input->post('item').", ".$this->db->escape($this->input->post('oPick_up_date')).");";
		if($this->db->_error_number()){
			return false;
		}
		return true;
	}


	public function adminBorrowedRecords(){
		$sSql = "SELECT * FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  ";

		$sSql = "SELECT lbci.*,lci.*, loft.loft_title, sbi.lu_full_name AS username FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  LEFT JOIN library_offense_fine_types loft ON  lbci.lbci_offense = loft.loft_id LEFT JOIN library_users sbi ON lbci.lbci_user_id = sbi.lu_id    ORDER BY lbci.lbci_id  DESC ";
		
		/*$sSql = "SELECT * FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id LEFT JOIN library_offense_fine_types loft ON  lbci.lbci_offense = loft.loft_id WHERE lbci.lbci_returned =  0   ORDER BY lci.lci_id  DESC ";
		*/

		//die($sSql);

		//$sSql 	=	"";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	public function adminReturnedRecords($status = 1){
		/*$sSql = "SELECT lbci.*,lci.*, CONCAT( sbi.surname, ' ', sbi.first_name , ' ', sbi.other_name) AS username FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  LEFT JOIN staff_info sbi ON lbci.lbci_user_id = sbi.student_id  WHERE lbci.lbci_returned = 1 ORDER BY lbci.lbci_id DESC";
		*/
		$sSql = "SELECT lbci.*,lci.*, loft.loft_title, sbi.lu_full_name AS username FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  LEFT JOIN library_offense_fine_types loft ON  lbci.lbci_offense = loft.loft_id LEFT JOIN library_users sbi ON lbci.lbci_user_id = sbi.lu_id  WHERE lbci.lbci_returned = ".(int)$status."   ORDER BY lci.lci_id  DESC ";
		

		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	} 

	public function listBorrowableCatalogue( $mPick = null){
		$iMinimumRemaining = 1;
		if($mPick ==null){
			$mPick = '0';
		}
		//$mPick = $this->db->escape($mPick);

		$sSql = "SELECT * FROM library_catalog_item lci LEFT JOIN library_libraries ll ON lci.lci_library_id = ll.ll_id WHERE lci.lci_qty_remaining > ".($iMinimumRemaining -1) ." AND  lci.lci_callnumber =  ".$this->db->escape($mPick)." OR lci.lci_isbn =  ".$this->db->escape($mPick)." OR lci.lci_author  LIKE  '%".$this->db->escape_like_str($mPick)."%' OR lci.lci_title    LIKE  '%".$this->db->escape_like_str($mPick)."%'; " ;
		//echo  $sSql;
		$this->db->query($sSql);
		$query = $this->db->query($sSql);

		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}

		return array();
	}

	public function getStudentUnreturnedtemsCount($iStudent = 0){
		$sSql = "SELECT ";
	} 

	public function getStudentUnreturnedtems($aArgs = array()){
		if(!count($aArgs)){
			return array();
		}
 
		$sSql = "SELECT lbci.*,lci.*,lbci.*, sbi.lu_full_name AS username FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  LEFT JOIN library_users sbi ON lbci.lbci_user_id = sbi.lu_id WHERE ( sbi.lu_id = ".(int)($aArgs['iStudentID']). "  OR sbi.lu_email = ".$this->db->escape($aArgs['iStudentID']). " )  AND lbci.lbci_returned = 0 ORDER BY lbci.lbci_id DESC";



		//echo  $sSql;
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();

		
	}

	public function respondToRecommendation(){
		$sUser 		=	$this->db->escape($this->AppUser->getUserId());
		$sResponse 		= 		$this->db->escape($this->input->post('response_body'));
		$id =           (int)$this->input->post('res_id');
		$sSql = "UPDATE library_recomended_resources SET lrr_attended_to_by = ".$sUser."  , lrr_admin_note = ".$sResponse." ,  lrr_date_attended_to =  NOW(),lrr_status = 2  WHERE lrr_id = ".$id." LIMIT 1";
		$this->db->query($sSql);
		if($this->db->_error_number()){
			return  '<div class="alert alert-danger">We have an issue processing your request</div>';
		}

		return '<div class="alert alert-success">Your request has been processed successfully.</div>';

	}


	public function getUserSentRecommendationDetails($iRecommendationKey = 0){
		$sSql = "SELECT * FROM library_recomended_resources WHERE lrr_id = ".(int)$iRecommendationKey." AND lrr_recomended_by = ".$this->db->escape($this->AppUser->getUserId())." LIMIT 1";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return isset($result_array[0]) ? $result_array[0] : $result_array ;
		}
		return array();
	}

	public function getUserSentRecommendationDetailsForAdmin($iRecommendationKey = 0){
		$sSql = "SELECT * FROM library_recomended_resources WHERE lrr_id = ".(int)$iRecommendationKey."  LIMIT 1";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return isset($result_array[0]) ? $result_array[0] : $result_array ;
		}
		return array();
	}



	public function getRecommededResource(){
		$sSql = "SELECT * FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id  ";
		$sSql 			=			"SELECT * FROM library_recomended_resources";

		$sSql = "SELECT lrr.* , sbi.lu_full_name  AS username FROM library_recomended_resources lrr  
		  LEFT JOIN library_users sbi ON lrr.lrr_recomended_by = sbi.lu_id   ORDER BY lrr_id DESC ";
		


		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	public function getMyRecommendedResources(){

		$sSql 	=	"SELECT * FROM library_recomended_resources WHERE lrr_recomended_by  = ".$this->db->escape($this->AppUser->getUserId())." ORDER BY lrr_id DESC ";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	 

	public function saveCatalogueCategory($aArgs = array()){
		// check if the catalogue already exists or create one
		$sTitle 		= 		$aArgs['category_title'];
		$ID 			= 		$aArgs['cat_category_key'];
		/*$sSql 	= 	"SELECT * FROM library_catalogue_categories WHERE lcc_title = ".$this->db->escape($sTitle)." LIMIT 1";
		$oC 	=	$this->db->query($sSql);*/
		//var_dump($oC);
		if($ID > 0){

			//
			$sSql = "UPDATE library_catalogue_categories SET lcc_title =".$this->db->escape($sTitle)." WHERE lcc_id = ".$ID." LIMIT 1;";
		}else{
			// create new
			$sSql = "INSERT INTO library_catalogue_categories  (lcc_title) VALUES(".$this->db->escape($sTitle).");";
		}
		$this->db->query($sSql);

		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Your request was NOT processed successful. '.$this->db->_error_message().'</div>';
		}
		return '<div class="alert alert-success">Your request was processed  successful. </div>';
	}

	public function deleteCatalogueCategory($aArgs = array()){
		$id 		=		(int)$this->input->post('categoryID');
		$this->db->query("DELETE FROM library_catalogue_categories WHERE lcc_id = ". $id ." LIMIT 1");
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Error occured while processing your request</div>';
		}
		return '<div class="alert alert-success">Your request was processed successful.</div>';
	}

	public function deleteMiscViolation($aArgs = array()){
		$id 		=		(int)$this->input->post('ViolationTypeID');
		$this->db->query("DELETE FROM library_offense_fine_types WHERE loft_id = ". $id ." LIMIT 1");
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Error occured while processing your request</div>';
		}
		return '<div class="alert alert-success">Your request was processed successful.</div>';
	}

	public function deleteCatalogueFormat($aArgs = array()){
		$id 		=		(int)$this->input->post('formatID');
		$this->db->query("DELETE FROM library_catalogue_format WHERE lcf_id = ". $id ." LIMIT 1");
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Error occured while processing your request</div>';
		}
		return '<div class="alert alert-success">Your request was processed successful.</div>';
	}
	public function deleteCatalogueSubjects($aArgs = array()){
		$id 		=		(int)$this->input->post('subjectID');
		$this->db->query("DELETE FROM library_catalog_item_source WHERE lcis_id = ". $id ." LIMIT 1");
		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Error occured while processing your request</div>';
		}
		return '<div class="alert alert-success">Your request was processed successful.</div>';
	}





	public function saveCatalogueFormat($aArgs = array()){
		// check if the catalogue already exists or create one
		$sTitle 		= 		$aArgs['cat_format_title'];
		$ID 			= 		$aArgs['cat_format_key'];
		/*$sSql 	= 	"SELECT * FROM library_catalogue_categories WHERE lcc_title = ".$this->db->escape($sTitle)." LIMIT 1";
		$oC 	=	$this->db->query($sSql);*/
		//var_dump($oC);
		if($ID > 0){

			//
			$sSql = "UPDATE library_catalogue_format SET lcf_title =".$this->db->escape($sTitle)." WHERE lcf_id = ".$ID." LIMIT 1;";
		}else{
			// create new
			$sSql = "INSERT INTO library_catalogue_format  (lcf_title) VALUES(".$this->db->escape($sTitle).");";
		}
		$this->db->query($sSql);

		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Your request was NOT processed successful.  </div>';
		}
		return '<div class="alert alert-success">Your request was  successful. </div>';
	}

	public function saveCatalogueSubject($aArgs = array()){
		// check if the catalogue already exists or create one
		$sTitle 		= 		$aArgs['cat_subject_title'];
		$ID 			= 		$aArgs['cat_subject_key'];
		 
		if($ID > 0){
 
			$sSql = "UPDATE library_catalog_item_source SET lcis_title =".$this->db->escape($sTitle)." WHERE lcis_id = ".$ID." LIMIT 1;";
		}else{
			// create new
			$sSql = "INSERT INTO library_catalog_item_source  (lcis_title) VALUES(".$this->db->escape($sTitle).");";
		}
		$this->db->query($sSql);

		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Your request was NOT successful.  </div>';
		}
		return '<div class="alert alert-success">Your request was  successful. </div>';
	}


	function userBorrowViolationstatuschanger(){
		$this->db->query("UPDATE library_borrowed_catalog_item SET lbci_cleared = 1  WHERE  lbci_id = ".(int)$this->input->post('status_chager') );
		if($this->db->_error_number()){
			return false;
		}
		return true;
	}

	public function saveAdminViolationRecord($aArgs = array()){
		// check if the catalogue already exists or create one
		$sTitle 		= 		$aArgs['admin_violation_title'];
		$ID 			= 		$aArgs['admin_violation_key'];
		$sFine			=		$aArgs['admin_violation_fine'];
		$sDescription 	= 		$aArgs['admin_violation_description'];
		$iStatus	 	= 		$aArgs['admin_violation_description'];
		/*$sSql 	= 	"SELECT * FROM library_catalogue_categories WHERE lcc_title = ".$this->db->escape($sTitle)." LIMIT 1";
		$oC 	=	$this->db->query($sSql);*/
		//var_dump($oC);
		if($ID > 0){

			//
			$sSql = "UPDATE library_offense_fine_types SET loft_fee =".$this->db->escape($sFine).", loft_description =".$this->db->escape($sDescription).",  loft_title =".$this->db->escape($sTitle)." WHERE loft_id = ".$ID." LIMIT 1;";
		}else{
			// create new
			$sSql = "INSERT INTO library_offense_fine_types  (loft_description,loft_fee,loft_title) VALUES(".$this->db->escape($sDescription).",".$this->db->escape($sFine).",".$this->db->escape($sTitle).");";
		}
		$this->db->query($sSql);

		if($this->db->_error_number()){
			return '<div class="alert alert-danger">Your request was NOT successful. '.$this->db->_error_message().'</div>';
		}
		return '<div class="alert alert-success">Your submission was  successful. </div>';
	}

	public function getViolations(){
		$sSql = "SELECT * FROM library_offense_fine_types WHERE 	loft_is_active = 1 ORDER BY loft_title";
		
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}


	

	public function getCatalogueCategories(){
		$sSql = "SELECT * FROM library_catalogue_categories ORDER BY lcc_title";
		
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}


	public function getCatalogueFormats(){
		$sSql = "SELECT * FROM library_catalogue_format ORDER BY lcf_title";
		
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	function deleteCatalogCategory($aArgs = array()){
		$cat_id  = $aArgs['id'];
		$this->db->query("DELETE FROM library_catalogue_categories WHERE lcc_id = ".(int)$cat_id ."LIMIT 1;");
		if(!$this->db->_error_number()){
			return true;
		}
		return false;
	}


	function saveNewsEventRecord($aArgs = array()){
		//return ($this->input->post());
		$aArgs				=			$this->input->post(null,true);
		//print_r($aArgs);

		if($aArgs['hidden_news_key'] > 0){
			// update  the record
			$sSql =		"UPDATE library_news_events SET 
			lne_show 	=	".(int)$aArgs['news_status'].",
			lne_content= ".$this->db->escape($aArgs['inputContent'] )." ,
			lne_subject= ".$this->db->escape($aArgs['inputSubjectTitle'] )."
			WHERE lne_id =  " .$this->db->escape($aArgs['hidden_news_key'] )." LIMIT 1";
		}else{
			// check the existense befire creating any new record
			$qq 	=		$this->db->query("SELECT lne_id FROM library_news_events WHERE lne_subject= ".$this->db->escape($aArgs['inputSubjectTitle'] )." LIMIT 1");
			if($qq->num_rows()){
				return 'exists';
			}

			$sSql 			=		"INSERT INTO library_news_events (lne_show,lne_user,lne_subject,lne_content) VALUES (".((int)$aArgs['news_status']).",".$this->db->escape($this->AppUser->getUserId()).",".$this->db->escape($aArgs['inputSubjectTitle'] ).", ".$this->db->escape($aArgs['inputContent'] )." );";

		}
 		//die($sSql);
 		$q = $this->db->query($sSql);
		if($this->db->_error_number()){
			return 'error';
		}

		return 'success';
	}

	public function deleteNewsEventRecord(){
		$sSql 			=		"DELETE FROM library_news_events WHERE lne_id = ".(int)$this->input->post('newsDeleteHiddenID')." LIMIT 1";
		$q  = $this->db->query($sSql);

		return '<div class="alert alert-success"> Record has been deleted successfully. </div>';
	}

	public function getNewsAndEvents(){
	//	$this->db->query();

		$sSql	=	"SELECT * FROM library_news_events lne   ORDER BY lne.lne_id DESC";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}

	public function getNewsAndEventsInfo($mID = '',$key = 'lne_id', $isActive = false){
		$mID = ($key == 'lne_id')? (int)$mID :  $mID;
		
		if(($key == 'lne_id') && $mID < 1){ // propoer id was not passed
			return array();
		}
		$isActive  =  ' ';
		if($isActive){
			$isActive  =   'l.lne_show  = 1  
			AND ';
		}
		//echo $mID;
		//$sAnswer = (($key == "ll_id")? (int)$mID : "'".$mID."'");
		$sSql	=	"SELECT * FROM library_news_events l  
			WHERE ".$isActive." l.".$key."= ".(($key == "lne_id")? (int)$mID : "'".$mID."'")."
			LIMIT 1";

			//echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return array();
	}


	public function getNewsAndEventsInfo2( $key = 0){
		 
		 
		$sSql = "SELECT * FROM library_news_events l WHERE  l.lne_id= ".$key." LIMIT 1";
			//echo $sSql;
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return array();
	}

	public function adminSaveSystemSettings(){
		
		$this->db->query("UPDATE ibrary_system_settings SET  ");
		if(!$this->db->_error_number()){
			return '<div class="alert alert-success> Your request has been processed successfully.</div>';
		}
		return '<div class="alert alert-success> System detected an error while processing your request.</div>';
	}

	public function getAdminSystemSettings(){

	}

	public function adminBookedReservationsList( ){
		/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}		 
		$iUser = (int)$iStudent ;*/
		$sSql = "SELECT lbr.*, lci.*, sbi.lu_full_name AS username FROM library_book_reservation lbr  
		JOIN library_catalog_item lci  ON lbr.lbr_catalog_item_id = lci.lci_id    LEFT JOIN  library_users sbi ON  lbr.lbr_reservedby= sbi.lu_id  ORDER BY lbr.lbr_id DESC";
		//echo  $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}

	public function myBookedReservations($iStudent = 0){
		/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}		 
		$iUser = (int)$iStudent ;*/
		$sSql = "SELECT * FROM library_book_reservation lbr  
		JOIN library_catalog_item lci  ON lbr.lbr_catalog_item_id = lci.lci_id    LEFT JOIN  library_users sbi ON  lbr.lbr_reservedby= sbi.lu_id WHERE  lbr.lbr_reservedby  = ".$this->db->escape($iStudent);
		//echo  $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}


	 public function updateReservationRecord($aArgs = array()){
	 	//return 'record saved';
	 	$sSql 		=	"UPDATE library_book_reservation SET lbr_processedby =".$this->db->escape($this->AppUser->getUserId()).", 
	 	lbr_status = ".(int)$aArgs['admin_reserve_status']." , lbr_date_reserverd_for = ".$this->db->escape(toMysqlDate($aArgs['bookagainstatevalue']))." , lbr_admin_note = ".($this->db->escape($aArgs['admin_comment'])).", lbr_date_to_be_returned = ".$this->db->escape(toMysqlDate($aArgs['returnatevalue']))." WHERE lbr_id = ".$aArgs['reservation_key_holder'];
	 	$this->db->query($sSql);
	 	return '<div class="alert alert-success">Your record has been processed successfully.  </div>';
	 }

	public function ReservationsDetails($iReservationID = 0){
		 
		$sSql = "SELECT lbr.*,lci.*,sbi.lu_full_name AS username  FROM library_book_reservation lbr  
		JOIN library_catalog_item lci  ON lbr.lbr_catalog_item_id = lci.lci_id    LEFT JOIN  library_users sbi ON  lbr.lbr_reservedby= sbi.lu_id WHERE  lbr.lbr_id  = ".$iReservationID." LIMIT 1";
		//echo  $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
	}


	public function getReturnedResourcesDetails($iID = ''){
		//
		if(strlen($iID) < 1){
			return array();
		}
		$iID = $iStudentID;

		$sSql = "SELECT * FROM library_user_favourite_list lufl  WHERE lufl.lufl_user_id = ".$this->db->escape($iStudentID)." ORDER BY lufl_title ";
		
		//echo  $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();

	}











	 

}