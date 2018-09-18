<?php
	
	function getSystemRootPath($sPath = ''){

		return base_url($sPath);
	}

	function getAdminRootPath($sPath = ''){

		return getSystemRootPath('staff/'.$sPath);
	}

	function translate_status($iStatus = 0){
		if($iStatus == 1){
			return 'Active';
		}else{
			return "Inactive";
		}
	}

	function convert2currency($mRecord  =  0 ){
		$mRecord 	= 	(int)$mRecord;
		return number_format($mRecord,2);
	}

	function restaurant_app_form_select_element($data =array(), $select ='',$k ='', $v ='',$label='--SELECT --',$mSelectValue = '',$bEnableSelect =true){
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

	function getGenders(){
		return array(array('id'=>'1','title'=>'Male'),array('id'=>'2','title'=>'Female'));
	}

	function getStatusTranslation(){
		return array(array('id'=>'0','title'=>'Disabled'),array('id'=>'1','title'=>'Enabled'));
	}

?>