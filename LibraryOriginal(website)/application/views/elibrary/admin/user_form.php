      <div class="register-box-body">
      <div class="row">
      <?php
/*
      var_dump($lu_id);
      die();*/
       if(isset($sSuccess)  && strlen($sSuccess)){
        ?>
          <div class="col-md-12">  <div class="alert alert-success"> <?php   echo $sSuccess ;?> </div></div> 
      
      <?php }
        if(isset($errors)  && count($errors)){
         // print_r($errors);

          foreach ($errors as   $value) {
            # code...
            echo ' <div class="col-md-12">  <div class="alert alert-warning">'.$value.' </div></div> ';
          }
        } 
      ?>

      </div>
         
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="lu_id" value="<?php echo   set_value('lu_id', isset($lu_id) ? $lu_id : $this->input->post('lu_id')); ?>">
          <div class="form-group has-feedback">
            <input required name="lu_full_name" type="text" class="form-control" placeholder="Full name" value="<?php echo   set_value('lu_full_name', isset($lu_full_name) ? $lu_full_name : $this->input->post('lu_full_name')); ?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input required name="lu_email" type="email" class="form-control" placeholder="Email" value="<?php echo   set_value('lu_email', isset($lu_email) ? $lu_email : $this->input->post('lu_email')); ?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input required name="lu_phn" type="text" class="form-control" placeholder="Phone Number" value="<?php echo   set_value('lu_phn', isset($lu_phn) ? $lu_phn : $this->input->post('lu_phn')); ?>">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
          <lebel> Passport</lebel>
            <input  name="passport" type="file" class="form-control"  >
            <span class="glyphicon glyphicon-file form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
           <lebel> Account Group</lebel>             
            <select required class="form-control" name="lu_acc_type">

            <?php
              echo elibrary_form_select_element(lu_acc_type(), set_value('lu_acc_type', isset($lu_acc_type) ? $lu_acc_type : $this->input->post('lu_acc_type'))  ,'id','title','--Account Access Group--' );
            ?>
 
            </select>            
          </div>

          <div class="form-group has-feedback">  
          <lebel> Account Status</lebel>

            <select required class="form-control" name="lu_acc_status">
            <?php
              echo elibrary_form_select_element(account_acti_status(), set_value('lu_acc_status', isset($lu_acc_status) ? $lu_acc_status : $this->input->post('lu_acc_status'))  ,'id','title','--Account Status--' );
            ?>
 
            </select>            
          </div>





          <div class="form-group has-feedback">
            <input  name="lu_pwd" type="password" class="form-control" placeholder="Password (You can leave blank to generate a password for new account only or to maintain old password)">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="lu_pwd2" type="password" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
             
            <div class="col-xs-12">
              <input name="create_account" type="submit" class="btn btn-primary btn-block btn-flat" value="Save Record" />
            </div><!-- /.col -->

             
          </div>
        </form>

      </div><!-- /.form-box -->