<?php
/*
*/
class MyLibrary extends CI_Model{
	private $iCurrentStudentId							=	0;
	private $sUserPrivateFileUploadTable				=	"library_user_upload";

	public function __construct(){
		parent::__construct();
		//$this->load('database');
		$this->IcurrentStudentId =1;
	}

	function generateElibraryCatalogueLink($iID = 0){
			if($iID  <  1){
				return '#';
			}
			//var_dump( $iID);
			return $this->config->item('elibrary_student_portal_base_url').'catalogue/'.$iID;
		}



	public function getFileForDownload($aArg = array()){
		if(!isset($aArg['iStudentID'])  || !isset($aArg['iFileID'])  ) {
			return array();
		}

		$aArg['iStudentID'] = $this->db->escape($aArg['iStudentID']);
		$sSql	=	"SELECT * FROM library_user_upload luu WHERE luu.luu_id = ".(int)$aArg['iFileID']. " AND luu.luu_is_hidden = 0 AND luu.luu_user_id = ".$aArg['iStudentID'];
		$oDBReturn = $this->db->query($sSql);
		//echo $sSql;
		if ($oDBReturn->num_rows() > 0)
		{
			$result_array = $oDBReturn->result_array() ;
			return $result_array ;
		}
		return array();

	}

	public function getCatalogueFileForDownload($aArg = array()){
		if(  !isset($aArg['iFileID'])  ) {
			return array();
		}
		//$sSql	=	"SELECT * FROM library_user_upload luu WHERE luu.luu_id = ".(int)$aArg['iFileID']. " AND luu.luu_is_hidden = 0 AND luu.luu_user_id = ".$aArg['iStudentID'];
		$sSql 	=	"SELECT * FROM library_catalog_item lci WHERE lci.lci_id = ".(int)$aArg['iFileID'] ." AND lci.lci_downloadable = 1 LIMIT 1";
		$oDBReturn = $this->db->query($sSql);
		//echo $sSql;
		if ($oDBReturn->num_rows() > 0)
		{
			$result_array = $oDBReturn->result_array() ;
			return $result_array ;
		}
		return array();

	}



	public function myPrivateFiles($iStudent = 0){
		 
		if(( strlen($iStudent) < 1) && (strlen($this->iCurrentStudentId) < 1) ){

			return array();
		}
		 
		$iUser = $this->db->escape($iStudent);
		 

		$sSql = "SELECT * FROM library_user_upload l WHERE l.luu_user_id = ".$iUser." AND l.luu_is_hidden = 0 ORDER BY l.luu_id DESC";
		
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

	public function cancelMyReservation(){
		$sSql = "";
		$this->db->query($sSql);
	}
 


	function saveFileToDB($aParam = array()){

		/*$sSql 	=	"SELECT * FROM library_user_upload WHERE luu_user_id";
		$query = $this->db->query($sSql);			 
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}*/
		$sSql 	=	"INSERT INTO library_user_upload(luu_location,luu_user_id,luu_title,luu_size) 
					 VALUES(".$this->db->escape($aParam['path']).",".$this->db->escape($aParam ['user']).",".$this->db->escape($aParam ['title']).",".$this->db->escape($aParam ['size'])." )";
		
		$query = $this->db->query($sSql);
		if($this->db->_error_number()){
			return false;
		}
		return $this->db->insert_id();
	}
	

	public function uploadMyFiles($aData = array()){


	}

	/*Used for viewing students private uploads*/
	public function myPrivateUploads(){
		$aArgs 			=	func_get_args();

		/*if(!empty()){

		}*/
	}

	public function upload() {
		if (!empty($_FILES)) {
		$tempFile = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$targetPath = getcwd() . '/uploads/';
		$targetFile = $targetPath . $fileName ;
		move_uploaded_file($tempFile, $targetFile);
		// if you want to save in db,where here
		// with out model just for example
		// $this->load->database(); // load database
		// $this->db->insert('file_table',array('file_name' => $fileName));
		}
    }

    public function studentBorrowedResources($aArgs = array()){
    	/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}	*/
		//print_r($aArgs);
		$iUser = $aArgs['iStudent'] ;
		$sSql = "SELECT * FROM library_borrowed_catalog_item lbci  
		JOIN library_catalog_item lci  ON lbci.lbci_catalog_item_id = lci.lci_id LEFT JOIN library_offense_fine_types loft ON  lbci.lbci_offense = loft.loft_id WHERE lbci.lbci_user_id = ".$this->db->escape($iUser)."   ORDER BY lci.lci_id  DESC ";
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


	public function deleteFromMyFiles($iUser=0,$iFileId=0){
		$oRec = $this->db->query("SELECT * FROM library_user_upload WHERE luu_user_id = ".$this->db->escape($iUser)." AND luu_id =  ".$iFileId." LIMIT 1");
		//$oCheck	=	$this->db->query($sSql);
		if ($oRec->num_rows() > 0)
		{	
			$result_array = $oRec->result_array() ;
			 
			$sFileLink 			=		$result_array[0]['luu_location'];
			$sSql = "DELETE FROM library_user_upload WHERE luu_user_id = ".$this->db->escape($iUser)." AND luu_id =  ".$iFileId." LIMIT 1";
			$this->db->query($sSql);
			if(!$this->db->_error_number() && file_exists($sFileLink) && unlink($sFileLink)){
				return true;
			}		
			return false;	
		}
		return false;


		
		
	}

	public function deleteFromMyshelfItem($iUser=0,$iFileId=0,$iShelf = 0){
		  	$sSql = "DELETE FROM library_user_favourite_list_items WHERE lufli_user_id = ".$this->db->escape($iUser)." AND 	lufli_item =  ".$this->db->escape($iFileId)." LIMIT 1";
			if($this->db->query($sSql)  ){
				return true;
			}		
			return false;	 
		
	}


	public function moveToShelfItem($iUser=0,$iFileId=0,$iShelf = 0,$iFrom){
		
		$mCheck = $this->db->query("SELECT lufli_item FROM library_user_favourite_list_items WHERE lufli_item = ".$iFileId." AND lufli_bag_id = ".$iShelf." AND  lufli_user_id = ".$this->db->escape($iUser)."  LIMIT 1");
		
		if($mCheck->num_rows() > 0){
			return '<div class="alert alert-warning"> <h3> Duplicate detected!</h3>You already have this item in the same shelf. Please try another shelf.</div>';
		}
			$exe 		=	$this->db->query("UPDATE library_user_favourite_list_items SET lufli_bag_id = ".$iFrom." WHERE lufli_item = ".$iFileId." AND lufli_bag_id = ".$iFrom." AND  lufli_user_id = ".$this->db->escape($iUser)."  LIMIT 1");
				
		if(!$this->db->_error_number()){
			return '<div class="alert alert-success"> Your request has been processed successfully.</div>';
		}
			return '<div class="alert alert-warning"> <h3>Error detected!</h3>error occured while processing your request. Please try again later.</div>';
	}



	public function saveToShelfItem($iUser=0,$iFileId=0,$iShelf = 0,$iFrom){
		//print_r($_REQUEST);
		//print_r($iShelf);

		//sprint_r(func_get_args());
		//print_r($_REQUEST);
		$mCheck = $this->db->query("SELECT lufli_item FROM library_user_favourite_list_items WHERE lufli_item = ".$this->db->escape($iFileId)." AND lufli_bag_id = ".$iShelf." AND  lufli_user_id = ".$this->db->escape($iUser)."  LIMIT 1");
		if($mCheck->num_rows() > 0){
			return '<div class="alert alert-warning"> <h3> Duplicate detected!</h3>You already have this item in the same shelf. Please try another shelf.</div>';
		}
		if(($iFileId <  1 )|| $iShelf < 1 ){
			return '<div class="alert alert-warning"> Incomplete data was submitted. Kindly refresh this page.</div>';
		}
		$sSql =	"INSERT INTO library_user_favourite_list_items (lufli_item,lufli_bag_id,lufli_user_id,lufli_date_added)VALUES(".$this->db->escape($iFileId).",".$iShelf.",".$this->db->escape($iUser).",now());";
		// /echo $sSql;
		$exe 		=	$this->db->query($sSql);
		if(!$this->db->_error_number()){
			return '<div class="alert alert-success"> Your request has been processed successfully.</div>';
		}
			return '<div class="alert alert-warning"> <h3>Error detected!</h3>error occured while processing your request. Please try again later.</div>';
	}



	public function myBookedReservations($iStudent = 0){
		if(( strlen($iStudent) < 1) && (strlen($this->iCurrentStudentId)< 1) ){

			return array();
		}		 
		$iUser = $iStudent ;
		$sSql = "SELECT * FROM library_book_reservation lbr  
		JOIN library_catalog_item lci  ON lbr.lbr_catalog_item_id = lci.lci_id WHERE lbr.lbr_reservedby = ".$this->db->escape($iUser)."   ORDER BY  lbr.lbr_id DESC;";
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


	public function myBookedReservationsDetails($aArgs = array()){
				// print_r($aArgs);
		$iUser			 		= 			$aArgs['iStudentID'] ;
		$iReservation			= 			(int)$aArgs['iReservationID'] ;
		$sSql = "SELECT * FROM library_book_reservation lbr  
		JOIN library_catalog_item lci  ON lbr.lbr_catalog_item_id = lci.lci_id WHERE lbr.lbr_reservedby = ".$this->db->escape($iUser)." AND  lbr.lbr_id = ".(int)$iReservation."  ";
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




	public function addToReservation($aArgs = array()){
		/*print_r($aArgs);
		return;*/
		$sSql 		=		"INSERT INTO library_book_reservation(lbr_date_reserverd_for,lbr_date_reserved,lbr_catalog_item_id,lbr_reservedby,lbr_user_note) VALUES(".$this->db->escape($aArgs['pickupdatevalue']).",now(),'".(int)$aArgs['itemID']."' ,".$this->db->escape($aArgs['iStudentID'])." ,".$this->db->escape($aArgs['secDescription']).")";
		$this->db->query($sSql);
		//echo $this->db->_error_number();
		if($this->db->_error_number()){
			return false;
		}
		return true;
	}

	


	public function deleteFromReservation($aArgs = array()){
		//print_r($aArgs);
		$sSql 				=			"SELECT * FROM library_book_reservation WHERE lbr_id = ".(int)$aArgs['reservationID']." AND  lbr_reservedby = ".$this->db->escape($aArgs['iStudentID'])." LIMIT 1";
		$query = $this->db->query($sSql);
		//print_r($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result() ;
			$this->db->query("DELETE FROM library_book_reservation   WHERE lbr_id = ".(int)$aArgs['reservationID']." AND  lbr_reservedby = ".$this->db->escape($aArgs['iStudentID'])." LIMIT 1");

			if(!$this->db->_error_number()){
				return true;
				return json_encode(array('status'=>true,'Your request was successful.'));

			}
			return false;
			return json_encode(array('status'=>false,'Error occured while processing your request'));

		}
		return false;
		return json_encode(array('status'=>false,'Record Does not exits'));

	}

	public function plsReserveBook(){

	}

	

	public function myLoanHistory(){
		
	}

	public function studentViolations($aArgs = array()){
    	/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}	*/

		$iUser =  $aArgs['iStudent'] ;
		//$iFolder = (int)$aArgs['iStudent'] ;
		$sSql = "SELECT * FROM library_offenders lo  
		JOIN library_offense_fine_types loft ON lo.lo_offence_id = loft.loft_id WHERE lo.lo_user_id = ".$this->db->escape($iUser)."    ";
		
		$sSql= "SELECT * FROM library_catalog_item lbi JOIN library_borrowed_catalog_item lbci  ON lbi.lci_id = lbci.lbci_catalog_item_id LEFT JOIN library_offense_fine_types loft ON lbci.lbci_offense = loft.loft_id WHERE lbci.lbci_user_id = ".$iUser ." ORDER BY lbci.lbci_id DESC";

		
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}
		return array();
    }






    public function studentFavouriteResources($aArgs = array()){
    	/*if(( (int)$iStudent < 1) && ($this->iCurrentStudentId< 1) ){

			return array();
		}	*/

		//print_r($aArgs);
		$iUser =  $this->db->escape($aArgs['iStudent']) ;
		$iFolder = (int)$aArgs['iFolder'] ;
		 


		$sSql 		=		"SELECT * FROM library_user_favourite_list_items lufl JOIN library_catalog_item lci ON lufl.lufli_item = lci.lci_id WHERE lufl.lufli_is_deleted = 0 AND  lufl.lufli_user_id = ".$iUser."  AND  lufl.lufli_bag_id = " .$iFolder;
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

    public function studentFavouriteFolderAndItemCount($iStudent = 0){
		 
		if(( strlen($iStudent) < 1)   ){

			return array();
		}
		 
		$iUser =  $iStudent ;
		 

		$sSql = "SELECT lufl.lufl_title, lufl.lufl_user_id,lufl.lufl_date_added,lufl.lufl_hidden,lufl.lufl_id,lufl.lufl_user_type, (SELECT DISTINCT COUNT(lufli_id) FROM library_user_favourite_list_items lufli WHERE  lufli.lufli_bag_id = lufl.lufl_id  AND lufli.lufli_item > 0) AS rec_count FROM library_user_favourite_list lufl  WHERE lufl.lufl_user_id = ".$this->db->escape($iUser)." AND lufl.lufl_hidden = 0  ORDER BY lufl.lufl_id DESC ";
		
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

	public function StudentSearchHistory($iStudent = 0){
		 
		if(( strlen($iStudent) < 1) && (strlen($this->iCurrentStudentId)< 1) ){

			return array();
		}
		 
		$iUser = $this->db->escape($iStudent) ;
		 

		$sSql = "SELECT * FROM library_user_saved_search luss  WHERE luss.luss_user = ". $iUser."  ORDER BY luss_date_added DESC";
		
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

	

	public function saveToSearchHistory($aArgs = array()){
		 
        if($this->AppUser->isLiveHost()){
            return;
        }
        $iUser = $this->db->escape($this->AppUser->getUserId());
         if(strlen($iUser) < 1){
         	return ;
         }          
         
         $sQuery = '';
         foreach($this->input->get_post(null) as $sKey=>$mValue){
         	$sQuery .= $sKey.'='.$mValue.'&';
         }
         $sQuery = $sQuery;
        // echo $sQuery;
        $sSql = "SELECT * FROM library_user_saved_search luss  WHERE luss.luss_user = ".$iUser."  ORDER BY luss_date_added ";
		//$iUser =$this->AppUser->getUserId() ;
		//echo  $sSql;
		$mQuery = $this->db->query($sSql);
		//print_r($query);
		if ($mQuery->num_rows() > 12312)
		{
			$result_array = $mQuery->result_array() ;
			//return $result_array ;
			$this->db->query("UPDATE library_user_saved_search SET luss_no_of_visits = (luss_no_of_visits+1), luss_last_search =now() WHERE luss_query = ".$iUser." AND luss_search_type = ".$iUser." AND 	luss_query = ".$iUser." AND luss_user = ".$iUser."  ");
		}
		//return array();

		$sSql 	=	"INSERT INTO library_user_saved_search(luss_search_type,luss_user,luss_no_of_visits,luss_last_search,luss_query,luss_keyword) 
		VALUES('".@$aArgs['search_type']."',".$iUser.",1,now(),".$this->db->escape($sQuery).",".$this->db->escape(@$aArgs['keyword']).") /*ON DUPLICATE KEYS UPDATE luss_no_of_visits =  (luss_no_of_visits+1),luss_last_search = NOW(); */";
		$query = $this->db->query($sSql);
	}



		public function saveToSearchHistory_old($aArgs = array()){
		/*echo '<pre>' ;
                    print_r($this->input->get_post(null));
                    echo '</pre>' ;*/
        $iUser = $this->db->escape($this->AppUser->getUserId());
         if(strlen($iUser) < 1){
         	return ;
         }          
         
         $sQuery = '';
         foreach($this->input->get_post(null) as $sKey=>$mValue){
         	$sQuery .= $sKey.'='.$mValue.'&';
         }
         $sQuery = $sQuery;
        // echo $sQuery;
      /*  $sSql = "SELECT * FROM library_user_saved_search luss  WHERE luss.luss_user = ".$iUser."  ORDER BY luss_date_added ";
		//$iUser =$this->AppUser->getUserId() ;
		//echo  $sSql;
		$mQuery = $this->db->query($sSql);
		//print_r($query);
		if ($mQuery->num_rows() > 12312)
		{
			$result_array = $mQuery->result_array() ;
			//return $result_array ;
			$this->db->query("UPDATE library_user_saved_search SET luss_no_of_visits = (luss_no_of_visits+1), luss_last_search =now() WHERE luss_query = ".$iUser." AND luss_search_type = ".$iUser." AND 	luss_query = ".$iUser." AND luss_user = ".$iUser."  ");
		}
		//return array();*/

		$sSql 	=	"INSERT INTO library_user_saved_search(luss_search_type,luss_user,luss_no_of_visits,luss_last_search,luss_query,luss_keyword) 
		VALUES('".@$aArgs['search_type']."',".$iUser.",0,now(),".$this->db->escape($sQuery).",".$this->db->escape(@$aArgs['keyword']).") ON DUPLICATE KEY UPDATE   luss_no_of_visits = (luss_no_of_visits+1) ,luss_last_search = now()  ";
		$query = $this->db->query($sSql);
	}



	private function getSearchCount($sSql = ''){
		if($sSql =="" OR empty($sSql) ){

			return array();
		}
		$query = $this->db->query($sSql);
		return $query->num_rows();

	}


	public function searcher($sSql = '',$iOffset = 0){
		if($sSql =="" OR empty($sSql) ){

			return array();
		}	
		 
		$config['query_string_segment'] = 'page';
		$config['total_rows'] = $this->getSearchCount($sSql);

		$iLimit 	=	10;
		$iOffset  = (isset($_GET[$config['query_string_segment']]) && ($_GET[$config['query_string_segment']]) > 0) ? (int)($_GET[$config['query_string_segment']]) :0;

		$sSql = $sSql.' LIMIT  '.$iOffset.' , '.$iLimit.';'; 
		//echo $sSql;
		$this->load->library('pagination');

				
		//echo  $sSql;
		
		//echo $config['total_rows'];
		$query = $this->db->query($sSql);
		
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$config['per_page'] = $iLimit;
			//echo 
			
			//var_dump(current_url().'?'.$_SERVER['QUERY_STRING']);
			
		//	$iOffset 	=	(int)$this->input->get($config['query_string_segment']);
			//unset($_GET[$config['query_string_segment']]);
			//$config['base_url'] = current_url();
			//$config['total_rows'] = $query->num_rows();
			//var_dump($config);
			
			$config['base_url'] = str_replace('index.php','',current_url()).'?'.$_SERVER['QUERY_STRING'];; 
			if(isset($_GET[$config['query_string_segment']])){
			//	print_r(($_GET));
				$aCopied = $_GET;
				array_pop($aCopied);
				//$config['first_url'] = $config['base_url'].'?'.http_build_query($aCopied);
				$config['base_url'] = str_replace('index.php','',current_url()).'?'.http_build_query($aCopied); 
			}


			//$config['base_url'] = str_replace('index.php','',current_url()).'?'.http_build_query($aCopied); 
			//($this->input->get->)
			 //$config['per_page'] = 5;
			//str_replace(search, replace, subject)
			
			

			//print_r(($aCopied));


			$config['num_links'] =10;

			$iNum_links = $config["total_rows"] / $config["per_page"];

			if($iNum_links < $config['num_links']){
				$config["num_links"] = round($iNum_links);
			}
    		

			$config['use_page_numbers'] = true;
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';			
			$config['page_query_string'] = TRUE;

			$config['first_link'] = '&nbsp; &nbsp; <button class="btn btn-info"> First Page</button>';
			$config['last_link'] = '&nbsp; &nbsp; <button class="btn btn-info"> Last Page</button>';

		 	$config['next_link'] = '&raquo;';
			//if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			$config['first_url'] = $config['base_url'];
			 
			$this->pagination->initialize($config); 


			$result_array = $query->result_array() ;
			return $result_array ;
		}
		
		return array();
	}



	public function getCatalogueInfo($iCatID = 0){
		if(( (int)$iCatID < 1) ){

			return array();
		}	 

		$sSql = "SELECT * FROM library_catalog_item lci LEFT JOIN library_libraries ll ON lci.lci_library_id = ll.ll_id  /**  LEFT JOIN library_catalog_item_subject lcis  ON  lci.lci_subject_id = lcis.lcis_id  **/ LEFT JOIN library_catalogue_format lcf  ON  lci.lci_format  =  lcf.lcf_id   LEFT JOIN  library_catalogue_categories lcc  ON lci.lci_category=  lcc.lcc_id WHERE lci.lci_id = ".(int)$iCatID."  LIMIT 1 ";
		
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

	public function getShelfInfo($iShelf = 0){
		if(( (int)$iShelf < 1) ){

			return array();
		}	 

		$sSql = "SELECT * FROM library_user_favourite_list lufl  WHERE lufl.lufl_id = ".(int)$iShelf."  LIMIT 1 ";
		
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

	public function getShelves($iStudentID = 0){
		if(( strlen($iStudentID) < 1) ){

			return array();
		}	 

		$sSql = "SELECT * FROM library_user_favourite_list lufl  WHERE lufl.lufl_user_id = ".$this->db->escape($iStudentID)." ORDER BY lufl_title ";
		
		//echo  $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			//print_r($result_array);
			return $result_array ;
		}
		return array();
	}

	

	public function getReturnedResourcesDetails($iID = 0){
		if($iID < 1){
			return array();
		}
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


	public function saveShelves($aData = array()){
		
		if(isset($aData['shelfKey']) && $aData['shelfKey'] > 0){
			$sSql  =  "UPDATE library_user_favourite_list SET  lufl_title = ".$this->db->escape(($aData['shelfTitle']))." WHERE  lufl_user_id =  ".$this->db->escape($aData['iStudentID'])." AND lufl_id = ".(int)$aData['shelfKey']." LIMIT 1";

		}else{
			$sSql 			=		"INSERT INTO library_user_favourite_list(lufl_title,lufl_user_id,lufl_date_added) VALUES(".$this->db->escape(($aData['shelfTitle'])).",".$this->db->escape($aData['iStudentID']).",now())";

		}
		
		
		//$query = $this->db->query($sSql);bSbSbSbSbS
		//echo $sSql;
		$query = $this->db->query($sSql);
		//print_r($query);
		/*if ($query->num_rows() > 0)
		{*/
			return true;
		/*}*/
		return false;
	}

	public function myInbox($iUser = 0,$sField = ''){
		$bStudentLevel = true;
		$iUser 	=	$this->db->escape($iUser);

		$sSql = "SELECT * FROM messanger_";
		$sSql	=	"SELECT lum.*,sbi.lu_full_name AS user FROM library_user_message lum LEFT JOIN library_users sbi ON lum.lur_sender_id = sbi.lu_id  WHERE lum.lur_reciever_id  = ".$iUser." ORDER BY lum.lur_id  DESC";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}
	private function deleteAttachment($iMsg_id = 0){
		$sSql = '';

	}

	public function sendMessage($aArgs  = array()){
		if(!count($aArgs)){
			$aArgs  = $this->input->post(null,true);
		}


		/*$aReciever = $aArgs[''];//array();
		$i = 0;
		$iReciever = count($aReciever);*/
		/*for($i =0; $i < $iReciever; $i++){

		}*/

		/*$sSender = $aArgs[''];*/
		$sMsg 		=	$this->db->escape($aArgs['msg_body']);
		$sSubject	=	$this->db->escape($aArgs['msg_subject']);
		$sSender	=	$this->db->escape($this->AppUser->getUserId());
		$sReciever	=	$this->db->escape($aArgs['msg_recievers']);

		$sSql = "INSERT INTO library_user_message(lur_has_attachement,lur_msg_subject,lur_msg,lur_reciever_id,lur_sender_id) 
		VALUES('0',".$sSubject.",".$sMsg.",".$sReciever.",".$sSender.");";
		//echo  $sSql;
		$this->db->query($sSql);
		if(!$this->db->_error_number()){
			return '<div class="alert alert-success">Message sent. </div>';
		}else{
			return '<div class="alert alert-danger">Message was not sent. </div>';
		}

	}


	public function readMessage($aArgs  = array()){
		$user	=	$this->db->escape(trim($aArgs['user']));
		$msg 	=	(int)$aArgs['msg'];
		/*
			ways 
			1 	student to student
			2	staff to student
			3 	student to staff
		*/
		$sSql = "SELECT * FROM library_user_message lum  WHERE lum.lur_id = ".$msg." /*AND ( lum.lur_sender_id = ".$user." OR  lum.lur_sender_id = ".$user." ) */ LIMIT 1";
		$query = $this->db->query($sSql);
		//print_r($query);


		/*echo $sSql;
		die();*/
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			$this->db->where('lur_id' ,  $msg)->update('library_user_message',array('lur_msg_read'=>1) );
			return $result_array ;
		}
		return array();

	}
	

	public function mySent($iUser = '',$sField = ''){
			$iUser 	=	$this->db->escape($iUser);

		$sSql = "SELECT * FROM messanger_";
		$sSql	=	"SELECT lum.*, sbi.lu_full_name AS user FROM library_user_message lum LEFT JOIN library_users sbi ON lum.lur_reciever_id = sbi.lu_id   WHERE lum.lur_sender_id  = ".$iUser." ORDER BY lum.lur_id  DESC";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}



	public function getNewsAndEvents(){
	//	$this->db->query();

		$sSql	=	"SELECT * FROM library_news_events lne  WHERE lne.lne_show  = 1 ORDER BY lne.lne_date DESC LIMIT 10";
		$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();
	}

	public function messanger_pull_users(){
		$query =  $this->db->query("SELECT lou.*, sbi.lu_full_name AS username FROM library_online_users lou LEFT JOIN library_users sbi ON lou.lou_user_id = sbi.student_id ");
		//$query = $this->db->query($sSql);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array() ;
			return $result_array ;
		}


		return array();

	}


	public function getNewsAndEventsInfo($mID = '',$key = 'lne_id',$isActive = false){
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
		$sSql	=	"SELECT l.*, sbi.lu_full_name AS username FROM library_news_events l  LEFT JOIN library_users sbi ON l.lne_user = sbi.lu_id
			WHERE ".$isActive." l.".$key."= ".(($key == "lne_id")? (int)$mID : "'".$mID."'")."
			LIMIT 1";

			/*echo $sSql;
			die();*/
		$oRecList	=	 $this->db->query($sSql);
		//ECHO $oRecList->num_rows();
		if ($oRecList->num_rows() > 0)
		{
			$result_array = $oRecList->result_array() ;
			return $result_array ;
		}

		return array();
	}


	






}

?>