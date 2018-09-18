<?php


	//$__ElibraryMaxUploadSize =  '999999999M';
	@ini_set('memory_limit', '128M');
	@ini_set('post_max_size', __ElibraryMaxUploadSize().'M');
	@ini_set('upload_max_filesize', __ElibraryMaxUploadSize().'M');
	
	
	function  getUserImageLink($sImage = ''){

		return base_url('uploads/users/').'/'.$sImage;
	}
	function getSystemRootPath($sPath = ''){

		return base_url($sPath);
	}
	function elibrary_form_select_elementd(){

	}

	function search_in_array($srchvalue, $array)
	{
	    if (is_array($array) && count($array) > 0)
	    {
	        $foundkey = array_search($srchvalue, $array);
	        if ($foundkey === FALSE)
	        {
	            foreach ($array as $key => $value)
	            {
	                if (is_array($value) && count($value) > 0)
	                {
	                    $foundkey = search_in_array($srchvalue, $value);
	                    if ($foundkey != FALSE)
	                        return $foundkey;
	                }
	            }
	        }
	        else
	            return $foundkey;
	    }
	}


	function elibrary_hardcoded_array_find_deep($array, $search, $keys = array())
	{
	    foreach($array as $key => $value) {
	        if (is_array($value)) {
	            $sub = elibrary_hardcoded_array_find_deep($value, $search, array_merge($keys, array($key)));
	            if (count($sub)) {
	                return $sub;
	            }
	        } elseif ($value === $search) {
	            return array_merge($keys, array($key));
	        }
	    }

	    return array();
	}



	function multidimensional_array_search($search_value,$array) {
		$mached = array();
		if(is_array($array) && count($array) > 0) {
			foreach($array as $key => $value) {
				if(is_array($value) && count($value) > 0) {
					multidimensional_array_search($search_value,$value);
					} else {
					return array_search($search_value,$array); exit;
				}
			}
		}
	}


	function elibraryExcelCellsPositioning(){

		return array(

			//'lci_id'						=>		array('','A'),
			'lci_title'						=>		array('Title','B'),
			'lci_library_id'				=>		array('Location','C'),
			'lci_publisher'					=>		array('Publisher','D'),
			'lci_year_published'			=>		array('Year Published','E'),
			'lci_date_acquired'				=>		array('Date Aquired','F'),
			'lci_subject_id'				=>		array('Subjects','G'),
			'lci_note'						=>		array('Note','H'),
			//'lci_is__active'				=>		array('Enable Item','I'),
			'lci_description'				=>		array('Description','J'),
			'lci_author'					=>		array('Author(s)','K'),
			'lci_qty_remaining'				=>		array('Qty Remaining','L'),
			//'lci_snapshot'					=>		array('Image','M'),
			'lci_callnumber'				=>		array('Call Number','N'),
			'lci_category'					=>		array('Item Type','O'),
			//'lci_downloadable'				=>		array('Is Downloadable','P'),
			//'lci_download_link'				=>		array('Download Link','Q'),
			'lci_qty_acquired'				=>		array('Qty Acquired','R'),
			'lci_isbn'						=>		array('ISBN','S'),
			'lci_format'					=>		array('Item Format','I'),
			'lci_preliminary_page_no'		=>		array('Preliminary Page Number','T'),
			'lci_page_past_no'				=>		array('Last Page Number','U'),
			'lci_place_of_publish'			=>		array('Place of publication','V'),
			'lci_edition'					=>		array('Edition','W'),
			'lci_accession'					=>		array('Accession Number','X'),
			'lci_source'					=>		array('Source of acquisition','Y'),
			'lci_cost'						=>		array('Cost','Z'),

			 

			);
	}

	function elibraryArrayStripper($aData = array(), $mKey = ''){
		$aReturner 	=	 array();

		foreach ($aData as $key => $value) {
			 
			# code...
			if(isset($value[$mKey]) && strlen($value[$mKey]) > 0){
				$aReturner[] 	=	$value[$mKey];
			}
			  
		}

		return $aReturner;
	}



	function getElibraryExcellCellPosition($aData =  array() , $sPostion = '',  $key = 0, $index=0){
		if($sPostion  && isset($aData[$sPostion][$index])){
			if(!$index){
				return $aData[$sPostion][$index];
			}
			return $aData[$sPostion][$index].$key;
		}
		return '';//$sPostion.' - '.$index;
	}

	function getTableColumnNameFromExcelCell($aData =  array() , $sPostion = ''){

		foreach ($aData as $key => $value) {
			# code...
		}
	}

	function setInputValidation($oPHPExcelObject = null,$key='',$aData  = array(), $iStart = 2){

		if($key ==''){
			return ;
		}

		$sValues 	=	implode(',', $aData);
		//die($sValues);
		 
		$iTo =  1000 + $iStart;
		for($ja =$iStart; $ja <= $iTo; $ja++){ 
			$objValidation = $oPHPExcelObject->getActiveSheet()->getCell($key.$ja )->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list to avoid unwanted system behaviours.');
			$objValidation->setFormula1('"'.$sValues.'"');	// Make sure to put the list items between " and " if your list is simply a comma-separated list of values !!!

		}

	}


	//echo toMysqlDate( date('Y-m-d'));


	function elibrarycatalogueSearchAuthorsDisplay($aParam = array()){
		if( (!$iParamCount = count($aParam) ) OR !isset($aParam[0]['lcia_title']) ){
			return 'Unknown Author';
		}
		$sAuthorsToUse  	=		'';
		for($i = 0; $i <  $iParamCount ; $i++){
			$sAuthorsToUse 	.=	$aParam[$i]['lcia_title'].', ';
		}

		$sAuthorsToUse  	=	 substr($sAuthorsToUse , 0, strlen($sAuthorsToUse) - 2);

		return $sAuthorsToUse;


	}

	function makeSubjectNameOk($aVal 	=	 array()){
		$aVal 	=	 (array)$aVal;
		$iCounters 	=	count($aVal);
		$sWhatToDo  	=	'';
		 
		for($iI = 0; $iI < $iCounters; $iI++){
			$sWhatToDo 	.= $aVal[$iI]['lcis_title'].', ';
		}


		$sWhatToDo  	=	 substr($sWhatToDo , 0, strlen($sWhatToDo) - 2);

		return $sWhatToDo; 
	}

	function makeAuthorNameOk($aVal 	=	 array()){
		$aVal 	=	 (array)$aVal;
		$iCounters 	=	count($aVal);
		$sWhatToDo  	=	'';
		 

		for($iI = 0; $iI < $iCounters; $iI++){
			$sWhatToDo 	.= $aVal[$iI]['lcia_title'].', ';
		}


		$sWhatToDo  	=	 substr($sWhatToDo , 0, strlen($sWhatToDo) - 2);

		return $sWhatToDo; 
	}


	function elibrary_format_main_author_name_order($sSname = '', $order = 0){
		$aTmpName 	=	explode(' ', trim($sSname));
		//file_put_contents('filename.txt', count($aTmpName));
		//print_r($aTmpName);

	/*	foreach ($aTmpName as $key => $value) {
			if($aTmpName[$key] 	==	'' or is_null($aTmpName[$key])){
				unset($aTmpName[$key]);
			}
		}*/


		if($iLast = count($aTmpName) > 2){
			$sSname 	=	@$aTmpName[$iLast- 1].', '.@$aTmpName[0].' '.@$aTmpName[1];
		}else{
			//$sSname 	=	'';
			$sSname 	=	@$aTmpName[1].', '.@$aTmpName[0];
		}

		return $sSname;
	}

 




	function elibrarycatalogueSearchSubjectDisplay($aParam = array()){
		if( (!$iParamCount = count($aParam) ) OR !isset($aParam[0]['lcis_title']) ){
			return 'No Subject';
		}
		$sAuthorsToUse  	=		'';
		for($i = 0; $i <  $iParamCount ; $i++){
			$sAuthorsToUse 	.=	$aParam[$i]['lcis_title'].', ';
		}

		$sAuthorsToUse  	=	 substr($sAuthorsToUse , 0, strlen($sAuthorsToUse) - 2);

		return $sAuthorsToUse;


	}

	function elibrary_account_status_display($iStatus = 1){
		if($iStatus == 1){
			return 'Active';
		}else{
			return "Inactive";
		}
	}




	function active_status($iCode 	=	0){
		if($iCode == 1){
			return 'Yes';
		}else{
			return 'No';
		}
		//return array(array('id'=>'1','title'=>'Yes'),array('id'=>'0','title'=>'No'));
	}



	function __ElibraryMaxUploadSize(){
		return '9999999999999';
	}

	function elibrary_define_library_type($iCode = 0){

		if($iCode  < 1){
				return;
			}
			switch($iCode){
				case 1: {return 'Electronic'; break; }
				case 2: {return 'Physical'; break; }
				default :return 'Uknown';
			}

	}

 

	function elibrary_dashboard($sWhat = '',$bAll = false){
		$oDis 		=	& get_instance();
		//$oDis->load->model('elibrary/AppUser') ;
		 
		 
		$oDis->load->model('elibrary/ElibrarySystem') ;
		$sWhere = 'WHERE 1';
    	$sToday = $oDis->db->escape(date('Y-m-d', time()));
    	/*$sToday = (date('Y-m-d', time()));
    	echo $sToday;*/
    	//echo $sWhat;
    	$return 	=		0;
    	if($bAll){
    		switch($sWhat){
    			
    		case 'reservations': { $return 	= $oDis->ElibrarySystem->dashBoardReservedResources( );  break;}

    		case 'borrowed': { $return 	=  $oDis->ElibrarySystem->dashboardBorrowed( );  break;}

    		case 'returned': {$return 	=  $oDis->ElibrarySystem->dashboardBorrowed('WHERE lbci.lbci_returned =  1' );  break;}

    		case 'violation': {$return 	=  $oDis->ElibrarySystem->dashboardAdminOffenderViews( "WHERE lbci_offense > 0" );  break;}

    		//case 'reservations': { $oDis->ElibrarySystem->dashBoardReservedResources( 'WHERE lbr.lbr_date_reserved = date('.$sToday .')');  break;}
    		 

    		}

    	}else{
    		switch($sWhat){
    		case 'reservations': { $return 	=	$oDis->ElibrarySystem->dashBoardReservedResources( 'WHERE DATE(lbr.lbr_date_reserved) = DATE('.$sToday .')');  break;}

    		case 'borrowed': { $return 	=	 $oDis->ElibrarySystem->dashboardBorrowed('WHERE DATE(lbci.lbci_date) = DATE('.$sToday .')');  break;}

    		case 'returned': { $return 	=	 $oDis->ElibrarySystem->dashboardBorrowed('WHERE DATE(lbci.lbci_date_returned) = DATE('.$sToday .')  AND lbci.lbci_returned =  1');  break;}

    		case 'violation': { $return 	=	 $oDis->ElibrarySystem->dashboardAdminOffenderViews( 'WHERE lbci_offense > 0 AND ( DATE(lbci_date_returned) =  DATE('.$sToday .')  OR DATE(lbci_date_to_be_returned) =  DATE('.$sToday .') )');  break;}

    		//case 'reservations': { $oDis->ElibrarySystem->dashBoardReservedResources( 'WHERE lbr.lbr_date_reserved = date('.$sToday .')');  break;}

    		}

    	}

    	return $return;
    	 


	}

	function getLibrariesWithCatalogueNumber(){
		$oDis 		=	& get_instance();
		//$oDis->load->model('elibrary/AppUser') ;
		 
		 
		$oDis->load->model('elibrary/ElibrarySystem') ;

		return  $oDis->ElibrarySystem->getLibrariesWithCatalogueNumber( );
	}




	function elibrary_human_filesize($bytes =0 , $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
	}


	function rootAssetsLocation($sFileOrLocation = ''){
		return eLibraryRootUrl('assets/'.$sFileOrLocation);
	}

	function elibraryAssetsLocation($sFileOrLocation = ''){
		return eLibraryRootUrl('assets/elibrary/').$sFileOrLocation;
	}

	function generatePortalEndCatalogueImageLink($sImage = ''){
		if($sImage  == ''){
			return '#';
		}
		return base_url('uploads/elibrary/elibrary_catalog/img').'/'.$sImage;
	}

	function portalCatlogueSearchFields(){
		return array(
					/*array('id'=>'1','title'=>'ALL Fields'),*/
					array('id'=>'2','title'=>'Title'),
					array('id'=>'3','title'=>'Author'),
					array('id'=>'4','title'=>'Subject'),
					/*array('id'=>'5','title'=>'Call Number'),*/
					array('id'=>'6','title'=>'Publisher')
					);
	}
 


	function eLibrarytransalateCatalogueSearchType($sType = ''){
		if($sType == ''){
			return 'unknown';

		}

		switch($sType){
			case 'esearch':{return 'External Search'; break;}
			case 'bsearch':{return 'Basic Search'; break;}
			case 'asearch':{return 'Advanced Search'; break;}
			default : {return 'Unknown Search'; }
		}
	}

	function elibrary_catalogue_print_page($catalog = 0,$sStype=1){
		return elibraryAdminUrl('catalog/printer/'.$catalog.'/'.$sStype);
	}

	function generateElibraryCatalogueLink($iID = 0){
			if($iID  <  1){
				return '#';
			}
			//var_dump( $iID);
			//$dis 	=	 & get_instance();

		$dis = & get_instance();
		if($dis->AppUser->isUserTypeStaff() === true){
			return elibraryAdminUrl('catalogue/'.$iID);
		}

		return elibraryPortalUrl('catalogue/'.$iID);


			
			 
		}

		function generateElibraryReservationDetailsLink($iID = 0){
			if($iID  <  1){
				return '#';
			}
			//var_dump( $iID);
			//return elibraryPortalUrl('reservation/'.$iID);

			$dis = & get_instance();
		if($dis->AppUser->isUserTypeStaff() === true){
			return elibraryAdminUrl('reservation/'.$iID);
		}

		return elibraryPortalUrl('reservation/'.$iID);


			 
		}
/*echo md5(sha1('password'));
die();
*/

	function elibraryAdminUrl($sStr = ''){
		return base_url('elibrary/admin/'.$sStr).'/';
	}
	function send2login(){
		//die('where to?');
		header('location:'.authUrl());
	}

	function send2AdminPage(){
		redirect(elibraryAdminUrl());
		return false;
	}

	function authUrl($sStr = ''){
		//return 'http://localhost/public_html/portal/'.$sStr;
		return base_url($sStr);
	}

	function logoutUrl(){
		return '';
	}

	function portalMessageLinkGenerator($iKey = 0){
		return elibraryPortalUrl('messages/'.$iKey);
	}

	function adminMessageLinkGenerator($iKey = 0){
		return elibraryAdminUrl('messages/'.$iKey);
	}

	function elibraryPortalUrl($sStr = ''){
		return base_url('elibrary/portal/'.$sStr).'/';
	}
	function eLibraryRootUrl($slocation = ''){
		return base_url($slocation).'/';
	}

	function userRootUrl($sUrl = ''){

		$oCI =  get_instance();
		if($oCI->AppUser->isUserTypeStaff() === true){
			return elibraryAdminUrl($sUrl);
		}
		return elibraryPortalUrl($sUrl);
	}

	
	function totalbytesMeasurement($iVal = 0){
		return $iVal. ' MB';
	}

	function elibraryAdminCatalogPage($iKey = 0){
		return elibraryAdminUrl('catalog/view/'.$iKey);
	}



	function chanege2Optionr($data =array(), $select ='',$k ='', $v ='',$label='--SELECT --'){
		$data = (array)$data;
		
		$c =count($data);
		$sd = '';
		//if($c < 1){
			$sd .=   	'<option  selected ="selected"   value ="" >'.$label.'</option>';
		//	}
		for($i =0 ; $i < $c; $i++){
			$sel ='';
			if($data[$i][$k] ==$select ){
			$sel = 'selected ="selected"';
			}
			
		$sd .= '<option  '.$sel.'   value ="'.$data[$i][$k].'" >'.$data[$i][$v].' </option>';
			
			
		}
		
			$sd .= '';
			
			
			
			return $sd;
		
		}
	function elibrary_form_select_element($data =array(), $select ='',$k ='', $v ='',$label='--SELECT --',$mSelectValue = '',$bEnableSelect =true){
		$data = (array)$data;
		
		$c =count($data);
		$sd = '';
		if($bEnableSelect){
			$sd .=   	'<option  selected ="selected"   value ="'.$mSelectValue .'" >'.$label.'</option>';
		}
		
	
		for($i =0 ; $i < $c; $i++){
			if(!is_array($data[$i][$k])){
			//	echo 'na array';
			$sel ='';
					if($data[$i][$k] ==$select ){
					$sel = 'selected ="selected"';
					}		
					$sd .= '<option  '.$sel.'   value ="'.$data[$i][$k].'" >'.$data[$i][$v].' </option>';
					
			}else{
				for($j =0 ; $j < $c; $j++){
					$data =$data[$i][$k];
				$sel ='';
					if($data[$j][$k] ==$select ){
					$sel = 'selected ="selected"';
					}		
					$sd .= '<option  '.$sel.'   value ="'.$data[$j][$k].'" >'.$data[$j][$v].' </option>';
						}				
			}
		}
			$sd .= '';
			return $sd;
	}

		function reservationStatus(){
			return array(
				array('id'=>'0','title'=>'Pending'),
				array('id'=>'1','title'=>'Disapproved'),
				array('id'=>'2','title'=>'Approved')
				 
				);
		}

		function account_acti_status(){
			return array(
				array('id'=>'0','title'=>'Account Disabled'),
				array('id'=>'1','title'=>'Account Enabled')
			 
				 
				);
		}

		function lu_acc_type(){
			return array(
				array('id'=>'1','title'=>'General User'),
				array('id'=>'2','title'=>'Staff'),
				array('id'=>'3','title'=>'Administrator')
			 
				 
				);
		}

		function lu_acc_type_display($iType = 0){
			//die($iType);
			switch($iType){
				case '1' : { return 'General User'; break ;}
				case '2' : { return 'Staff'; break ;}
				case '3' : { return 'Administrator'; break ;}
				default : { return 'Unknown Account Type';}
			}
		}	


		



		//echo getElibraryUserFileUploadDir();

		function   getElibraryUserFileUploadDir(){
			return './uploads/elibrary/__elibrary_uploads';
			return  realpath('./uploads/elibrary/__elibrary_uploads').DIRECTORY_SEPARATOR;
		}

		function getElibraryCatalogScreenshotFileUploadDir(){
			//return getElibraryUserFileUploadDir();
			return './uploads/elibrary/elibrary_catalog/img/';
			return realpath('./uploads/elibrary/elibrary_catalog/img/').DIRECTORY_SEPARATOR;
		}

		function getElibraryDownloadableFileUploadDir(){
			//return getElibraryUserFileUploadDir();
			return './uploads/elibrary/elibrary_catalog/dlf/';
			return realpath('./uploads/elibrary/elibrary_catalog/dlf/').DIRECTORY_SEPARATOR;
		}
		function elibraryGeneratePortalCatalogueDownloadLink($iItem = 0){
			return elibraryPortalUrl('catalogue/download/'.$iItem);
		}

		function toMysqlDate($sDate=''){
			/*$sDate  = date('h:i a jS M Y',strtotime($sDate));*/
			//$sMake 	=	  ( strtotime($sDate) +   strtotime( date('H:i:s',time()) ) ) ;
			$sMake  =		$sDate;
			///echo  $sMake;

			$sMake	=	strtotime($sMake);
			$sDate  = date('Y-m-d H:i:s',$sMake );
			//echo  var_dump($sDate);
			return $sDate;
		}

		function studentFileDownloadLink($iID){
			if(!$iID){
				return;
			}

			return elibraryPortalUrl('my_files/download/'.$iID);

		}



		function elibrary_return_reservation_status_display($iCode = 0){
			 
			switch($iCode){
				case 0: {return '<span class="label label-primary">Pending</span>'; break; }
				case 1: {return '<span class="label label-danger">Disapproved</span>'; break; }
				case 2: {return '<span class="label label-success">Approved</span>'; break; }
				default :return '<span class="label label-warning">Unknown</span>';
			}
		}



		function borrowStatus(){
			return array(
				array('id'=>'0','title'=>'Not Returned'),
				array('id'=>'1','title'=>'Returned'),
				/*array('id'=>'2','title'=>'Cleared')*/
				 
				);
		}

		function format_date($date = null){
			return $date;
		}


		function elibrary_return_borrow_status_display($iCode = 0){
			 
			switch($iCode){
				case 0: {return '<span class="label label-warning">Not Returned</span>'; break; }
				case 1: {return '<span class="label label-success">Returned</span>'; break; }
				/*case 2: {return '<span class="label label-success">Cleared</span>'; break; }*/
				default :return '<span class="label label-danger">Unknown</span>';
			}
		}

		function newsStatus(){
			return array(
				array('id'=>'0','title'=>'Not Showing'),
				array('id'=>'1','title'=>'Showing'),
				 
				 
				);
		}


		function elibrary_return_news_status_display($iCode = 0){
			 
			switch($iCode){
				case 0: {return '<span class="label label-danger">Not Showing</span>'; break; }
				case 1: {return '<span class="label label-success">Showing</span>'; break; }
				 
				default :return '<span class="label label-warning">Unknown</span>';
			}
		}


		function transalate_recommendation_status($iCode = 0){
		switch($iCode){
			case 1:{ return '<span class= "label label-info ">Waiting Response</span>'; break;}
			case 2:{ return '<span class= "label label-success ">Responded</span>'; break;}
			default: { return '';}
		}
	}
	function transalate_recommendation_status_admin($iCode = 0){
		switch($iCode){
			case 1:{ return '<span class= "label label-danger ">New</span>'; break;}
			case 2:{ return '<span class= "label label-success ">Attended to</span>'; break;}
			default: { return '';}
		}
	}








		function elibrary_toNumber($iNumber = 0){
			return number_format($iNumber);
		}

		function elibrary_return_recommended_resource_status_display($iCode = 0){
			 
			switch($iCode){
				case 1: {return '<span class="label label-primary">Pending</span>'; break; }
				case 2: {return '<span class="label label-danger">Pending</span>'; break; }
				case 3: {return '<span class="label label-success">Approved</span>'; break; }
				default :return '<span class="label label-warning">Pending</span>';
			}
		}

		function elibrary_getFIleMime($sSrc =''){
			$finfo 		= finfo_open(FILEINFO_MIME_TYPE);
			$result 	= finfo_file($finfo, $sSrc);
			finfo_close($finfo);
			return $result;
		}

		function generateNeameForUpload($sValidName = ''){
			return $sValidName;
		}

		 


		function __elibraryCutString(){

			/*echo strlen($string) >= 500 ? 
			substr($string, 0, 490) . ' <a href="link/to/the/entire/text.htm">[Read more]</a>' : 
			$string;*/
			$string = strip_tags($string);

			if (strlen($string) > 500) {

			    // truncate string
			    $stringCut = substr($string, 0, 500);

			    // make sure it ends in a word so assassinate doesn't become ass...
			    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>'; 
			}
			echo $string;
		}

		function __elibraryCutWords(){


			$num_words = 101;
			$words = array();
			$words = explode(" ", $original_string, $num_words);
			$shown_string = "";

			if(count($words) == 101){
			   $words[100] = " ... ";
			}

			$shown_string = implode(" ", $words);
		}


		function studentBorrowViolationStatus($iCode = 0){
			switch($iCode){
				case 1: {return '<span class="label label-primary">Cleared</span>'; break; }
				case 2: {return '<span class="label label-danger">Pending</span>'; break; }
				case 3: {return '<span class="label label-success">Approved</span>'; break; }
				default :return '<span class="label label-warning">Not Cleared</span>';
			}
		}


		function __elibrary_split_words($string, $nb_caracs, $separator){
		    $string = strip_tags(html_entity_decode($string));
		    if( strlen($string) <= $nb_caracs ){
		        $final_string = $string;
		    } else {
		        $final_string = "";
		        $words = explode(" ", $string);
		        foreach( $words as $value ){
		            if( strlen($final_string . " " . $value) < $nb_caracs ){
		                if( !empty($final_string) ) $final_string .= " ";
		                $final_string .= $value;
		            } else {
		                break;
		            }
		        }
		        $final_string .= $separator;
		    }
		    return $final_string;
		}

		function myTruncate($string = '', $limit = 300, $break=".", $pad="...") { 
		// return with no change if string is shorter than $limit 
			if(strlen($string) <= $limit) return $string; // is $break present between $limit and the end of the string? 
				if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			 		if($breakpoint < strlen($string) - 1) {
			 		 $string = substr($string, 0, $breakpoint) . $pad; 
				} 
			} return $string;
		}

		function restoreTags($input) { 
			$opened = array(); 
		// loop through opened and closed tags in order 
			if(preg_match_all("/<(\/?[a-z]+)>?/i", $input, $matches)) { 
				foreach($matches[1] as $tag) { 
					if(preg_match("/^[a-z]+$/i", $tag, $regs)) {
					 // a tag has been opened 
					 	if(strtolower($regs[0]) != 'br') 
					 		$opened[] = $regs[0]; 
					 	} elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs)) { 
					 		// a tag has been closed 
					 		unset($opened[array_pop(array_keys($opened, $regs[1]))]); 
					 		} 
					 		} 
					 		} // close tags that are still open 
					 		if($opened) {
					 		 $tagstoclose = array_reverse($opened); 
					 			foreach($tagstoclose as $tag) $input .= "</$tag>"; 
					 } return $input; 

		}





		
?>