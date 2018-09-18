<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load_core_libs_and_models();
		//$this->output->enable_profiler(TRUE);
		//  print_r($this->session->all_userdata());
	}
	public function logout(){
		$this->AppUser->logout();
		redirect('home/index','refresh');
	}

	public function index()
	{
		// You can add what ever funtionality here 

		// just for testing purposes during automated security test
		/*$aData 	=	 $this->AppUser->getUserDataOnlyByKey(array('lu_id'=>1));
		if($aData['lu_acc_status'] == 1){
					// unset($aFields['lu_pwd']);
					$this->session->set_userdata($aData);
					if($aData['lu_acc_type'] < 2){
						//die(' na for here ');
						redirect('elibrary/portal','refresh');
						exit();
					}
					redirect('elibrary/admin','refresh');
				}

*/
	 
		 $this->login();
 
		

	}

	public function login(){
		$this->session->unset_userdata();
		$aData['sMessage'] 		=	'';
		if($this->input->post('password') && $this->input->post('user_id')){
			if($aData 	=	$this->AppUser->login($this->input->post(null,true))){
				  
				if($aData['lu_acc_status'] == 1){
					// unset($aFields['lu_pwd']);
					$this->session->set_userdata($aData);
					if($aData['lu_acc_type'] < 2){
						//die(' na for here ');
						redirect('elibrary/portal','refresh');
						exit();
					}
					redirect('elibrary/admin','refresh');
				}else{
					$aData['sMessage'] 		=	'Your account seems to be deactivated. Kindly contact system admin for assistance.';
				}
				//redirect();
			}else{
				$aData['sMessage'] 		=	'You have supplied an invalid login credentials';
			}
		}


		$this->load->view('elibrary/cms/login',$aData);
		
	}


	public function register(){

		//print_r($this->input->post());
		 
		$this->session->unset_userdata();
		$aData['sMessage'] 		=	'';
		if($this->input->post('create_account') ){
			if($this->input->post('lu_pwd') === $this->input->post('lu_pwd2')){

				$aContent 	=	$this->input->post(null,true);
				$aContent['lu_acc_type'] 	=	1;

				 $aVerifyData 	=	 $this->AppUser->getUserDetailsById($this->input->post('lu_email'),'lu_email' );

				 if(!count( $aVerifyData)){				

					$mReturned 	=	$this->AppUser->createAccount($aContent);
					if($mReturned){
						  $aData 	=	 $this->AppUser->getUserDetailsById($mReturned);
	 						
						if($aData['lu_acc_status'] == 1){
							 
							$this->session->set_userdata($aData);  
							//userRootUrl();
							$this->session->set_userdata(array('sSuccess'=>'Your account has been created successfully.'));  
							$aData['sSuccess'] 		=	'Your account has been created successfully. Kindly log in to your account.';

							//redirect('home/login','refresh');
						} else{
							$aData['sMessage'] 		=	'Your account could not be created. Kindly contact system admin for assistance.';
						}
						//redirect();
					}else{
						$aData['sMessage'] 		=	'You have supplied an invalid login credentials';
					}
				}else{
					$aData['sMessage']			=	'This email seems to be taken already. Kindly review your supplied information and try again.';
				}	


			}else{
				$aData['sMessage'] 		=	'Your passwords do not match';
			}
			
		}



		$this->load->view('elibrary/cms/register',$aData);
		
	}


		public function install(){
		//echo 'welcome to the installer';
			echo '<h1>Kindly read the installation and user manual attached to this file</h1>';
			die();

		if($this->input->post()){
			$aValidation = array(
	               array(
	                     'field'   => 'hostname', 
	                     'label'   => 'Hostname', 
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'dbuser', 
	                     'label'   => 'DB User', 
	                     'rules'   => 'required'
	                  ), 
	              /* array(
	                     'field'   => 'dbpass', 
	                     'label'   => 'DB Password', 
	                     'rules'   => 'required'
	                  ), */
	               array(
	                     'field'   => 'admin', 
	                     'label'   => 'Admin Full Name', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'appuser', 
	                     'label'   => 'Email', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'apppwd', 
	                     'label'   => 'Admin User Password', 
	                     'rules'   => 'required'
	                  ) 
	               , 
	               array(
	                     'field'   => 'apptitle', 
	                     'label'   => 'App Title', 
	                     'rules'   => 'required'
	                  ) , 
	               array(
	                     'field'   => 'appaddress', 
	                     'label'   => 'Address', 
	                     'rules'   => 'required'
	                  )  



            	);
			 $this->form_validation->set_error_delimiters('<div class="alert alert-warning">', '</div>');
			$this->form_validation->set_rules($aValidation);

			if($this->form_validation->run()){
				$aParam['errors'] 	=	 	array();

				
			}else{
				$aParam['errors'][]	  	=	  validation_errors();
			}
			
		}

		//	print_r($aParam);
		$aData = array();
		$this->load->view('elibrary/cms/install',$aData);
	}



	private function load_core_libs_and_models(){
		// Load Libraries
		$this->load->library(array('session','encrypt'));
		$this->load->library('form_validation');
				// Load Database
		$this->load->database();
		
		// Load Helpers
	 
		
		// Load App User Models
		
		 
		$this->load->model('elibrary/admin/ElibrarySystem') ;
		$this->load->library('form_validation');
		$this->load->model('elibrary/portal/MyLibrary') ;

		$this->load->helper(array('url','form','elibrary/elibrary' )); 

		$this->load->model('elibrary/AppUser') ;
		//$this->load->helper(array( 'interactive/interactive'));
	}

	
}
