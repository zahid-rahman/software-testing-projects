<?php
  
  //$alibraryType =array( array('id'=>'1','title'=>'Electronic'), array('id'=>'2','title'=>'Physical'));
  $alibraryStatus =array( array('id'=>'1','title'=>'Enabled'), array('id'=>'2','title'=>'Disabled'));

  $config = array(
               array(
                     'field'   => 'library_name', 
                     'label'   => 'Library Name ', 
                     'rules'   => 'required'
                  ),
                           
               array(
                     'field'   => 'lib_address', 
                     'label'   => 'Library Web Address', 
                     'rules'   => 'required'
                  ), 
                  array(
                     'field'   => 'lib_status', 
                     'label'   => 'Library\'s Status', 
                     'rules'   => 'required'
                  ),
                  array(
                     'field'   => 'lib_query_address', 
                     'label'   => 'Library Query Address', 
                     'rules'   => 'required'
                  ),  
               array(
                     'field'   => 'lib_description', 
                     'label'   => 'Description', 
                     'rules'   => 'required'
                  )
            );

     $error = '';
    //$this->ElibrarySystem->saveLibraryRecord($this->input->post());
    $this->form_validation->set_rules($config);
    //var_dump($this->form_validation->run() );
    //print_r($this->input->post('library_form_submit'));
    if($this->input->post('library_form_submit') && $this->form_validation->run()) {
     
            if($this->ElibrarySystem->saveExternalLibraryRecord($this->input->post())){
              $error = '<div class="alert alert-success">Record saved successfully.</div>';
            }else{
              $error = '<div class="alert alert-danger">This Record already exists.   Please review and try again. </div>';
            }
            //$this->form_validation->run();
    }

   
 
?>

<div class="panel panel-primary">
     <div class="panel-heading">System Configuration  Form </div>
            <div class="panel-body">
             <div class="row"> <div class="col-lg-12 pull">  <?php echo validation_errors().$error ; ?></div>  </div>
            
    <!--  <?php echo form_open(current_url(), array('name'=>'library_form','class'=>'form-horizontal', 'role' => 'form', 'method'=>'post')); ?>       -->   
    <form class="form-horizontal" role="form" method="post" name="library_form">
  <div class="form-group">
    <label for="library_name" class="col-lg-2 control-label">Library Name <span class="required_indicator"> *</span></label> 
    <div class="col-lg-10">
      <input required type="text" name="library_name" class="form-control" id="library_name" placeholder="Full / title name of library" value="<?php echo   set_value('library_name', isset($lel_title) ? $lel_title : ''); ?>">
    </div>
  </div>
   <input required type="hidden" name="library_key" value="<?php echo   set_value('library_key', isset($lel_id) ? $lel_id : 0); ?>"/> 

   

  <div class="form-group">
    <label for="lib_address" class="col-lg-2 control-label">Library Web Address  <span class="required_indicator"> *</span></label> 
    <div class="col-lg-10">
      <input required type="text" name="lib_address" class="form-control" id="lib_address" placeholder="Library Web Address "  value="<?php echo   set_value('lib_address', isset($lel_homepage) ? $lel_homepage : ''); ?>">
    </div>
  </div>


  <div class="form-group">
    <label for="lib_query_address" class="col-lg-2 control-label">Library Query Address  <span class="required_indicator"> *</span></label> 
    <div class="col-lg-10">
      <input required type="text" name="lib_query_address" class="form-control" id="lib_query_address" placeholder="Library Query Address"  value="<?php echo   set_value('lib_query_address', isset($lel_searc_page) ? $lel_searc_page : ''); ?>">
    </div>
  </div>



  <div class="form-group">
    <label for="lib_status" class="col-lg-2 control-label">Library's Status <span class="required_indicator"> *</span></label> 
    <div class="col-lg-10">
      <select  required name="lib_status" id="lib_status" class="form-control col-lg-12 required">
      <?php
       echo elibrary_form_select_element($alibraryStatus,set_value('lib_status', isset($lel_enabled) ? $lel_enabled : ''),'id','title','--SELECT LIBRARY STATUS--' );
       

        ?>
        
        
       
      </select>
    </div>
  </div>




  <div class="form-group">
    <label for="lib_description" class="col-lg-2 control-label">Description <span class="required_indicator"> *</span></label>  
    <div class="col-lg-10">
      
      <textarea required class="form-control" id="lib_description" name="lib_description" placeholder="Library's Description"><?php echo   set_value('lib_description', isset($lel_description) ? $lel_description : ''); ?></textarea>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <input  value ="Save Record" name="library_form_submit" type="submit" class="btn btn-primary" />
    </div>
  </div>
</form>
</div>
</div>

