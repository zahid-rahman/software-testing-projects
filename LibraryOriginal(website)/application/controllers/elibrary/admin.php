<?php
class Admin extends CI_Controller {
	private $sRootDir		=	'';
	

	public function __construct(){

        parent::__construct();
        $this->load_core_libs_and_models();

   	
     
        $this->sRootDir = eLibraryRootUrl();
     	//$this->output->enable_profiler(TRUE);
       // $this->_loadeLibraryClientSideAssets();
        if($this->input->is_ajax_request()){
        	ob_start();
        }
        
        $this->AppUser->initialize('admin');
        $this->AppUser->validateAccess('elibrary');
        // $this->AppUser->validateAccess('elibrary_admin');
       
    }

    public function guide(){
		$aParam['sBodyContentTemplate'] 	=  	"elibrary/templates/guide";		 
		$aParam['temp_title']				=	"Guide";
		$aParam['sBodyTitle']				=	$this->config->item('system.shortcode');	
		//$aParam['mPreparedContent'] 		=	$aResult;
		$this->_bodyContentBuilder($aParam);
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




    public function external_library(){
		//$this->AppUser->validateAccess('elibrary_admin_library');
		$this->AppUser->validateAccess('elibrary_admin');
		$this->load->helper(array('url','form','elibrary/elibrary'));
		$this->load->library('form_validation');
		$aArgs = func_get_args();
		
		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'new'){
				//$this->AppUser->validateAccess('elibrary_admin');
				//print_r($this->input->get_post('library_form_submit'));
				//print_r($_REQUEST);
				//$aParam['show']	=	false;
				if(isset($aArgs[1]) && $aArgs[1] >0){
					$iID 	=	(int)$aArgs[1];
					$aData 	=	$this->ElibrarySystem->getExternalLibraryDetails($iID);
					$aData 	=	$aData[0];
					
					//echo count($aData[0]);
					if(!count(@$aData)){
						//show 404 not found
						return show_404(current_url());
						//return ;
					}
					//$aData['show']	=	true;;
					//print_r($aData);


					
				}
				
				//$this->AppUser->validateAccess('elibrary_admin_library_records');
				$aData 								=	!isset($aData)? array() : $aData;
				$aParam['sBodyContentTemplate'] 	=	"elibrary/admin/ExternallibraryForm";
				$aParam['temp_title']				=	"Create & Update External Library Record";
				$aParam['sBodyTitle']				=	"System Management";
				$aParam 							=	array_merge($aParam,$aData);
				$this->_bodyContentBuilder($aParam);

				return ;
			}else if(isset($aArgs[0])   &&  $aArgs[0] == 'dl'  ){
				//$aData['item_id'] 	=	(int)$aArgs[1];
				$this->AppUser->validateAccess('elibrary_admin');
				if((bool)$this->input->post('libraryDeleteHiddenID') ==false){
					die('<div class="alert alert-danger"> Important information was missing in your request.</div>');
				}
				
				$bResult 							=	$this->ElibrarySystem->deleteExternalLibraryRecord((int)$this->input->post('libraryDeleteHiddenID'));
				if($bResult){
				 
					die('<div class="alert alert-success"> Your request has been processed successfully.</div>');
			 	
				}
				die('<div class="alert alert-warning"> Your request could not be processed successfully.</div>');
			}
		}


		//$this->AppUser->validateAccess('elibrary_admin_library_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminExternalLibraryRecordLIst";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		
		$aParam['temp_title']				=	"External Library Management";
		$aParam['sBodyTitle']				=	"System Management";

		$this->_bodyContentBuilder($aParam);


	}




    public function violations(){
    	
		//$this->AppUser->validateAccess('eLibrary_portal_mylibrary_violation');
		$aArgs = func_get_args();
		//$aForBorrowed['iStudent']			=	(int)$this->AppUser->getUserId();
		$aParam['sBodyContentTemplate'] 	= "elibrary/portal/studentViolations";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		 
		$aParam['temp_title']				=	"My Violations";
		$aParam['sBodyTitle']				=	"My Library";

		
		$this->_bodyContentBuilder($aParam );
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



	public function news_event(){
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
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/news_events";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Latest";
		$aParam['sBodyTitle']				=	"News &amp; Events";
		$this->_bodyContentBuilder($aParam);
	}




    public function myborrowed(){

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
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/FavouriteList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Record list";
		$aParam['sBodyTitle']				=	"My Shelves";
		$this->_bodyContentBuilder($aParam);

	}



    public function getUserDetails(){
    	$this->AppUser->validateAccess('elibrary_admin');
    	$sUser 								=		$this->input->post('getUserDetails');
    	$aParam['mPreparedContent']  		=		$this->AppUser->getUserDetials($sUser);
    	echo  $this->load->view('elibrary/templates/generalUserDetails',$aParam,true);
    	return ;
    }

    public function messages($aArgs = array()){
    	//$this->AppUser->validateAccess('messages_admin');
		if(count($aArgs) || ($this->uri->segment(4))){
			//	$this->AppUser->validateAccess('elibrary_admin_message_read');
			if((isset($aArgs[0]) && $aArgs[0] > 0) || (	$this->uri->segment(4) > 0)){
				$msg_id 										=		(int)$this->uri->segment(4);
				$user 											=		$this->AppUser->getUserId();
				$aParam['mPreparedContent'] 					= 		$this->MyLibrary->readMessage(array('msg'=>$msg_id,'user'=>$user));
				$aParam['mPreparedContent']						=		isset($aParam['mPreparedContent'][0])?$aParam['mPreparedContent'][0]:$aParam['mPreparedContent'];
				if(!count($aParam['mPreparedContent'])){
					return show_404();
				}
				
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/admin/portal_message_details";
				$aParam['temp_title']							=		'Read message ';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else

			if((isset($aArgs[0]) && $aArgs[0] == 'compose') || (	$this->uri->segment(4) =='compose')){
				//$this->AppUser->validateAccess('elibrary_admin_message_compose');
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/admin/mailComposer";
				$aParam['temp_title']							=		'Compose new message ';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else if((isset($aArgs[0]) && $aArgs[0] == 'sent') || ($this->uri->segment(4) =='sent')){
				//$this->AppUser->validateAccess('elibrary_admin_message_sent');
				$aSent 										=		$this->MyLibrary->mySent($this->AppUser->getUserID());
				$aParam['mPreparedContent']['aSent']		 	=		$aSent ;
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/admin/message_sent";
				$aParam['temp_title']							=		'Sent ';					 
				$aParam['sBodyTitle']							=		"Messages";
				return $this->_bodyContentBuilder($aParam); 

			}else if((isset($aArgs[0]) && $aArgs[0] == 'inbox') || ($this->uri->segment(4) =='inbox')){
				//$this->AppUser->validateAccess('elibrary_admin_message_inbox');
				$aInbox 										=		$this->MyLibrary->myInbox($this->AppUser->getUserID());
				$aParam['mPreparedContent']['aInbox']		 	=		$aInbox ;
				$aParam['sBodyContentTemplate'] 				= 		"elibrary/admin/message_inbox";
				$aParam['temp_title']							=		'Inbox ';					 
				$aParam['sBodyTitle']							=		"Messages";
				/*echo '<pre>';
				print_r($aInbox);
				echo '</pre>';
				*/
				return $this->_bodyContentBuilder($aParam); 
			}

		}
		return show_404();
	}
 
	public function index($param = ""){
		//$this->AppUser->validateAccess('elibrary_admin');

		if(!$this->AppUser->bHasAccess()){

			redirect(elibraryAdminUrl('news_event'));
			return;
		}
		$rootdir = $this->config->item('base_url') ;
		
		/*$view_to_load = "elibrary/admin/dashboard";
		$this->main_access_control($rootdir, $view_to_load);*/
		$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/dashboard";
		$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/dashboard_format";
		$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/dashboard2";
		$aParam['temp_title']				=	"Dashboard";
		$aParam['sBodyTitle']				=	$this->config->item('system.shortcode');
		$this->_bodyContentBuilder($aParam);
		
	}
	public function news_events(){
		//$this->AppUser->validateAccess('elibrary_admin_news_event');
		$this->AppUser->validateAccess('elibrary_admin');
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aArgs = func_get_args();
		/*echo '<pre>';
		print_r($aArgs);
		echo '</pre>';
		*/
		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'crud'){
				$this->AppUser->validateAccess('elibrary_admin');
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/catalogueForm";
				$aParam['temp_title']				=	"Manage News &amp; Events";
				$aParam['sBodyTitle']				=	"News &amp; Events ";
				//$this->_bodyContentBuilder($aParam);
				
				
				$sData 								=	$this->ElibrarySystem->saveNewsEventRecord( );
				if($sData =='success'){
					echo '<div class="alert alert-success"> Your request was processed successful. </div>';
					die();
				}else if($sData =='exists'){
					echo '<div class="alert alert-warning"> Record already exists. </div>';
					die();
				}else{
					echo '<div class="alert alert-danger"> There was a little problem processing your request. </div>';
					die();
				}
				
			}else if(isset($aArgs[0]) && isset($aArgs[1]) &&  $aArgs[0] == 'view'){
				//$this->AppUser->validateAccess('elibrary_admin_news_event_view');
				$aData['lib_id'] 	=	(int)$aArgs[1];
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/catalogueForm";
				$aParam['temp_title']				=	"View News &amp; Events";
				$aParam['sBodyTitle']				=	"News &amp; Events";
				
				$this->_bodyContentBuilder($aParam);
				return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);

			}else if(isset($aArgs[0]) && $aArgs[0] == 'crudd'){
				$this->AppUser->validateAccess('elibrary_admin');
				echo $this->ElibrarySystem->deleteNewsEventRecord( );
				 die();
			}else if( isset($aArgs[0]) && $aArgs[0] == 'crudu' ){
				$this->AppUser->validateAccess('elibrary_admin');
				if((int)$this->input->post('news_edit_key')  < 1){
					die('<div class="alert alert-danger"> Important information is missing in your request. </div>'); 
				}
				$aResult 	=	$this->ElibrarySystem->getNewsAndEventsInfo2((int)$this->input->post('news_edit_key') );
				$aResult = isset($aResult[0])?$aResult[0] : $aResult;
				//var_dump($aResult);
				if(count($aResult) && $aResult != false){
					$aResult['s'] = $aResult;
					echo  $this->load->view('elibrary/admin/pageNewsForm',$aResult,true);
				 	die();					
				}
				die('<div class="alert alert-danger"> The requested record can not be found. </div>');

				
			}
			else{
				echo show_404();
			}
		}


		//$this->AppUser->validateAccess('eLibrary_news_event_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/newsEvents";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"News &amp; Events Record list";
		$aParam['sBodyTitle']				=	"News &amp; Events";
		$this->_bodyContentBuilder($aParam);

	}

	public function settings($params = ""){

		$this->AppUser->validateAccess('elibrary_admin');
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aArgs = func_get_args();
		 if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'save'){

				return $this->ElibrarySystem->adminSaveSystemSettings();
			}
		}


		
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/settings";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"General System Setting";
		$aParam['sBodyTitle']				=	"System Management";
		$this->_bodyContentBuilder($aParam);
	}


	public function users($params = ""){
/*
		var_dump($this->config->item('default_password'));

		die();*/
		$aParam_try 	=	 array();
		$this->AppUser->validateAccess('elibrary_admin');

		/*if(strtolower($this->uri->segment(4)) =='resetpwd'){

		}else
		*/
		if(strtolower($this->uri->segment(4)) =='create'){
			$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/user_form";			 
			$aParam['temp_title']				=	"Create Library Users Record";
			$aParam['sBodyTitle']				=	"System Management";

			 
			if($this->uri->segment(5)){
				$aParam_try 	= 		$this->AppUser->getUserDataOnlyByKey(array('lu_id'=>$this->uri->segment(5)));
				$aParam_try 		=		isset($aParam_try[0])?$aParam_try[0]:$aParam_try;
 
			}

			if($this->input->post('create_account')){

				$aCreateUpdateAccount = array(
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
	               array(
	                     'field'   => 'lu_acc_type', 
	                     'label'   => 'Account Type', 
	                     'rules'   => 'required'
	                  ), 
	               array(
	                     'field'   => 'lu_phn', 
	                     'label'   => 'Phone Number', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'lu_acc_status', 
	                     'label'   => 'Account Status', 
	                     'rules'   => 'required'
	                  ) 



            	);
		 
			  	$this->form_validation->set_rules($aCreateUpdateAccount);
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
												'lu_acc_type'=> $aDataPassed['lu_acc_type'],
												'lu_acc_status'=>  $aDataPassed['lu_acc_status'],
												'lu_phn'=> $aDataPassed['lu_phn']/*, 
												'lu_pwd'=>md5($aData['lu_pwd']) */
												);
				/*	echo '<pre>';
					print_r($_FILES);
					die();*/

					if(isset($_FILES['passport']['name']) && strlen($_FILES['passport']['name'])){
 
						$config['upload_path'] 		= 	$this->config->item('upload_path');
						$config['allowed_types'] 	=  	$this->config->item('allowed_types');
						$config['max_size']     	=  	$this->config->item('max_size');
						$config['max_width'] 		=  	$this->config->item('max_width');
						$config['max_height'] 		=  	$this->config->item('max_height');
						$config['encrypt_name'] 	=  	$this->config->item('encrypt_name');
						 
						$this->load->library('upload', $config);
						if($this->upload->do_upload('passport')){
							$aReturnedData 	=	$this->upload->data(); 
							$aFields['passport']  	=	$aReturnedData['file_name'];
							/*echo '<pre>';	
							print_r($aFields['passport']);
							die();*/
						}
						
					} 


					// Seeting the user's password
					if($aDataPassed['lu_id']  && ( $aDataPassed['lu_id'] > 0) ){
						

						if(isset($aDataPassed['lu_pwd']) && isset($aDataPassed['lu_pwd2']) ){

							 if($aDataPassed['lu_pwd'] !== $aDataPassed['lu_pwd2']){
							 	$aParam['errors'][]				=	"Your passwords do not match";
							 }else{
							 	$aFields['lu_pwd']  = 	md5($aDataPassed['lu_pwd']);
							 }
						}		


					}else{

						$aSimilar 	=	 $this->AppUser->getUserDataOnlyByKey(array('lu_email'=> $aDataPassed['lu_email']));
						/*print_r($aSimilar);
						die();*/
						if(count($aSimilar)){
							$aParam['errors'][]				=	'A Similar Record was found. Click <a href ="'.userRootUrl('users/create/'.@$aSimilar['lu_id']).'" target="_blanck"> here</a> to view it.';
						}


						$aFields['lu_pwd']  		= 	md5($this->config->item('default_password'));
					}

					if(!count($aParam['errors'])){
						// Send the request to the model for final processing
						if($this->AppUser->createAccountAdmin($aFields,$aDataPassed['lu_id'])  !== false){
							$aParam['sSuccess']	 	=	'Record has been saved successfully!';
						}
					}
					 

			  		
			  	}else{
			  		$aParam['errors'][]	  	=	  validation_errors();
			  	}
			 
			 
			}
 
			$this->_bodyContentBuilder(array_merge($aParam_try,$aParam));
			return;


		}else
		 

		if(strtolower($this->uri->segment(4)) =='export'){
		 
		$this->load->library('elibrary/elibrary_excel');
		$excel 		=  	 new Elibrary_excel();
		$excel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

		$excel->getActiveSheet()->setCellValue('A1','CODE');
		$excel->getActiveSheet()->setCellValue('B1','NAME');
		$excel->getActiveSheet()->setCellValue('C1','ACCOUNT TYPE');
		$excel->getActiveSheet()->setCellValue('D1','ACCOUNT STATUS');
		//$excel->getActiveSheet()->setCellValue('E1','GENDER');
		$excel->getActiveSheet()->setCellValue('F1','EMAIL');
		//$excel->getActiveSheet()->setCellValue('G1','RELIGION');
		$excel->getActiveSheet()->setCellValue('H1','PHONE NUMBER');
		//$excel->getActiveSheet()->setCellValue('I1','FACULTY/COURSE');
		$iCounterOffset  = 2;
		$aUsers 	=	 $this->ElibrarySystem->getLibUsers();
		foreach($aUsers as $aVals){
			$iCounterOffset++;
			$excel->getActiveSheet()->setCellValue('A'.$iCounterOffset,$aVals['user_code']);
			$excel->getActiveSheet()->setCellValue('B'.$iCounterOffset,$aVals['username']);
			$excel->getActiveSheet()->setCellValue('C'.$iCounterOffset,ucfirst($this->AppUser->getUserType($aVals['user_code'])));
			$excel->getActiveSheet()->setCellValue('D'.$iCounterOffset,elibrary_account_status_display($aVals['lu_acc_status']));
			//$excel->getActiveSheet()->setCellValue('E'.$iCounterOffset,$aVals['gender']);
			$excel->getActiveSheet()->setCellValue('F'.$iCounterOffset,$aVals['email_address']);
			///$excel->getActiveSheet()->setCellValue('G'.$iCounterOffset,$aVals['religion']);
			$excel->getActiveSheet()->setCellValue('H'.$iCounterOffset,"'".$aVals['phn_no']);
			//$excel->getActiveSheet()->setCellValue('I'.$iCounterOffset,$this->AppUser->getUserDepartment($aVals['dept']));

		}


		$excel->getActiveSheet()->setTitle($excel->cleanExcelTitle('Library Users'));
		//die();
		$excel->setFileTitle('just')->dispatch();

		/*echo $this->uri->segment(3);
		echo '<pre>';
		print_r($aUsers);
		echo '</pre>';*/

		return;
		}




		
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/lib_users";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Library Users Record";
		$aParam['sBodyTitle']				=	"System Management";
		$this->_bodyContentBuilder($aParam);
	}

	 

	/*
	Method for library management
	*/
	public function library(){
		//$this->AppUser->validateAccess('elibrary_admin_library');
		$this->AppUser->validateAccess('elibrary_admin');
		$this->load->helper(array('url','form','elibrary/elibrary'));
		$this->load->library('form_validation');
		$aArgs = func_get_args();
		
		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'new'){
				//$this->AppUser->validateAccess('elibrary_admin');
				//print_r($this->input->get_post('library_form_submit'));
				//print_r($_REQUEST);
				//$aParam['show']	=	false;
				if(isset($aArgs[1]) && $aArgs[1] >0){
					$iID 	=	(int)$aArgs[1];
					$aData 	=	$this->ElibrarySystem->getLibraryInfo($iID);
					$aData 	=	$aData[0];
					//print_r($aData);
					//echo count($aData[0]);
					if(!count(@$aData)){
						//show 404 not found
						return show_404(current_url());
						//return ;
					}
					//$aData['show']	=	true;;
					//print_r($aData);


					
				}
				
				//$this->AppUser->validateAccess('elibrary_admin_library_records');
				$aData 								=	!isset($aData)? array() : $aData;
				$aParam['sBodyContentTemplate'] 	=	"elibrary/admin/libraryForm";
				$aParam['temp_title']				=	"Create & Edit Library Record";
				$aParam['sBodyTitle']				=	"System Management";
				$aParam 							=	array_merge($aParam,$aData);
				$this->_bodyContentBuilder($aParam);

				return ;
			}else if(isset($aArgs[0])   &&  $aArgs[0] == 'dl'  ){
				//$aData['item_id'] 	=	(int)$aArgs[1];
				//$this->AppUser->validateAccess('elibrary_admin');
				if((bool)$this->input->post('libraryDeleteHiddenID') ==false){
					die('<div class="alert alert-danger"> Important information was missing in your request.</div>');
				}
				
				$bResult 							=	$this->ElibrarySystem->deleteLibraryRecord((int)$this->input->post('libraryDeleteHiddenID'));
				if($bResult){
				 
					die('<div class="alert alert-success"> Your request has been processed successfully.</div>');
			 	
				}
				die('<div class="alert alert-warning"> Your request could not be processed successfully.</div>');
			}
		}


		//$this->AppUser->validateAccess('elibrary_admin_library_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminLibraryList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		
		$aParam['temp_title']				=	"Library Management";
		$aParam['sBodyTitle']				=	"System Management";

		$this->_bodyContentBuilder($aParam);


	}

	public function import_export(){

		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/import_export_form";
				 
		$aParam['temp_title']				=	"Import &amp; Export Catalogue";
		$aParam['sBodyTitle']				=	"System Management";

		$this->_bodyContentBuilder($aParam);

		return ;
	}

	//private function _

	public function catalog(){
		 $this->AppUser->validateAccess('elibrary_admin');
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aArgs = func_get_args();
		/*echo '<pre>';
		print_r($aArgs);
		echo '</pre>';
		*/
		if(count($aArgs)){
			if( (isset($aArgs[0]) && $aArgs[0] == 'printer')   &&    (isset($aArgs[1]) && $aArgs[1] > 0 )){
				$this->AppUser->validateAccess('elibrary_admin');

				$aResult 							=	$this->ElibrarySystem->getCatalogueInfo((int)$aArgs[1]);
				$aResult = isset($aResult[0])?$aResult[0] : $aResult;
				//var_dump($aResult);
				if(count($aResult) && $aResult != false){
					//global $aRecInfo;
					$aParam['mPreparedContent']	        =	$aResult ;

					$iCode = (isset($aArgs[2]) ? $aArgs[2]: 0) ;
					$sFile = '';
					switch($iCode){
						case 2:{  $sFile = 'elibrary/admin/catalogueprinter2';  break;} 
						case 3:{  $sFile = 'elibrary/admin/catalogueprinter3';  break;} 
						default : { $sFile = 'elibrary/admin/catalogueprinter'; }
					}

					$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/catalogueprinter";
					echo $this->load->view($sFile,$aParam,true);
					die();
					return ; 
				}
				return show_404(current_url());


							 

				return ;
			}else 

			if(isset($aArgs[0]) && $aArgs[0] == 'new'){
				$this->AppUser->validateAccess('elibrary_admin');

				$aParam['sBodyContentTemplate'] 	= "elibrary/admin/catalogueForm";
				 
				$aParam['temp_title']				=	"Create & Edit Catalogue Record";
				$aParam['sBodyTitle']				=	"System Management";

				$this->_bodyContentBuilder($aParam);

				return ;

			}else 

			if(isset($aArgs[0]) && $aArgs[0] == 'export'){
				$this->AppUser->validateAccess('elibrary_admin');
				 
				$this->ElibrarySystem->catalogExcelExport($this->input->get('template'),$this->input->get('catalogue_item_query'),$this->input->get('cat_library_pick'));
 
				//$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminCatalogExportExcel";
				 
				/*$aParam['temp_title']				=	"Create & Edit Catalogue Record";
				$aParam['sBodyTitle']				=	"System Management";
				$this->ElibrarySystem->catalogExcelExport();*/

				//$this->_bodyContentBuilder($aParam);

				return ;


	
			}else


			if(isset($aArgs[0]) && $aArgs[0] == 'import'){
				$this->AppUser->validateAccess('elibrary_admin');

				$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminCatalogImportExcel";
				 
				$aParam['temp_title']				=	"Import Catalog Item Record(s)";
				$aParam['sBodyTitle']				=	"System Management";

				$this->_bodyContentBuilder($aParam);

				return ;


	
			}else if(isset($aArgs[0]) && isset($aArgs[1]) &&  $aArgs[0] == 'view' && $aArgs[1] > 0){
				//$this->AppUser->validateAccess('elibrary_admin_catalog_view');
				//$aData['item_id'] 	=	(int)$aArgs[1];
				$aResult 							=	$this->ElibrarySystem->getCatalogueInfo((int)$aArgs[1]);
				$aResult = isset($aResult[0])?$aResult[0] : $aResult;
				//var_dump($aResult);
				if(count($aResult) && $aResult != false){
					//global $aRecInfo;
					$aParam['mPreparedContent']	        =	$aResult ;
					$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/catalogueForm";

					$aParam['temp_title']				=	"Catalogue details";
					$aParam['sBodyTitle']				=	"System Management";
			/*echo '<pre>';
			print_r($aParam['mPreparedContent']);
			echo '</pre>';*/

					return $this->_bodyContentBuilder($aParam); 
				}
				return show_404(current_url());

				//return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
			}else if(isset($aArgs[0])   &&  $aArgs[0] == 'dl'  ){
				$this->AppUser->validateAccess('elibrary_admin');
				//$aData['item_id'] 	=	(int)$aArgs[1];
				if((bool)$this->input->post('catalogueDeleteHiddenID') ==false){
					die('<div class="alert alert-danger"> Important information was missing in your request.</div>');
				}
				$bResult 							=	$this->ElibrarySystem->adminDeleteCatalogueItem((int)$this->input->post('catalogueDeleteHiddenID'));
				if($bResult){
				 
					die('<div class="alert alert-success"> Your request has been processed successfully.</div>');
			 	
				}
				die('<div class="alert alert-warning"> Your request could not be processed successfully.</div>');
			}
		}


		//$this->AppUser->validateAccess('eLibrary_catalog_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminLibraryListForCatalogue";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Library Catalogue";
		$aParam['sBodyTitle']				=	"Admin Library Catalogue Management";

		$aParam['temp_title']				=	"Catalogue";
		$aParam['sBodyTitle']				=	"System Management";

		$this->_bodyContentBuilder($aParam);


	}
	

	public function reservations(){
		//$this->AppUser->validateAccess('eLibrary_reservation');
		$this->AppUser->validateAccess('elibrary_admin');

		$aArgs = func_get_args();
		$this->load->model('elibrary/admin/ElibrarySystem') ;
	
		//print_r($this->uri->segment(null));
		if(($iReservatonID = (int)$this->uri->segment(4) )> 0){
		//	$this->AppUser->validateAccess('eLibrary_reservation_view');

		$aResult 							=	$this->ElibrarySystem->ReservationsDetails($iReservatonID);

		$aResult = isset($aResult[0])?$aResult[0] : $aResult;
			//print_r($aResult);
			if(count($aResult) ){
				//global $aRecInfo;
				$aParam['mPreparedContent']	        =	$aResult ;
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/resourceReservationDetails";
				$aParam['temp_title']				=	"Resource reservation details";
				$aParam['sBodyTitle']				=	"Transaction";
				return $this->_bodyContentBuilder($aParam); 
			}
			return show_404(current_url());
 
		}else if($this->uri->segment(4) =='update'){
		//	$this->AppUser->validateAccess('eLibrary_reservation_update');
			if(count($this->input->post(null) > 0)){
				$sResponse 		=	$this->ElibrarySystem->updateReservationRecord($this->input->post(null,true));
				echo $sResponse;
				die();
			}
		}

		//$this->AppUser->validateAccess('elibrary_admin_reservation_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/resourceReservation";
		$aParam['temp_title']				=	"Resource Reservation";
		$aParam['sBodyTitle']				=	"Transaction";
		$this->_bodyContentBuilder($aParam);
		
	}

	public function lib_users(){
		$this->AppUser->validateAccess('elibrary_admin');
		$aArgs = func_get_args();
	


		if(strtolower($this->uri->segment(4)) =='export'){
		 
		$this->load->library('elibrary/elibrary_excel');
		$excel 		=  	 new Elibrary_excel();
		$excel->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);

		$excel->getActiveSheet()->setCellValue('A1','SAMPLE');


		$excel->getActiveSheet()->setTitle($excel->cleanExcelTitle('Library Users'));
		die();
		$excel->setFileTitle('just')->dispatch();

		/*echo $this->uri->segment(3);
		echo '<pre>';
		print_r($aUsers);
		echo '</pre>';*/

		return;
		}



		//$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/lib_users";
		 
		$aParam['temp_title']				=	"Library Users";
		$aParam['sBodyTitle']				=	"System Management";
		$this->_bodyContentBuilder($aParam);

	}



	public function recommendation(){
		$this->AppUser->validateAccess('elibrary_admin');
		$aArgs = func_get_args();
	

		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/resourceRecomendation";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);

		if(isset($aArgs[0]) && $aArgs[0] > 0){
			$aResult 	=	$this->ElibrarySystem->getUserSentRecommendationDetailsForAdmin((int)$aArgs[0] );
			if(!count($aResult)){
				show_404();
			}

		$aParam['mPreparedContent'] 		=	$aResult;
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/recommendation_details";


		}


		 
		$aParam['temp_title']				=	"Resource recommendation";
		$aParam['sBodyTitle']				=	"System Management";
		$this->_bodyContentBuilder($aParam);

	}
	//


public function recommend(){
		$this->AppUser->validateAccess('elibrary_admin');
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
	 
	private function _bodyContentBuilders( $aPageData = array('sBodyContentTemplate'=>'','sPageTitle'=>'', 'f'=>'','sRightContentTemplate'=>'s')){
		
		$sDefaultRightContentTemplate		=		'';
		$aPageData['sRootDirLink'] 			=		$this->sRootDir;
		
		 if($this->AppUser->isUserTypeAdmin() === false){
        // redirect to Admin Login Page

        		header("Location:".eLibraryRootUrl()) ;
    		}	

    
	    $data['title']="Augustine University";

		  //This is the sub title that shows along with title on top bar
	    $data['page_link']  = isset($aPageData['temp_title']) ? $aPageData['temp_title'] : ''; 	 

		  $this->session->set_userdata('section',$this->encrypt->encode(isset($aPageData['sBodyTitle']) ? $aPageData['sBodyTitle'] : '')); //Change to module section
		  
		  $this->session->set_userdata('sub_section',$this->encrypt->encode(isset($aPageData['temp_title']) ? $aPageData['temp_title'] : '')); //Change to module section
		  //$this->AppUser->validateAccess();
		 

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
		  $this->load->view('elibrary/admin/adminLeftMenu',$aPageData); 
		  //End of module level side menu
		  $this->load->view('general/side_menu_end',$data);
		  //ADD MAIN BODY HERE.
		  //Observe naming convention. Check view->sample->sample_dashboard. For example
		  //$this->load->view('sample/sample_dashboard',$data);

		  /*if(isset($aPageData['sBodyContentTemplate'])){
		  	$this->load->view($aPageData['sBodyContentTemplate'],isset($aPageData['mPreparedContent']) ?$aPageData['mPreparedContent'] : null);
           }*/
		  $this->load->view("elibrary/templates/eLibraryContentWrapperAdmin",  $aPageData);
		  //End of module level body
		  $this->load->view('general/right_strip',$data);
		  //ADD MODULE LEVEL RIGH STRIP HERE.
		  //Observe naming convention. Check view->sample->sample_right_strip. For example
		  //$this->load->view('sample/sample_right_strip',$data);
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
	 
		
		// Load App User Models
		//$this->load->model('elibrary/AppUser') ;
		 
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$this->load->library('form_validation');
		$this->load->model('elibrary/portal/MyLibrary') ;

		$this->load->helper(array('url','form','elibrary/elibrary' ));
		$this->load->model('elibrary/AppUser') ;
		//$this->load->helper(array( 'interactive/interactive'));
	}

	 
 

	public function borrowed(){
		//$this->AppUser->validateAccess('elibrary_admin_borrowed');
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aArgs = func_get_args();
		/*echo '<pre>';
		print_r($aArgs);
		echo '</pre>';
		*/



		if(($iReservatonID = (int)$this->uri->segment(4) )> 0){
		//	$this->AppUser->validateAccess('elibrary_admin_borrowed_view');
			$aResult 							=	$this->ElibrarySystem->ReservationsDetails($iReservatonID);

			$aResult = isset($aResult[0])?$aResult[0] : $aResult;
				 
			if(count($aResult) ){
				 
				$aParam['mPreparedContent']	        =	$aResult ;
				$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/resourceBorrowedDetails";
				$aParam['temp_title']				=	"Borrowed Resource details";
				$aParam['sBodyTitle']				=	"Transaction";
				return $this->_bodyContentBuilder($aParam); 
			}
			return show_404(current_url());
 
		}else if($this->uri->segment(4) =='update'){
		//	$this->AppUser->validateAccess('elibrary_admin_borrowed_update');
			if(count($this->input->post(null) > 0)){
				 

				if(strtotime($this->input->post('oPick_up_date')) > strtotime($this->input->post('oReturn_up_date') )){
					echo '<div class="alert alert-warning"> Improper dates detacted. Please review your "Date Collected, Date to be returned" inputs and try again. </div>';
					return;
				}

				$userd  =  $this->AppUser->getUserDetails($this->input->post('user'));
				if(!count($userd )){
					echo '<div class="alert alert-danger">The user code entered could not be linked to any valid account.</div>';
					return;
				}

				$mResponse 		=	$this->ElibrarySystem->adminBorrowResourceToStudent( $userd['lu_id']);
				if($mResponse ===true){
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Your request has been processed successfully.</div>';
				}else if($mResponse ===false){
					echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Your request was not processed successfully.</div>';
				}else{
					echo  $mResponse;
				}
				
				die();
			}
		}



		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'new'){
			//	$this->AppUser->validateAccess('elibrary_admin_borrowed_create');

				$aParam['sBodyContentTemplate'] 	= 	"elibrary/admin/adminBorrowForm";
				$aParam['temp_title']				=	"Borrow Library Catalogue";

				$aParam['sBodyTitle']				=	"Transaction";

				$this->_bodyContentBuilder($aParam);

				return ;
			}else if(isset($aArgs[0]) && isset($aArgs[1]) &&  $aArgs[0] == 'view'){
				$aData['lib_id'] 	=	(int)$aArgs[1];
				return  $this->load->view('elibrary/admin/adminCatalogueListForLibrary',$aData);
			}
		}


		//$this->AppUser->validateAccess('elibrary_admin_borrowed_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/borrowedList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Borrowed Library Resources";
		 
		$aParam['sBodyTitle']				=	"Transaction";
		$this->_bodyContentBuilder($aParam);
	}

	public function returned(){
		//$this->AppUser->validateAccess('elibrary_admin_returned');
		$this->AppUser->validateAccess('elibrary_admin');
		$aParam['sBodyTitle']				=	"Transaction";
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$aArgs = func_get_args();
		/*echo '<pre>';
		print_r($aArgs);id="news_event_form" class="form-horizontals" role="form" name="news_event_form">
		echo '</pre>';
			*/
		if(count($aArgs)){
			if(isset($aArgs[0]) && $aArgs[0] == 'new'){
			//	$this->AppUser->validateAccess('elibrary_admin_returned_new');
				$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminReturnForm";
				$aParam['temp_title']				=	"Return collected Resources";
				 
				$this->_bodyContentBuilder($aParam);

				return ;

			}else if(isset($aArgs[0]) &&   $aArgs[0] == 'crud'){
				//$this->AppUser->validateAccess('elibrary_admin_returned_crud');
				// $aData 	= $this->input->post(null,true);
				if(( $this->input->post('trans') < 1) || strlen(trim($this->input->post('returndate'))) < 5  ) {
					die('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Important information is missing.</div>');
				}
				 echo $this->ElibrarySystem->adminReturnBorrowedItem( ); 
				 die();

			}else if( ( $iID  = (int)$this->uri->segment(4) ) >0){
				//$this->AppUser->validateAccess('elibrary_admin_returned_view');
					//$iID  = 	=	(int)$this->uri->segment(4);
					$aData 	=	$this->ElibrarySystem->getReturnedResourcesDetails($iID);
					$aData 	=	isset($aData[0]) ? $aData[0] : $aData ;
					//print_r($aData);
					//echo count($aData[0]);
					if(!count(@$aData)){
						//show 404 not found
						return show_404(current_url());
						//return ;
					}
					 
				}
		}


		//$this->AppUser->validateAccess('elibrary_admin_returned_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/returnedList";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Returned borrowed resources";
		 
		$this->_bodyContentBuilder($aParam);
	}

	public function violation($aArgs = array()){
		$this->AppUser->validateAccess('elibrary_admin');

		if(count($aArgs) || ($this->uri->segment(4))){
			

			if($this->uri->segment(4) =='crud_violation'){
				$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('admin_violation_title')){
					die('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Please do the right thing.</div>');
				}
				//print_r($aArgs);
				echo  $this->ElibrarySystem->saveAdminViolationRecord($this->input->post(null,true));
			} 
			return;
		}elseif (isset($aArgs[0]) && $aArgs[0] =='change_status') {
			# code...
		

			}

		//	$this->AppUser->validateAccess('elibrary_admin_violation_records');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/adminOffensesList";
		$aParam['temp_title']				=	"Violations";
		$aParam['sBodyTitle']				=	"Transaction";
		$this->_bodyContentBuilder($aParam);
	}
	public function change_status(){
		$this->AppUser->validateAccess('elibrary_admin');
			//print_r($this->input->post(null));
			if(!$this->input->post('status_chager')){
				die('<div class="alert alert-warning"> Please do the right thing.</div>');
			}
			if(!$this->ElibrarySystem->userBorrowViolationstatuschanger()){

				die(  '<div class="alert alert-danger">There  was a problem processing your request.  </div>');
			}
				die(  '<div class="alert alert-success">Your request was processed successful. </div>');
	}

	public function misc($aArgs =array()){
		$this->AppUser->validateAccess('elibrary_admin');
		
		if(count($aArgs) || ($this->uri->segment(4))){
			

			if($this->uri->segment(4) =='crud_category'){
				//$this->AppUser->validateAccess('elibrary_admin');

				if(!$this->input->post('category_title')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				//print_r($aArgs);
				echo  $this->ElibrarySystem->saveCatalogueCategory($this->input->post(null,true));
			}else if($this->uri->segment(4) =='crud_format'){
				//$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('cat_format_title')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->saveCatalogueFormat($this->input->post(null,true));
			}
			else if($this->uri->segment(4) =='crud_subject'){
				//$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('cat_subject_title')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->saveCatalogueSubject($this->input->post(null,true));
			}

			else if($this->uri->segment(4) =='dls'){
			//	$this->AppUser->validateAccess('elibrary_admin');

				if(!$this->input->post('subjectID')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->deleteCatalogueSubjects($this->input->post(null,true));
			} 
			else if($this->uri->segment(4) =='dlf'){
			//	$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('formatID')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->deleteCatalogueFormat($this->input->post(null,true));
			}
			else if($this->uri->segment(4) =='dlv'){
			//	$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('ViolationTypeID')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->deleteMiscViolation($this->input->post(null,true));
			}
			else if($this->uri->segment(4) =='dlc'){
			//	$this->AppUser->validateAccess('elibrary_admin');
				if(!$this->input->post('categoryID')){
					die('<div class="alert alert-warning"> Please do the right thing.</div>');
				}
				echo  $this->ElibrarySystem->deleteCatalogueCategory($this->input->post(null,true));
			}
			

			
			return;
		}

		//$this->AppUser->validateAccess('elibrary_admin_misc');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/misc";
		//$aParam['sBodyContentTemplate']  	= "course_reg/admin_course_mgt";
		
		//$this->main_access_control($this->sRootDir, $view_to_load);
		$aParam['temp_title']				=	"Misc.  Record";
		$aParam['sBodyTitle']				=	"System Management";
		$this->_bodyContentBuilder($aParam);
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

						$sJoin  =	 'LEFT  JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
					break;} # Author
				case 4:	{$sTable = 'lcis.lcis_title';	
							$sJoin  =	 'LEFT    JOIN library_catalog_item_subjects  lcis  ON  lci.lci_id = lcis.lcis_catalog_id  ';
					break;

				}	# Subject
				case 5:	{$sTable = 'lci.lci_callnumber';	break;}	# Call Number

				case 6:	{$sTable = 'lci.lci_publisher';	break;}	# Publisher


				default:{ $sTable = 'CONCAT(lci.lci_title,lcia.lcia_title,lci.lci_callnumber,lcis.lcis_title)   '; 
							$sJoin  =	 ' LEFT JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
							$sJoin  .=	 'LEFT    JOIN library_catalog_item_subjects  lcis  ON  lci.lci_id = lcis.lcis_catalog_id  ';
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
			switch($iField = (int)$this->input->get_post('bsearch_field')){
				case 2:	{$sTable = 'lci.lci_title';	break;} # Title
				case 3:	{$sTable = 'lcia.lcia_title';

						$sJoin  =	 'LEFT  JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
					break;} # Author
				case 4:	{$sTable = 'lcis.lcis_title';	
							$sJoin  =	 'LEFT    JOIN library_catalog_item_subjects  lcis  ON  lci.lci_id = lcis.lcis_catalog_id  ';
					break;

				}	# Subject
				case 5:	{$sTable = 'lci.lci_callnumber';	break;}	# Call Number

				case 6:	{$sTable = 'lci.lci_publisher';	break;}	# Publisher


				default:{ $sTable = 'CONCAT(lci.lci_title,lcia.lcia_title,lci.lci_callnumber,lcis.lcis_title)   '; 
							$sJoin  =	 ' LEFT JOIN library_catalog_item_authors  lcia  ON  lci.lci_id = lcia.lcia_catalog_id ';
							$sJoin  .=	 'LEFT    JOIN library_catalog_item_subjects  lcis  ON  lci.lci_id = lcis.lcis_catalog_id  ';
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

	public function shistory(){
		$aArgs = func_get_args();
		//$this->AppUser->validateAccess('eLibrary_portal_search_history');
		$aParam['sBodyContentTemplate'] 	= "elibrary/admin/search_history";
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







		private function _bodyContentBuilder( $aPageData = array('sBodyContentTemplate'=>'','sPageTitle'=>'', 'f'=>'','sRightContentTemplate'=>'s')){
		
		$sDefaultRightContentTemplate		=		'';
		//$aPageData['sRootDirLink'] 			=		$this->sRootDir;
		
		 if($this->AppUser->isUserTypeAdmin() === false){
        // redirect to Admin Login Page

        		header("Location:../") ;
    		}	

    
	    $aPageData['title']= $this->config->item('system.title');

		  //This is the sub title that shows along with title on top bar
	    $aPageData['page_link']  = isset($aPageData['temp_title']) ? $aPageData['temp_title'] : ''; 	 

		  /*$this->session->set_userdata('section',$this->encrypt->encode(isset($aPageData['sBodyTitle']) ? $aPageData['sBodyTitle'] : '')); //Change to module section
		  
		  $this->session->set_userdata('sub_section',$this->encrypt->encode(isset($aPageData['temp_title']) ? $aPageData['temp_title'] : '')); //Change to module section
		  */
		  //$this->AppUser->validateAccess();
		 

		$this->load->view('elibrary/common/head_top',$aPageData); 
		$this->load->view('elibrary/common/body_wrapper_start',$aPageData); 
		$this->load->view('elibrary/common/content_header',$aPageData); 
		$this->load->view('elibrary/common/left_side_menu_admin',$aPageData); 

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

	private function load_core_libs_and_modelsd(){
		// Load Libraries
		$this->load->helper(array('url','form','restaurant_app/restaurant_app')); 
		$this->load->library(array('session','encrypt'));
		$this->load->library('form_validation'); 
		// Load Database
		$this->load->database();
		//$this->load->model('restaurant_app/AppUser') ;
		 
		//$this->load->model('elibrary/admin/ElibrarySystem') ;
		$this->load->library('form_validation');
		$this->load->model(array('restaurant_app/frontendmodel','restaurant_app/backend','restaurant_app/AppUser'  ) ) ;
		//$this->load->model('result/resultcore') ;
		
	}





	

}
?>