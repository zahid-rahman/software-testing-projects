<?php
/*echo '<pre>';
print_r($mPreparedContent['search_result']);
echo '</pre>';
//die();*/
$bDetailed 	=	true;

$aVals = $mPreparedContent;

/*echo '<pre>';
 $this->AppUser->getUserDepartment($aVals['depcode']);
echo '</pre>';
*/
if(!count($aVals)){
	echo '<div class="alert alert-danger"> This user does not exists.</div>';
	return ;
}

	$sContent =  '
	<div class="panel panel-primary">
                            <div class="panel-heading">User Details </div>
                            <div class="panel-body">



		<div class="row">
			<div class="col-lg-12"> <h3> '.$aVals['username'].' </h3> </div>
			 
		</div>	
		<div class="row">
			 
			 
			<span class="col-lg-8">
			 

				<div class="row">
			<div class="col-lg-12">
						<div class="table-responsive">
						  <table class="table table-striped  table-hover  table-condensed">
						   <tr > <th> <small> Lib ID No.  </small></th> <td> '.($aVals['code']).'  </td>  </tr>
						    
						   
						   <tr > <th> <small> Phone </small></th>  <td> '.$aVals['phn'].'  </td>   </tr>
						   <tr > <th> <small> Email </small></th>  <td> '.$aVals['email'].'  </td>   </tr>
						   <tr > <th> <small> Account Type </small></th>  <td> '.lu_acc_type_display($aVals['lu_acc_type']).'  </td>   </tr>
						
						  </table>
						</div>
			</div>
			</div>



			 </span>
			<span class="col-lg-3"><img src ="'.@getUserImageLink($aVals['passport']).'" class="img-responsive img  img-rounded" alt=" '.$aVals['username'].'"/> </span>
		</div>


		</div> </div>
		';

		echo $sContent;

		 
		?>


  

