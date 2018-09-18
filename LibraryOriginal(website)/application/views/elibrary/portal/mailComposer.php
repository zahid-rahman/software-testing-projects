
<?php 
    $sResponse = '';
    if($this->input->post('msg_subject') && $this->input->post('msg_subject') != '' && $this->input->post('msg_subject') != null){

        $userd  =  $this->AppUser->getUserDataOnlyByKey(array( 'lu_email'=>$this->input->post('msg_recievers') ) );
       
        //print_r($userd );
       // die();
        if(!count($userd )){
          $sResponse  =  '<div class="alert alert-danger">The user code entered could not be linked to any valid account.</div>';
         // return;
        }else{
          $sResponse =  $this->MyLibrary->sendMessage();
        }
 
    } 


echo '<!--<div class="panel panel-info">
  <div class="panel-heading">Messaging tips</div>
  <div class="panel-body">
      <div class="alert alert-info"> </div>
  </div>
  </div>-->


<div class="panel panel-primary">
  <div class="panel-heading">Compose message</div>
  <div class="panel-body">
  <span id="msg_ajax_response"> '. $sResponse.'</span>
     

     <form role="form" method="post" target="" name="saveComposedMail">
      <div class="form-group">
        <label for="msg_recievers">Reciever: </label>
        <input required value="'.$this->input->post('msg_recievers').'" id="msg_recievers" name="msg_recievers" type="text" class="form-control"   placeholder="Enter ID">
      </div>
      <div class="form-group">
        <label for="msg_subject">Subject:</label>
        <input required value="'.$this->input->post('msg_subject').'" id="msg_subject" name="msg_subject"  type="text" class="form-control"  placeholder="Enter subject">
      </div>
      <div class="form-group">
        <label for="msg_body">Body:</label>
        <textarea rows = "7" id="elibrary_editor" required class="form-control elibrary_editor" name="msg_body" id = "msg_body" placeholder="Body">'.$this->input->post('msg_body').'</textarea>
      </div>
     <!--  <div class="form-group">
        <label for="attach">Attachement</label>
        <input   name = "attach[]" multiple type="file" id="attach">
        <p class="help-block">You can upload multitple files by clicking on each + your keyboard / keypad control key.</p>
      </div> -->
      
      <button name="saveCOmposedEmails" type="submit" class="btn btn-info">Send Message</button>
    </form>

  </div>
</div>';

?>