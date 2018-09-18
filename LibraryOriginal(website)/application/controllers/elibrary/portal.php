<?php
class Portal extends CI_Controller {
	private $sRootDir		=	'';
	public function __construct()
    {

        parent::__construct();
        $this->load_core_libs_and_models();
	  
        $this->sRootDir = eLibraryRootUrl();
        $this->load->helper('url');

        //print_r($this->AppUser->getUserId());
         if($this->input->is_ajax_request()){
        	ob_start();
        }
        //die('here');
        //$this->output->enable_profiler(TRUE);
        $this->AppUser->initialize('student');
		//$this->AppUser->validateAccess('eLibrary');
  
        // PLEASE DONT TAMPER WITH UNLESS YOU HAVE AN ALTERNATIVE SOLUTION.
		/*@ini_set('memory_limit', '128M');
		@ini_set('post_max_size', __ElibraryMaxUploadSize().'M');
		@ini_set('upload_max_filesize', __ElibraryMaxUploadSize().'M');

		echo ini_get('post_max_size');*/
    }



    public function myprofile(){
		$aParam['sBodyContentTemplate'] 				= 		"elibrary/common/profile_update";
		$aParam['temp_title']							=		'My Profile ';					 
		$aParam['sBodyTitle']							=		"Account Manager";
		$aParam2 	= 		$this->AppUser->getUserDataOnlyByKey(array('lu_id'=>$this->AppUser->getUserId()));
 

		if($this->input->post('save_account')){

				$aMyprofileValidation = array(
	               array(
	                     'field'   => 'lu_full_name', 
	                     'label'   => 'Full Name', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'lu_email', 
	                     'label'   => 'Email', 
	                     'rules'   => 'required'
	                  ), 
	               /*array(
	                     'field'   => 'lu_acc_type', 
	                     'label'   => 'Account Type', 
	                     'rules'   => 'required'
	                  ),*/ 
	               array(
	                     'field'   => 'lu_phn', 
	                     'label'   => 'Phone Number', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'lu_pwd', 
	                     'label'   => 'Password', 
	                     'rules'   => 'required'
	                  ) 



            	);
		 
			  	$this->form_validation->set_rules($aMyprofileValidation);
			  	if($this->form_validation->run()){ 
			  		$aParam['errors'] 	=	 	array();
			  		$aFields 			=  		array();
			  		$aWhere 			=	 	array();
					//print_r($_REQUEST);
					$aDataPassed  		=	 	array(); 				
					$aDataPassed  		=	 	$this->input->post(null,true);
					$aFields 			=	  	array(
												'lu_full_name'=> $aDataPassed['lu_full_name'], 
												'lu_email'=> $aDataPassed['lu_email'], 
												/*'lu_acc_type'=> $aDataPassed['lu_acc_type'],
												'lu_acc_status'=>  $aDataPassed['lu_acc_status'],*/
												'lu_phn'=> $aDataPassed['lu_phn']/*, 
												'lu_pwd'=>md5($aDataPassed['lu_pwd']) */
												);
					/*	echo '<pre>';
					print_r($_FILES);
					die();*/

					if(md5($aDataPassed['lu_pwd']) !==$aParam2['lu_pwd'] ){
						$aParam['errors'][] 		=	'Your password could not be authenticated.';

						return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) ); 
					}

					/*print_r($_FILES['passport']);
					die();*/
					if(isset($_FILES['passport']['name']) && strlen($_FILES['passport']['name'])){

						$config['upload_path'] 		= 	$this->config->item('upload_path');
						$config['allowed_types'] 	=  	$this->config->item('allowed_types');
						/*$config['max_size']     	=  	$this->config->item('max_size');
						$config['max_width'] 		=  	$this->config->item('max_width');
						$config['max_height'] 		=  	$this->config->item('max_height');*/
						$config['encrypt_name'] 	=  	$this->config->item('encrypt_name');
						 
						$this->load->library('upload', $config);
						if($this->upload->do_upload('passport')){
							$aReturnedData 	=	$this->upload->data(); 
							$aFields['passport']  	=	$aReturnedData['file_name'];
							 
						}else{
							$aParam['errors'][] 		=	'Error occured while uploading your passport.';
						}
						
					} 


				 
					$aSimilar 	=	 $this->AppUser->getUserDataOnlyByKey(array('lu_email'=> $aDataPassed['lu_email']));
					/*print_r($aSimilar);
					die();*/
					if(count($aSimilar)  && ( $aSimilar['lu_id'] !==$aParam2['lu_id'] ) ){
						$aParam['errors'][]				=	'A similar record was found, kindly check your email and try again';
					}


					 

					if(!count($aParam['errors'])){
						// Send the request to the model for final processing
						if($this->AppUser->updateProfile($aFields,$aDataPassed['lu_id'])  ){
							//$aFields['lu_pwd']
							//$this->session->set_userdata($aFields);
							$aParam['sSuccess']	 	=	'Record has been saved successfully!';
						}
					}
					 

			  		
			  	}else{
			  		$aParam['errors'][]	  	=	  validation_errors();
			  	}
			 
			 
		}

		if($this->input->post('update_pwd')){

			$aMyprofileValidation = array(
	               array(
	                     'field'   => 'lu_pwd3', 
	                     'label'   => 'Verify Password', 
	                     'rules'   => 'required'
	                  ), 
	               array(
	                     'field'   => 'lu_pwd2', 
	                     'label'   => 'New Password', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'lu_pwd1', 
	                     'label'   => 'Current Password', 
	                     'rules'   => 'required'
	                  ) 



            	);
		 
			  	$this->form_validation->set_rules($aMyprofileValidation);
			  	if(!$this->form_validation->run()){ 
			  		$aParam['errors2'][] 	=	 validation_errors();;
					return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) );
			  	}


			$aDataPassed  		=	 	array(); 				
			$aDataPassed  		=	 	$this->input->post(null,true);

			if(md5($aDataPassed['lu_pwd1']) !== $aParam2['lu_pwd']){
				$aParam['errors2'][] 	=	'Your password could not be authenticated.';
				return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) );
			}else


			if(md5($aDataPassed['lu_pwd1']) !== $aParam2['lu_pwd']){
				$aParam['errors2'][] 	=	'Your password could not be authenticated.';
				return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) );
			}else if( md5($aDataPassed['lu_pwd3']) !== md5($aDataPassed['lu_pwd2']) ){
				$aParam['errors2'][] 	=	'Your passwords do not match.';
				return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) );
			}else{

				$aFields 	=	array('lu_id'=> $aParam2['lu_id'] , 'lu_pwd'=>md5($aDataPassed['lu_pwd2']) );
				$this->AppUser->updateMyPassword($aFields);
				$aParam['sSuccess2'] 		=	'Your password has been updated successfully.';
			}

			 
		}



		return $this->_bodyContentBuilder(array_merge($aParam,$aParam2  ) ); 
	}





    public function recommend(){
		//$this->AppUser->validateAccess('elibrary_admin');
		$aArgs = func_get_args();
	

		$this->load->model('elibrary/admin/ElibrarySystem') ;

		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'now'){
			//	$this->AppUser->validateAccess('elibrary_admin_borrowed_create');
				if(isset($aArgs[1]) && $aArgs[1] > 0){
					$aResult 	=	$this->ElibrarySystem->getUserSentRecommendationDetails($aArgs[1] );
					if(!count($aResult)){
					show_404();
					}

					$aParam['mPreparedContent'] 		=	$aResult;

				}
			/*
				echo '<pre>';

				print_r($aResult);
				echo '</pre>';*/

				
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/portal/recommendation_creator";
				$aParam['temp_title']				=	"My Recommended Library Resources";

				$aParam['sBodyTitle']				=	"My Library";

				$this->_bodyContentBuilder($aParam);

				return ;
			} 
		}


		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/myrecommndation";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		 
		$aParam['temp_title']				=	"My Recommendation";
		$aParam['sBodyTitle']				=	"My Library";
		$this->_bodyContentBuilder($aParam);

}

    public function guide(){
		$aParam['sBodyContentTemplate'] 	=  	"elibrary/templates/guide";		 
		$aParam['temp_title']				=	"Guide";
		$aParam['sBodyTitle']				=	$this->config->item('system.shortcode');	
		//$aParam['mPreparedContent'] 		=	$aResult;
		$this->_bodyContentBuilder($aParam);
	}

	
	
	public function index($param = ""){
		//base_url() = $this->config->item('base_url') ;
		
		/*$view_to_load = "elibrary/portal/bsearch_temp";
		$this->main_access_control(base_url(), $view_to_load);*/
		//parse_str($_SERVER['QUERY_STRING'],$_GET);
	//	$this->AppUser->validateAccess('eLibrary_portal_dashboard');
		$aParam['sBodyContentTemplate'] 	= 	"elibrary/portal/news_events";
		$aParam['temp_title']				=	"Home ";
		$aParam['sBodyTitle']				=	$this->config->item('system.shortcode'); 
		$this->_bodyContentBuilder($aParam);
		
	}

/*	 public function guide(){
		$aParam['sBodyContentTemplate'] 	=  	"elibrary/portal/guide";		 
		$aParam['temp_title']				=	"Guide";
		$aParam['sBodyTitle']				=	"isoLibrary";		
		//$aParam['mPreparedContent'] 		=	$aResult;
		$this->_bodyContentBuilder($aParam);
	}*/
 


	public function news_events(){
		$aArgs = func_get_args();


		if(count($aArgs) || ($this->uri->segment(4) && $this->uri->segment(4) > 0 )){
			//$this->AppUser->validateAccess('eLibrary_portal_view_news_events');
			$aRecInfo = $this->MyLibrary->getNewsAndEventsInfo((int)$this->uri->segment(4));
			$aRecInfo = isset($aRecInfo[0])?$aRecInfo[0] : $aRecInfo;
			//print_r($aRecInfo);
			if(count($aRecInfo) ){
				//global $aRecInfo;
				$aParam['mPreparedContent']	        =		$aRecInfo ;
				$aParam['sBodyContentTemplate'] 	= "elibrary/portal/news_details";
				$aParam['temp_title']				=	"<i>".ucfirst($aRecInfo['lne_subject'])."</i>";
				$aParam['sBodyTitle']				=	" News &amp; Events ";
				return $this->_bodyContentBuilder($aParam); 
			}
			return show_404(current_url());

		}else if($this->uri->segment(4) && $this->uri->segment(4) == 'news_pull' ){
			 
		}

		//$this->AppUser->validateAccess('eLibrary_portal_news_events_records');	
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/news_events";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Latest";
		$aParam['sBodyTitle']				=	"News &amp; Events";
		$this->_bodyContentBuilder($aParam);
	}






	public function catalogue(){
		$aArgs = func_get_args();
		if(!count($aArgs)){
			return $this->bsearch();
		}
		
		//echo $this->uri->segment(4);
		//$this->uri->segment(4) = (int)$this->uri->segment(4);
		//print_r($this->MyLibrary->getCatalogueInfo((int)$this->uri->segment(4)));


		$aRecInfo = $this->MyLibrary->getCatalogueInfo((int)$this->uri->segment(4));
		//$this->AppUser->validateAccess('eLibrary_portal_view_catalogue');
		$aRecInfo = isset($aRecInfo[0])?$aRecInfo[0] : $aRecInfo;
		//print_r($aRecInfo);
		if(count($aRecInfo) ){
			//global $aRecInfo;
			$aParam['mPreparedContent']['search_result']	 =		$aRecInfo ;
			$aParam['sBodyContentTemplate'] 	= "elibrary/portal/catalogueItemDetails";
			$aParam['temp_title']				=	"<i>".ucfirst($aRecInfo['lci_title'])."</i>"; 
			$aParam['sBodyTitle']				=	"Catalogue";
			return $this->_bodyContentBuilder($aParam); 
		}


		 if( ((isset($aArgs[0]) && $aArgs[0] == 'download') && (isset($aArgs[1])) ) || ( ($this->uri->segment(4) ) && ($this->uri->segment(4) =='delf') ) ){
				//$aData['lib_id'] 	=	(int)$aArgs[1];
				//$iUser = $this->AppUser->getUserId();
		 	//	$this->AppUser->validateAccess('eLibrary_portal_catalogue_download');
				$iFile = (int)$this->uri->segment(5);
				$aReturn = $this->MyLibrary->getCatalogueFileForDownload(array( 'iFileID'=>$iFile) ) ;
				
				$aReturn	=	isset($aReturn[0]) ?$aReturn[0]: $aReturn;

				
				if(!count($aReturn) or empty($aReturn)){
					show_404();
					return ; 
				}
				$sFile = (getElibraryDownloadableFileUploadDir().$aReturn['lci_download_link']);
				/*var_dump($sFile);
				//print_r($aReturn);
				die();*/
				if(!file_exists($sFile)){

					show_404();
					return ; 
				}
				$this->load->helper('download');
				$data = file_get_contents($sFile); // Read the file's contents
				//print_r($data);
				force_download($aReturn['lci_download_link'], $data); 
				//return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
				return;
			}


		return show_404(current_url());

	
	}


	public function su(){

		/*	echo json_encode(['error'=>$_REQUEST]);
		return;*/
		/*if($this->input->is_ajax()){

		}*/

					// upload.php
			// 'images' refers to your file input name attribute
			if (empty($_FILES['userFileUploader'])) {
			    echo json_encode( array('error'=>'No files found for upload.') );
			    // or you can throw an exception
			    return; // terminate
			}
			 
			// get the files posted
			$images = $_FILES['userFileUploader'];
			 
			// get user id posted
			$userid = $this->AppUser->getUserId();
			 
			// get user name posted
			//$username = empty($_POST['username']) ? '' : $_POST['username'];
			 
			// a flag to see if everything is ok
			$success = null;
			 
			// file paths to store
			$paths= array();
			 
			// get file names
			$filenames = $images['name'];
			 
			// loop and process files
			$iTotalFiles 		=		count($filenames);
			for($i=0; $i < $iTotalFiles; $i++){
			    $ext = explode('.', basename($filenames[$i]));
			    $target = getElibraryUserFileUploadDir() . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
			    $aToPass 		=		array('user'=>$this->AppUser->getUserId(),'path'=>$target,'title'=>$images['name'][$i],'size'=>$images['size'][$i]) ;
			    if(move_uploaded_file($images['tmp_name'][$i], $target) && $this->MyLibrary->saveFileToDB($aToPass )) {
			        $success = true;
			        $paths[] = $target;
			    } else {
			        $success = false;
			        break;
			    }
			}
			 
			// check and process based on successful status
			if ($success === true) {
			    // call the function to save all data to database
			    // code for the following function `save_data` is not
			    // mentioned in this example
			    //save_data($userid, $username, $paths);
			 	
			    // store a successful response (default at least an empty array). You
			    // could return any additional response info you need to the plugin for
			    // advanced implementations.
			    $output = array();
			    // for example you can get the list of files uploaded this way
			    // $output = ['uploaded' => $paths];
			} elseif ($success === false) {
			    $output = array('error'=>'Error while uploading images. Contact the system administrator'.$i);
			    /*// delete any uploaded files
			    foreach ($paths as $file) {
			        unlink($file);
			    }*/
			} else {
			    $output = array('error'=>'No files were processed.');
			}
			 
			// return a json encoded response for plugin to process successfully
			echo json_encode($output);



		/*echo json_encode($_SERVER);
		return;
		print_r(8698979798798798);*/
		
		//$this->MyLibrary->saveFileToDB();

	}



	public function my_files(){
		$aArgs = func_get_args();
		// print_r(((isset($aArgs[0]) && $aArgs[0] == 'delf') && (isset($aArgs[1])) ) );
		/*print_r($this->uri->segment(3));
		die();*/
		if(count($aArgs) || ($this->uri->segment(4))){
			if((isset($aArgs[0]) && $aArgs[0] == 'upload') || ($this->uri->segment(4) =='upload')){
			//	$this->AppUser->validateAccess('eLibrary_portal_myfiles_upload');
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/portal/userFileUploadForm";
				$aParam['temp_title']				=	"My private Files - Files Upload";
				$aParam['sBodyTitle']				=	"My Library";
				$this->_bodyContentBuilder($aParam);

				return ;
			}else if( ((isset($aArgs[0]) && $aArgs[0] == 'delf') && (isset($aArgs[1])) ) || ( ($this->uri->segment(4) ) && ($this->uri->segment(4) =='delf') ) ){
				 
				$iUser 				= $this->AppUser->getUserId();
				$iFile 				= (int)$this->input->post('file_key');
				$mReturn = $this->MyLibrary->deleteFromMyFiles($iUser, $iFile);

				if($mReturn){
					die('<div class="alert alert-success">Your request has been processed successfully.</div>');
				}else{
					die('<div class="alert alert-warning">Your request could not be processed.</div>');
				}
				//return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
				return false;
			}

			else if( ((isset($aArgs[0]) && $aArgs[0] == 'download') && (isset($aArgs[1])) ) || ( ($this->uri->segment(4) ) && ($this->uri->segment(4) =='delf') ) ){
				//$this->AppUser->validateAccess('eLibrary_portal_myfiles_download');
				$aData['lib_id'] 	=	(int)$aArgs[1];
				$iUser = $this->AppUser->getUserId();
				$iFile = (int)$this->uri->segment(5);
				$aReturn = $this->MyLibrary->getFileForDownload(array('iStudentID'=>$iUser, 'iFileID'=>$iFile) ) ;
				
				$aReturn	=	isset($aReturn[0]) ?$aReturn[0]: $aReturn;

				//print_r($aReturn);
				//die();
				if(!count($aReturn) or empty($aReturn)){
					show_404();
					return ; 
				}

				if(!file_exists($aReturn['luu_location'])){

					show_404();
					return ; 
				}
				$this->load->helper('download');
				$data = file_get_contents($aReturn['luu_location']); // Read the file's contents
				//print_r($data);
				force_download($aReturn['luu_title'], $data); 
				//return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
				return;
			}

		}

		//$this->AppUser->validateAccess('eLibrary_portal_myfiles_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/myFiles";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"My private Files";
		$aParam['sBodyTitle']				=	"My Library";
		$this->_bodyContentBuilder($aParam);

	}

	public function pp(){

	}
	
	public function my_shelve($aArgs = array()){
		 
		if(count($aArgs) || ($this->uri->segment(4))){
			if((isset($aArgs[0]) && $aArgs[0] == 'add') || ($this->uri->segment(4) =='add')){
				//$this->AppUser->validateAccess('eLibrary_portal_myshelve_add_item');
				$iUser 		=	$this->AppUser->getUserId();
				$iFolder	=	(int)$this->input->post('recieving_shelf');
				$iFile 		=	$this->input->post('add2ShelveHiddenKey');
				$iMoveFrom	=	(int)$this->input->post('fromShelveHiddenKey');

				if($iMoveFrom){
					echo  $this->MyLibrary->moveToShelfItem($iUser,$iFile,$iFolder,$iMoveFrom);
				}else{
					echo  $this->MyLibrary->saveToShelfItem($iUser,$iFile,$iFolder,$iMoveFrom);
				}
 				
				die();
			}else if(   ($this->uri->segment(4) =='refresh') ) {
				//$this->AppUser->validateAccess('eLibrary_portal_myshelve_refresh');
				$iUser = $this->AppUser->getUserId();  
				$mReturn = $this->MyLibrary->getShelves($iUser);

				$sReturn = ' <select name="recieving_shelf" id="recieving_shelf" class="form-control col-lg-12 chzn-select">
                
                       
                          '.elibrary_form_select_element($mReturn,"" ,"lufl_id","lufl_title","--Select Folder --" ).'
                      
                      </select> ';
			 

				echo $sReturn;
				die();
				 
			}

			else if(   ($this->uri->segment(4) =='create') ) {
				//$this->AppUser->validateAccess('eLibrary_portal_myshelve_create');
				if($this->input->get_post('shelfTitle')){
 					$data['shelfKey']				=		$this->input->get_post('shelfKey',true);
					$data['shelfTitle']				=		$this->input->get_post('shelfTitle',true);
					$data['iStudentID']  			=		$this->AppUser->getUserId();
					$mResponse 						=		$this->MyLibrary->saveShelves($data);

					

					if($mResponse ==true){
						echo '<div class="alert alert-success"> Record Saved successfully.</div>';
						exit();
					}else{
						echo '<div class="alert alert-danger">Error occured while processing.</div>';
						exit();
					}

				}else{
					echo '<div class="alert alert-danger">Invalid Request detected</div>';
					exit();
					 
				}
			}




		}
		echo show_404(current_url());
		

		
		
		 
	}	


	public function shistory(){
		$aArgs = func_get_args();
		//$this->AppUser->validateAccess('eLibrary_portal_search_history');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/search_history";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"My previous search";
		$aParam['sBodyTitle']				=	"OPAC Search";
		$this->_bodyContentBuilder($aParam);

	}

	public function reservation(){

		$aArgs = func_get_args();
		//var_dump($this->uri->segment(4));
		//print_r($this->input->get_post(null,true));
		/*var_dump($this->input->post(null,true));
		die();*/
		if(count($aArgs) || ($this->uri->segment(4))){
			if(  (isset($aArgs[0]) && $aArgs[0] == 'add') || ($this->uri->segment(4) =='add') ){
				//$this->AppUser->validateAccess('eLibrary_portal_reservation_create');
				if($this->input->get_post('itemID') < 1){
					die(  '<div class="alert alert-danger"> The item in question could not be detected.</div>');
					;
				}
				$aForQuery 							=			$this->input->post(null,true);
				$aForQuery['iStudentID']			=			$this->AppUser->getUserId();
				if(strlen($aForQuery['iStudentID']) < 1){
					echo  '<div class="alert alert-danger">Please refresh this page to continue</div>';
					die();
				}
				$bResult 							=			$this->MyLibrary->addToReservation($aForQuery);
				if($bResult){
					echo  '<div class="alert alert-success"> Your request has been processed. Please wait for approval </div>';
					die();
				}
				echo  '<div class="alert alert-danger"> Your request could not be processed. Please try again later </div>';
				die();
				
			}else if(  (isset($aArgs[0]) && $aArgs[0] == 'delete') || ($this->uri->segment(4) =='delete') ){
				//print_r($_REQUEST);
				//$this->AppUser->validateAccess('eLibrary_portal_reservation_delete');
				if($this->input->get_post('reservationID') < 1){
					echo  '<div class="alert alert-danger"> The item in question could not be detected.</div>';
					die();
				}
				$aForQuery['reservationID']			=			(int)$this->input->get_post('reservationID',true);
				//print_r($aForQuery);
				$aForQuery['iStudentID']			=			$this->AppUser->getUserId();
				if(strlen($aForQuery['iStudentID']) < 1){
					echo  '<div class="alert alert-danger">Please refresh this page to continue</div>';
					return;
				}
				$bResult 							=			$this->MyLibrary->deleteFromReservation($aForQuery);
				if($bResult){
					echo  '<div class="alert alert-success"> Your request has been processed.   </div>';
					return;
				}
				echo  '<div class="alert alert-danger"> Your request could not be processed. Please try again later </div>';
				return;
				
				
			}else if($this->uri->segment(4) > 0){
			//	$this->AppUser->validateAccess('eLibrary_portal_reservation_view');
				$aForQuery 							=			$this->input->get_post(null,true);
				$aForQuery['iStudentID']			=			$this->AppUser->getUserId();
				$aForQuery['iReservationID']		=			(int)$this->uri->segment(4);

				if(strlen($aForQuery['iStudentID']) < 1){
					redirect(base_url());
					echo  '<div class="alert alert-danger">Please refresh this page to continue</div>';
					return;
				}

				$aRecInfo = $this->MyLibrary->myBookedReservationsDetails($aForQuery);
				$aRecInfo = isset($aRecInfo[0])?$aRecInfo[0] : $aRecInfo;
				//print_r($aRecInfo);
				if(count($aRecInfo) ){
					//global $aRecInfo;
					$aParam['mPreparedContent']['search_result']	 =		$aRecInfo ;
					$aParam['sBodyContentTemplate'] 	= 			"elibrary/portal/reservationItemDetails";
					$aParam['temp_title']				=			 'Reservation details :: '.$aRecInfo['lci_title'];
					$aParam['sBodyTitle']				=			"My Library";
					return $this->_bodyContentBuilder($aParam); 
				}
				return show_404(current_url());
			}
		}	
		
		//$this->AppUser->validateAccess('eLibrary_portal_reservation_record');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/bookReservationRecordList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Book Reservation";
		$aParam['sBodyTitle']				=	"My Library";
		$this->_bodyContentBuilder($aParam);
	}


	public function cancelMyReservation(){

	}

	public function my_library(){

	}

	public function loanHistory(){

	}
	public function rtt(){

	}

	public function pr(){

	}

	public function bsearch(){

		$args = func_get_args();
		 			/*echo '<pre>' ;
                    print_r($args);
                    echo '</pre>' ;*/

		if(count($this->input->get_post()) && ($this->input->get_post('bsearch_field') > 0) && $this->input->get_post('bkeyword') != ""){
			//$this->AppUser->validateAccess('eLibrary_portal_search_bsearch_result');
			$aSaveToSearchHistory						=		$this->input->get_post(null,true);
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('bkeyword',true);
			$aSaveToSearchHistory['search_type']		=		'bsearch';
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('bkeyword',true);
			$this->MyLibrary->saveToSearchHistory($aSaveToSearchHistory);
			
			$sTable = '';
			$sJoin 	=	'';
			switch($iField = (int)$this->input->get_post('bsearch_field')){
				case 2:	{$sTable = 'lci.lci_title';	break;} # Title
				case 3:	{$sTable = 'lcia.lcia_title';

						$sJoin  =	 '  JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
					break;} # Author
				case 4:	{$sTable = 'lcis.lcis_title';	
							$sJoin  =	 '    JOIN library_catalog_item_subjects  lcis_sub  ON  lci.lci_id = lcis_sub.lcis_catalog_id   LEFT JOIN library_catalog_item_subject lcis ON lcis_sub.lcis_title = lcis.lcis_id ';
					break;

				}	# Subject
				case 5:	{$sTable = 'lci.lci_callnumber';	break;}	# Call Number
				default:{ $sTable = 'CONCAT(lci.lci_title,lcia.lcia_title,lci.lci_callnumber)   '; 
							$sJoin  =	 ' JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
				}	# all fileds
			}

			


			$sWhere =$sJoin. " WHERE ". $sTable ." LIKE '%".$this->db->escape_like_str($this->input->get_post('bkeyword',true))."%'";
		 
			

			$sSql  = "SELECT  DISTINCT * FROM  library_catalog_item lci   LEFT JOIN library_libraries ll ON lci.lci_library_id = ll.ll_id ".$sWhere ." GROUP BY lci.lci_title";
			//echo $sSql;
			$aSearchRecord 	= 	$this->MyLibrary->searcher($sSql);
			$aParam['mPreparedContent']['search_result']	 =		$aSearchRecord ;
		}
		
		//$this->AppUser->validateAccess('eLibrary_portal_search_bsearch');
		 
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/bsearch_temp";
		$aParam['temp_title']				=	"Basic Search";
		$aParam['sBodyTitle']				=	"OPAC Search";
		$this->_bodyContentBuilder($aParam);


	}
 

	public function esearch(){
		$args = func_get_args();
		$aPost 	=	$this->input->get_post();
		//print_r($aPost);
		if(count($this->input->get_post()) && ($this->input->get_post('esearch_field') > 0) && $this->input->get_post('ekeyword') != ""){
			//$this->AppUser->validateAccess('eLibrary_portal_search_esearch_result');
			$aSaveToSearchHistory						=		$this->input->get_post(null,true);
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('ekeyword',true);
			$aSaveToSearchHistory['search_type']		=		'esearch';
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('ekeyword',true);
			$this->MyLibrary->saveToSearchHistory($aSaveToSearchHistory);

			$aData 	=	$this->ElibrarySystem->getExternalLibraryDetails($this->input->get_post('esearch_field'));
			$aData 	=	$aData[0];
					//print_r($aData);
					//echo count($aData[0]);
					if(!count(@$aData)){
						//show 404 not found
						return show_404(current_url());
						//return ;
					}
			// save the search into the users search history

				//	$this->MyLibrary->saveToSearchHistory(array_merge($this->input->get_post(null,true),$aData));
			// redirect user to the page
			$sTogo  =	$aData['lel_searc_page'].$this->input->get_post('ekeyword');
			header("location:".$sTogo);		

		}


		//$this->AppUser->validateAccess('eLibrary_portal_search_esearch');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/esearch_temp";
		$aParam['temp_title']				=	"External Search";
		$aParam['sBodyTitle']				=	"OPAC Search";
		$this->_bodyContentBuilder($aParam);


	}


 


	public function asearch(){
		$aArgs = func_get_args();
		/*print_r($this->input->get_post(NULL));
		print_r($aArgs);*/

		if(count($this->input->get_post()) && ($this->input->get_post('asearch_field') > 0) && $this->input->get_post('akeyword') != ""){
			//$this->AppUser->validateAccess('eLibrary_portal_search_bsearch_result');
			$aSaveToSearchHistory						=		$this->input->get_post(null,true);
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('akeyword',true);
			$aSaveToSearchHistory['search_type']		=		'asearch';
			$aSaveToSearchHistory['keyword']			=		$this->input->get_post('akeyword',true);
			$this->MyLibrary->saveToSearchHistory($aSaveToSearchHistory);
			$sSql = "";
			
			$sTable = '';
			$sJoin 	=	'';
			switch($iField = (int)$this->input->get_post('asearch_field')){
				case 2:	{$sTable = 'lci.lci_title';	break;} # Title
				case 3:	{$sTable = 'lcia.lcia_title';

						$sJoin  =	 '  JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
					break;} # Author
				case 4:	{$sTable = 'lcis.lcis_title';	
							$sJoin  =	 '    JOIN library_catalog_item_subjects  lcis_sub  ON  lci.lci_id = lcis_sub.lcis_catalog_id   LEFT JOIN library_catalog_item_subject lcis ON lcis_sub.lcis_title = lcis.lcis_id ';
					break;

				}	# Subject
				case 5:	{$sTable = 'lci.lci_callnumber';	break;}	# Call Number
				default:{ $sTable = 'CONCAT(lci.lci_title,lcia.lcia_title,lci.lci_callnumber)   '; 
							$sJoin  =	 ' JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
				}	# all fileds
			}



			$sWhere =$sJoin. " WHERE ". $sTable ." LIKE '%".$this->db->escape_like_str($this->input->get_post('akeyword',true))."%'";

			$sWhereLibrary	=	  ($this->input->get_post('asearch_library') && ( $this->input->get_post('asearch_library') > 0)  ) ? "lci.lci_library_id = ".  (int)$this->input->get_post('asearch_library') . ' AND ' :  '';
			//$sWhereLibrary	.=	  ($this->input->get_post('asearch_subject') && ( $this->input->get_post('asearch_subject') > 0)  ) ? "lci.lci_subject_id = ". (int)$this->input->get_post('asearch_subject') . ' AND ' :  '';
			$sWhereLibrary	.=	  ($this->input->get_post('asearch_category') && ( $this->input->get_post('asearch_category') > 0)  ) ? "lci.lci_category = ". (int)$this->input->get_post('asearch_category')  :  '';

			if(strlen($sWhereLibrary)){
				$sWhereLibrary = 'AND '. $sWhereLibrary;
			}

			$sWhereLibrary  = trim($sWhereLibrary) ;

 
			if(substr($sWhereLibrary,(strlen($sWhereLibrary) - 3), 3  ) == 'AND' ){
				$sWhereLibrary  = (substr_replace($sWhereLibrary, '', -3,3));
			}



			$sSql  = "SELECT DISTINCT * FROM  library_catalog_item lci    LEFT JOIN library_libraries ll ON lci.lci_library_id = ll.ll_id  ".$sWhere .$sWhereLibrary. " GROUP BY lci.lci_title";

			//$sSql  = "SELECT * FROM  library_catalog_item lci  ".$sWhere.$sWhereLibrary;
			//echo '<br/>'. $sSql;

			
			//echo $sSql;
			$aSearchRecord 	= 	$this->MyLibrary->searcher($sSql);
			$aParam['mPreparedContent']['search_result']	 =		$aSearchRecord ;
		}


		//$this->AppUser->validateAccess('eLibrary_portal_search_asearch');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/asearch_temp";
		 
		$aParam['temp_title']				=	"Advanced Search";
		$aParam['sBodyTitle']				=	"OPAC Search";
		$this->_bodyContentBuilder($aParam);


	}


	 
 

	private function _bodyContentBuilderd( $aPageData = array('sBodyContentTemplate'=>'','sPageTitle'=>'', 'f'=>'','sRightContentTemplate'=>'s')){
		
		$sDefaultRightContentTemplate		=		'';
		$aPageData['sRootDirLink'] 			=		$this->sRootDir;
		/*print_r(var_dump($this->AppUser->isUserTypeAdmin()));
		die();*/
		 if($this->AppUser->isUserTypeAdmin() === true){
        // redirect to Admin Login Page
		 	send2AdminPage();

    		}	
 
	    $data['title']="Augustine University";

		  //This is the sub title that shows along with title on top bar
	    	 
	      $this->session->set_userdata('section',$this->encrypt->encode(isset($aPageData['sBodyTitle']) ? $aPageData['sBodyTitle'] : '')); //Change to module section
		  
		  $this->session->set_userdata('sub_section',$this->encrypt->encode(isset($aPageData['temp_title']) ? $aPageData['temp_title'] : '')); //Change to module section
		  
		$data['page_link']  = isset($aPageData['temp_title']) ? $aPageData['temp_title'] : ''; 

		  $this->load->view('general/header_start',$data); 
		  //ADD MODULE LEVEL INCLUDES HERE. 
		  //Observe naming convention. Check view->sample->sample_header. For example,
		  $this->load->view('elibrary/templates/css',$aPageData);
		  //End module level header
		  $this->load->view('general/header_end',$data);
		  $this->load->view('general/topbar',$data);
		  $this->load->view('general/side_menu_start',$data);
		  //ADD MODULE LEVEL SIDE MENU.
		  //Observe naming convention. Check view->sample->sample_side_menu. For example
		  $this->load->view('elibrary/portal/student_left_menu',$aPageData); 
		  //End of module level side menu
		  $this->load->view('general/side_menu_end',$data);
		  //ADD MAIN BODY HERE.
		  //Observe naming convention. Check view->sample->sample_dashboard. For example
		  //$this->load->view('sample/sample_dashboard',$data);

		  /*if(isset($aPageData['sBodyContentTemplate'])){
		  	$this->load->view($aPageData['sBodyContentTemplate'],isset($aPageData['mPreparedContent']) ?$aPageData['mPreparedContent'] : null);
           }*/
		  $this->load->view("elibrary/templates/eLibraryContentWrapper",  $aPageData);
		  //End of module level body
		  $this->load->view('general/right_strip',$data);
		  //ADD MODULE LEVEL RIGH STRIP HERE.
		  //Observe naming convention. Check view->sample->sample_right_strip. For example
		  $this->load->view('elibrary/portal/chatRightMenu',$aPageData);
		  //End of module level right strip
		  $this->load->view('general/footer_start',$data);
		  //ADD MODULE LEVEL FOOTER HERE.
		  //All javascripts showuld be included at the footer. Observe naming convention. Check view->sample->sample_footer. For example
		  $this->load->view('elibrary/templates/assets',$aPageData);
		  //End of module level foooter
		  $this->load->view('general/footer_end',$data);

	      
	}









	 
	 
	private function load_core_libs_and_models(){
		// Load Libraries
		$this->load->library(array('session','encrypt'));
		$this->load->library('form_validation');
		
		// Load Database
		$this->load->database();
		
		// Load Helpers
		//$this->load->helper('main_helper');
		
		// Load App User Models
		//$this->load->model('elibrary/AppUser') ;
		 
		 
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$this->load->model('elibrary/portal/MyLibrary') ;
		$this->load->helper(array('url','form','elibrary/elibrary'));
		$this->load->model('elibrary/AppUser') ;
		//$this->load->helper(array('interactive/interactive'));
		$this->load->library('pagination');
		
	}
 



	public function borrowed(){

		//$this->AppUser->validateAccess('eLibrary_portal_mylibrary_borrowed');
		$aArgs = func_get_args();
		$aForBorrowed['iStudent']			=	$this->AppUser->getUserId();
		$aParam['sBodyContentTemplate'] 	= 	"elibrary/portal/borrowedResourceRecordList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Borrowed Resources";
		$aParam['sBodyTitle']				=	"My Library";


		$aParam['mPreparedContent'] 		=		$this->MyLibrary->studentBorrowedResources($aForBorrowed);
		$this->_bodyContentBuilder($aParam );
	}

	public function violations(){
		return $this->violation(func_get_args());
	}

	public function violation(){
		//$this->AppUser->validateAccess('eLibrary_portal_mylibrary_violation');
		$aArgs = func_get_args();
		//$aForBorrowed['iStudent']			=	(int)$this->AppUser->getUserId();
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/studentViolations";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		 
		$aParam['temp_title']				=	"Violations";
		$aParam['sBodyTitle']				=	"My Library";

		
		$this->_bodyContentBuilder($aParam );
	}

	 


	public function favourite(){
		$aArgs = func_get_args();
		// print_r(((isset($aArgs[0]) && $aArgs[0] == 'delf') && (isset($aArgs[1])) ) );
		//print_r($this->uri->segment(3));
		//print_r($aArgs);
		if(count($aArgs) || ($this->uri->segment(4))){
			if((isset($aArgs[0]) && $aArgs[0] == 'upload___') || ($this->uri->segment(4) =='upload__')){

				$aParam['sBodyContentTemplate'] 	= 	"elibrary/portal/userFileUploadForm";
				$aParam['temp_title']				=	"Upload docs to your account";
				$aParam['sBodyTitle']				=	"User file upload page";


				$aParam['temp_title']				=	"Advanced Search";
				$aParam['sBodyTitle']				=	"OPAC Search";


				$this->_bodyContentBuilder($aParam);

				return ;

			}else if( ((isset($aArgs[0]) && $aArgs[0] == 'delf') && (isset($aArgs[1])) ) || ( ($this->uri->segment(4) ) && ($this->uri->segment(4) =='delf') ) ){
				//$this->AppUser->validateAccess('eLibrary_portal_myshelve_delete_folder');
				//print_r($_REQUEST);

				$iFile 			=	$this->input->post('iFileId');
				$iUser 			= 	$this->AppUser->getUserId(); 
				$iShelf			=	(int)$this->input->post('iFolder');
				$mReturn = $this->MyLibrary->deleteFromMyshelfItem($iUser, $iFile,$iShelf);
				if($mReturn){
					die('<div class="alert alert-success"> Request processed successfully. </div>');
				}
				die('<div class="alert alert-success">  Your request could not be processed. </div>');
				return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
			}else if($this->uri->segment(4) > 0){
				//print_r();
				// the content of the file
			//	$this->AppUser->validateAccess('eLibrary_portal_myshelve_items');
				$aStudentFavouriteResources['iStudent'] 			=		$this->AppUser->getUserId();
				$aStudentFavouriteResources['iFolder'] 				=		(int)$this->uri->segment(4);
				// get the shelf details
				$aRecInfo0 = $this->MyLibrary->getShelfInfo($aStudentFavouriteResources['iFolder']);
				$aRecInfo0 = isset($aRecInfo0[0])?$aRecInfo0[0] : $aRecInfo0;
				//print_r($aRecInfo0);
				if(!count($aRecInfo0)){
					return show_404(current_url());
				}
					
				
				$aRecInfo = $this->MyLibrary->studentFavouriteResources($aStudentFavouriteResources);
				//$aRecInfo = isset($aRecInfo[0])?$aRecInfo[0] : $aRecInfo;
				/*echo '<pre>';
				print_r($aRecInfo);
				echo '</pre>';*/
				 
					//global $aRecInfo;
					$aParam['mPreparedContent']['result']		 	=		$aRecInfo ;
					$aParam['mPreparedContent']['title']		 	=		$aRecInfo0['lufl_title'] ;
					$aParam['sBodyContentTemplate'] 				= 		"elibrary/portal/studentFavouriteListItems";
					$aParam['temp_title']							=		$aRecInfo0['lufl_title'];
					 
					$aParam['sBodyTitle']							=	"My Shelves";
					return $this->_bodyContentBuilder($aParam); 
				 

			}
			return;
		}

		//$this->AppUser->validateAccess('eLibrary_portal_myshelves_record');
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/studentFavouriteList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Record list";
		$aParam['sBodyTitle']				=	"My Shelves";
		$this->_bodyContentBuilder($aParam);

	}

	public function messages($aArgs = array()){
		if(count($aArgs) || ($this->uri->segment(4))){
			if((isset($aArgs[0]) && $aArgs[0] > 0) || (	$this->uri->segment(4) > 0)){
				//$this->AppUser->validateAccess('eLibrary_portal_message_read');
				$msg_id 										=		(int)$this->uri->segment(4);
				$user 											=		$this->AppUser->getUserId();
				$aParam['mPreparedContent'] 					= 		$this->MyLibrary->readMessage(array('msg'=>$msg_id,'user'=>$user));
				$aParam['mPreparedContent']						=		isset($aParam['mPreparedContent'][0])?$aParam['mPreparedContent'][0]:$aParam['mPreparedContent'];
				if(!count($aParam['mPreparedContent'])){
					return show_404();
				}
								
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/portal/portal_message_details";
				$aParam['temp_title']							=		'Read message ';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else

			if((isset($aArgs[0]) && $aArgs[0] == 'compose') || (	$this->uri->segment(4) =='compose')){
			//	$this->AppUser->validateAccess('eLibrary_portal_message_compose');
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/portal/mailComposer";
				$aParam['temp_title']							=		'Compose new message';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else if((isset($aArgs[0]) && $aArgs[0] == 'sent') || ($this->uri->segment(4) =='sent')){
			//	$this->AppUser->validateAccess('eLibrary_portal_message_sent');
				$aSent 										=		$this->MyLibrary->mySent($this->AppUser->getUserID());
				$aParam['mPreparedContent']['aSent']		 	=		$aSent ;
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/portal/message_sent";
				$aParam['temp_title']							=		'Sent';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else if((isset($aArgs[0]) && $aArgs[0] == 'inbox') || ($this->uri->segment(4) =='inbox')){
			//	$this->AppUser->validateAccess('eLibrary_portal_message_inbox');
				$aInbox 										=		$this->MyLibrary->myInbox($this->AppUser->getUserID());
				$aParam['mPreparedContent']['aInbox']		 	=		$aInbox ;
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/portal/message_inbox";
				$aParam['temp_title']							=		'Inbox';					 
				$aParam['sBodyTitle']							=		"Messages";

				return $this->_bodyContentBuilder($aParam); 
			}

		}
	}


	public function messanger($aArgs = array()){

		if(count($aArgs) || ($this->uri->segment(4))){
			if((isset($aArgs[0]) && $aArgs[0] == 'pull_usersd') || ($this->uri->segment(4) =='pull_usersd')){

			}else
			if((isset($aArgs[0]) && $aArgs[0] == 'pull_updates') || ($this->uri->segment(4) =='pull_updates')){

			}else

			if((isset($aArgs[0]) && $aArgs[0] == 'pull_users') || ($this->uri->segment(4) =='pull_users')){
				
				$aResult['aResult'] = $this->MyLibrary->messanger_pull_users();
				//print_r($aResult);

				echo $this->load->view('elibrary/portal/studentChatFixer',$aResult,true);
			  
				exit();

			}else if( ((isset($aArgs[0]) && $aArgs[0] == 'delf') && (isset($aArgs[1])) ) || ( ($this->uri->segment(4) ) && ($this->uri->segment(4) =='delf') ) ){
				$iFile 			=	(int)$this->input->post('iFileId');
				$iUser 			= 	$this->AppUser->getUserId(); 
				$iShelf			=	(int)$this->input->post('iFolder');
				$mReturn = $this->MyLibrary->deleteFromMyshelfItem($iUser, $iFile,$iShelf);
				if($mReturn){
					die('<div class="alert alert-success"> Request processed successfully. </div>');
				}
				die('<div class="alert alert-success">  Your request could not be processed. </div>');
				return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
			}else if($this->uri->segment(4) > 0){
				// the content of the file

				$aStudentFavouriteResources['iStudent'] 			=		$this->AppUser->getUserId();
				$aStudentFavouriteResources['iFolder'] 				=		(int)$this->uri->segment(4);
				// get the shelf details
				$aRecInfo0 = $this->MyLibrary->getShelfInfo($aStudentFavouriteResources['iFolder']);
				$aRecInfo0 = isset($aRecInfo0[0])?$aRecInfo0[0] : $aRecInfo0;
				//print_r($aRecInfo0);
				if(!count($aRecInfo0)){
					return show_404(current_url());
				}
					
				
				$aRecInfo = $this->MyLibrary->studentFavouriteResources($aStudentFavouriteResources);
				//$aRecInfo = isset($aRecInfo[0])?$aRecInfo[0] : $aRecInfo;
				/*echo '<pre>';
				print_r($aRecInfo);
				echo '</pre>';*/
				 
					//global $aRecInfo;
					$aParam['mPreparedContent']['result']		 	=		$aRecInfo ;
					$aParam['mPreparedContent']['title']		 	=		$aRecInfo0['lufl_title'] ;
					$aParam['sBodyContentTemplate'] 				= "elibrary/portal/studentFavouriteListItems";
					$aParam['temp_title']							=	$aRecInfo0['lufl_title'].' :: Details';
					$aParam['sBodyTitle']							=	"<i>".ucfirst($aRecInfo0['lufl_title'])."</i>";
					return $this->_bodyContentBuilder($aParam); 
				 

			}
			return;
		}


	}



	private function _bodyContentBuilder( $aPageData = array('sBodyContentTemplate'=>'','sPageTitle'=>'', 'f'=>'','sRightContentTemplate'=>'s')){
		
		$sDefaultRightContentTemplate		=		'';
		//$aPageData['sRootDirLink'] 			=		$this->sRootDir;
		
		 if($this->AppUser->isUserTypeAdmin() === true){
        // redirect to Admin Login Page

        		header("Location:../") ;
    		}	

 
		  //This is the sub title that shows along with title on top bar
	    $data['page_link']  = isset($aPageData['temp_title']) ? $aPageData['temp_title'] : ''; 	 

	     $aPageData['page_link']  = isset($aPageData['temp_title']) ? $aPageData['temp_title'] : ''; 	
		  /*$this->session->set_userdata('section',$this->encrypt->encode(isset($aPageData['sBodyTitle']) ? $aPageData['sBodyTitle'] : '')); //Change to module section
		  
		  $this->session->set_userdata('sub_section',$this->encrypt->encode(isset($aPageData['temp_title']) ? $aPageData['temp_title'] : '')); //Change to module section
		  */
		  //$this->AppUser->validateAccess();
		 

		$this->load->view('elibrary/common/head_top',$aPageData); 
		$this->load->view('elibrary/common/body_wrapper_start',$aPageData); 
		$this->load->view('elibrary/common/content_header',$aPageData); 
		$this->load->view('elibrary/common/left_side_menu',$aPageData); 

		$this->load->view('elibrary/common/content_wrapper_start',$aPageData); 
		 
		/*  if(isset($aPageData['sBodyContentTemplate'])){
		  	$this->load->view($aPageData['sBodyContentTemplate'],isset($aPageData['mPreparedContent']) ?$aPageData['mPreparedContent'] : $aPageData);
           }*/
		//$this->load->view("result/general/resultContentWrapperAdmin",  $aPageData);
          $this->load->view("elibrary/templates/eLibraryContentWrapperAdmin",  $aPageData);
		   
		$this->load->view('elibrary/common/content_wrapper_end',$aPageData); 

		$this->load->view('elibrary/common/content_wrapper_end',$aPageData); 
		$this->load->view('elibrary/common/footer',$aPageData); 
		//$this->load->view('elibrary/common/control_sidebar',$data); 
		//$this->load->view('elibrary/templates/assets',$aPageData);
		$this->load->view('elibrary/common/body_end',$aPageData); 
    
	}

}
?>