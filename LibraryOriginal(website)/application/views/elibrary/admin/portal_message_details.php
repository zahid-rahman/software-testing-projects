
  
<?php /*var_dump($mPreparedContent);*/
$sPerson = '';
$sPerson = '';
if($this->AppUser->getUserId() == $mPreparedContent['lur_reciever_id']){
    $sChecker = $mPreparedContent['lur_sender_id'];
  }else{
    $sChecker = $mPreparedContent['lur_reciever_id'];
  }
  $aPerson   =  $this->AppUser->getUserDetailsById($sChecker);
  $sPerson   = @$aPerson['lu_full_name'];
  $sEmail   =  @$aPerson['lu_email'];
if($mPreparedContent['lur_sender_id'] == $this->AppUser->getUserId()){

  $sWho = '<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">To :</label>
    <div class="col-lg-10">
      <p class="form-control-static">'.$sPerson.' <strong>[ '.  $sEmail .']</strong></p>
    </div>
  </div>';
}else{
   $sWho = '<div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">From :</label>
    <div class="col-lg-10">
      <p class="form-control-static">'.$sPerson.' <strong>[ '.  $sEmail .']</strong></p>
    </div>
  </div>';
}

$sDownload = '';

if($mPreparedContent['lur_has_attachement']){

$sDownload = '<div class="form-group">
    <label for="inputPassword1" class="col-lg-2 control-label">Attachment</label>
    <div class="col-lg-10">
      <p class="form-control-static">Download</p>
    </div>
  </div>';
}
echo '
<div class="panel panel-primary">
  <div class="panel-heading">Message Details <span class="pull-right"> '.$mPreparedContent['lur_msg_date'].' </span></div>
  <div class="panel-body">

    
    <form class="form-horizontal" role="form">
  '.$sWho.'
  <div class="form-group">
    <label for="inputPassword1" class="col-lg-2 control-label">Subject :</label>
    <div class="col-lg-10">
      <p class="form-control-static">'.$mPreparedContent['lur_msg_subject'].'</p>
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword1" class="col-lg-2 control-label">Body :</label>
    <div class="col-lg-10">
      <p class="form-control-static">'.$mPreparedContent['lur_msg'].'</p>
    </div>
  </div>'.$sDownload.'

   
  </form>



  </div>
</div>';

?>

