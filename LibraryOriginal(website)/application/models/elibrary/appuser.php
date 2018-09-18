<?php

class AppUser extends CI_Model{	
	 
	private $app_user_id ;
	private $aAccesses 			=		null;
	private $iSession 			=		null;
	private $sSemester 			=		null;
	private $aStudent 			=		array();


	function __construct(){
	 
       // date_default_timezone_set("Africa/Lagos");
	 
        parent::__construct();
        //$this->db->query("SET time_zone = 'Africa/Lagos' ");

        //  set_time_limit(0);
       // print_r($this->uri->segment(1));

        if(!$this->config->item('system.installed') && !$this->input->get('installerKey')){
        	redirect('./install?installerKey='.md5(time()),'refresh');
        }

        if( $this->config->item('system.installed') && ( $this->uri->segment(1) =='install') ){
        	redirect('./','refresh');
        }

        //$this->output->enable_profiler(true);
		 
	}

	public function updateMyPassword($aData 	=	 array()){
		$this->db->where(array('lu_id'=>$aData['lu_id']))->set(array('lu_pwd'=> $aData['lu_pwd']))->update('library_users');

		return true;
	}

	public function getUserDataOnlyByKey($newdata = array()){
		if(!count($newdata)){
			return false;
		}
		//$newdata 	=	 array('lu_email'=> $aData['user_id'], 'lu_pwd'=>md5($aData['password']));
		
		return  $this->db->get_where('library_users', $newdata )->row_array();
	}

	public function login($aData =array()){
	//	print_r($this->input->post());
		$newdata 	=	 array('lu_email'=> $aData['user_id'], 'lu_pwd'=>md5($aData['password']));
		
		return  $this->db->get_where('library_users', $newdata )->row_array();
 
		
	}
	public function updateProfile($aData = array(), $iKey = 0){

		$this->db->where(array('lu_id'=>$iKey))->set($aData)->update('library_users');

		return true;
	}

	public function logout(){
		$this->session->sess_destroy();
	}

	public function getUserDetailsById($iId = 0, $sKey = 'lu_id'){
		$newdata 	=	 array($sKey=> $iId );
		
		return  $this->db->get_where('library_users', $newdata )->row_array();
	}

	public function createAccount($aData = array()){


		$aFields 	=	  array(
			'lu_full_name'=> $aData['lu_full_name'], 
			'lu_email'=> $aData['lu_email'], 
			'lu_acc_type'=> $aData['lu_acc_type'],
			'passport'=>'passport.png',
			'lu_reg_date'=>time(),
			'lu_phn'=> $aData['lu_phn'], 
			'lu_pwd'=>md5($aData['lu_pwd']));

		$this->db->insert('library_users', $aFields);

		if($this->db->insert_id()){
			return $this->db->insert_id();
		}
		return false;
	}


	public function createAccountAdmin($aData = array(),$key =  0){

		if($key > 0){
			$this->db->where('lu_id', $key )->update('library_users', $aData);
			return $key;
		}else{
			$this->db->insert('library_users', $aData);
		}

		

		if($this->db->insert_id()){
			return $this->db->insert_id();
		}

		return false;
	}

	public function isLiveHost(){
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    		return false;
		} else {
		   return true;
		}
	}
	function getUserDepartment($sUnit = ''){
		$sUnit  = $this->db->escape($sUnit);
		$sSql = "SELECT unit_name FROM unit WHERE unit_ass_id = ".$sUnit." AND unit_status = '1' limit 1;";
		$query = $this->db->query($sSql);
		
		if ($query->num_rows() > 0){

			$aRecord 	=	$query->result_array();
			$aRecord  = isset($aRecord[0]) ?$aRecord[0] : $aRecord;
			 	//var_dump($aRecord['unit_name']);
				return @$aRecord['unit_name'];
			 
		}
		return '';

	}

	public function bHasAccess($sModule = 'elibrary_admin'){

		$priveledege  	=	0;
		switch($sModule){
			case 'elibrary_admin' :  { $priveledege  = 3;  break;}
			case 'elibrary' :  { $priveledege  = 2; break;}
			default :{ $priveledege  = 1; }
		}

		//return true;
		//$modules = explode(",",$this->aAccesses);
		/*print_r($this->aAccesses);
		die($priveledege);
*/
	  	if(!is_numeric(array_search($priveledege,$this->aAccesses))){
	  		 return false;
         }
         return true;
	}


	 


	public function getMySetSession(){
		//return '2015';
		if(!(bool)$this->iSession){
			$this->iSession = $this->session->userdata('elibrary_system_user_current_session');
		}
		return ($this->iSession);
	}
	public function setMyWorkSpace($sSession = '',$sSemester = ''){
		$this->session->set_userdata('elibrary_system_user_current_session',($sSession));
		$this->session->set_userdata('elibrary_system_user_current_semester',($sSemester));
	}

	
 
	public function getMySetSemester(){
		//return 'Semester 1';
		//$this->initialize();
		//var_dump($this->session->userdata('elibrary_system_user_current_semester'));
		if(!(bool)$this->sSemester){
			//$this->initialize();
			$this->sSemester  =  $this->session->userdata('elibrary_system_user_current_semester');
		}
		return ($this->sSemester);
	}




	public function getUserUsableSessions(){
		$sSql	="SELECT * FROM ";
		$this->db->query($sSql);
	}

	public function getUserDetails($sUserID = ''){
		return $this->getUserDetials($sUserID);
	}

	public function getUserDetials($sUserID = '',$bNameOnly = false){
		//$sUserID  = $this->db->escape($sUserID);

		//$query =  $this->db->query("SELECT * FROM student_info WHERE student_info_user_id = ".$sUserID);
 

		$sSql = " SELECT    sbi.*, sbi.lu_id as code,   sbi.lu_phn as phn, sbi.lu_email as email,    sbi.lu_full_name AS username FROM library_users sbi    WHERE sbi.lu_id = ".(int)($sUserID)." OR sbi.lu_email = ".$this->db->escape($sUserID)." LIMIT 1";

		//$query = $this->db->get_where('library_users sbi');


		$query = $this->db->query($sSql);
		
		if ($query->num_rows() > 0){

			$aRecord 	=	$query->result_array();
			$aRecord  = isset($aRecord[0]) ?$aRecord[0] : $aRecord;
			 	//var_dump($aRecord);
			if(!$bNameOnly){

				return $aRecord;
			}

			return $aRecord['username'];
			 
		}
		return null;
	}

	public function getUserFullName(){
		return ucwords($this->session->userdata('lu_full_name'));

	}
	
	public function getCurrentSystemSession(){
		return $this->encrypt->decode($this->session->userdata('current_session'));
	}
	public function getCurrentSystemSemester(){
		return  $this->encrypt->decode($this->session->userdata('current_semester'));
	}

	public function initialize(){
 		 
		/*print_r($this->session->userdata('lu_id'));

		var_dump($this->session->userdata('lu_id'));
		die($this->session->userdata('lu_id'));
*/		/*
		$newdata 	=	 array('lu_id'=>3);
  		
	   // $user_id = $this->getUserId();
		$aData 	=	$this->AppUser->getUserDataOnlyByKey($newdata );
  		$this->session->set_userdata($aData);*/
		if( $this->session->userdata('lu_id')  < 1){
			$sReturnUrl = Current_url();
			$error_message = 'You need to be logged in to view this page.';
			//die('na for here o');
			send2login(array('post_back'=>$sReturnUrl, 'msg'=>$error_message));
		}
		
	    $this->aAccesses = range(1, $this->session->userdata('lu_acc_type') ) ;
	}

	
	function getUserByUniqueId($sId = ''){
		 
		 
		$sSql 	=	" SELECT sbi.lu_full_name AS username FROM library_users sbi  WHERE sbi.lu_id = ".(int)($sId)."  OR sbi.lu_email = ".$this->db->escape($sId)." LIMIT 1";

		$query = $this->db->query($sSql);
		
		if ($query->num_rows() > 0){

			$aRecord 	=	$query->result_array();
			$aRecord  = isset($aRecord[0]) ?$aRecord[0] : $aRecord;
			 	//var_dump($aRecord);
				return $aRecord['username'];
			 
		}
		return null;

		//return $this->db->result();
	}

	
	/*** APP USER MAIN INFO REQUEST METHODS ***/
	
	public function isLoggedIn(){
	 

		if($this->session->userdata('lu_id')  < 1){
			return false;
		}
		return true;
		 
	}

	public function getUserCode(){

	}

	public function getNewMessageAlert($user_id = 0){
		if(!$user_id){
			$user_id =  $this->getUserId();
		}
		return $this->db->join('library_users lu','lum.lur_sender_id  =lu.lu_id','left')->get_where('library_user_message lum', array('lum.lur_msg_read' => '0',  'lum.lur_reciever_id' =>$user_id))->result_array();
		return ;
	}



	public function validateAccess($sAccess = ''){
		if($sAccess){

		}else {
			$sAccess  	=	null;
		}

		 
	  	 
	  	if(!$this->bHasAccess($sAccess)){
	  		if($this->input->is_ajax_request()){
        		die("<script> alert('You do not have access to this page.'); 
        				setTimeout(function(){ window.location.href = '".base_url()."';}, 700);
        			</script>");
        	}
	      	
	      	die(/*'You do not have access to '.$sModule*/);
         }
	}

	public function setAccessControl($sModule = 'elibrary', $sAccess = 'elibrary_admin'){
		$this->session->set_userdata('user_module',$this->encrypt->encode($sModule.','.$sAccess)); 
	}


	public function getUserUniqueId(){

	}

	public function getUserId(){
		//var_dump(expression)
		if($this->isLoggedIn() === true){
			$this->app_user_id =  $this->session->userdata('lu_id')  ;
			return $this->app_user_id ;
		}
		//send2login();
		return false;
	}

	public function getUserType($user = null){
		//For checking using and staff access
		 

		$user  =  ($user != null) ?$user  : $this->getUserId() ;
		$data =  $this->getUserDetailsById($user);

		if(isset($data['lu_acc_type']) && ($data['lu_acc_type'] > 1)  )
		{
		  return 'staff';
		}else{
			return 'student';
		}
	 
	}
	
	public function getUserTypeId(){
		/*
			1 - Student
			2 - Staff
			3 - Admin
		*/
		if($this->isUserTypeStudent() === true){
			return 1 ;
		}else if($this->isUserTypeStaff() === true){
			return 2 ;
		}else if($this->isUserTypeAdmin() === true){
			return 3 ;
		}
		return false;
	}
	
	public function isUserTypeStudent(){
		if($this->getUserType() == "student"){ return true; }
		return false;
	}

	public function isUserTypeStaff(){
		if($this->getUserType() == "staff"){ return true; }
		return false;
	}

	public function isUserTypeAdmin(){
		//return true;
		if($this->getUserType() == "staff"){ return true; }
		return false;
	}
	
	public function isStaffAccess(){
		if($this->isUserTypeStaff() || $this->isUserTypeAdmin()){
			return true;
		}
		return false;
	}
 
 
  
	 
	public function logoutUser(){
		 
		$this->session->sess_destroy();
		send2login();
		return true ;
	}
	 
	
}

 
?>