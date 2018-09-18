<div class="row">

    <div class="col-lg-6"> 

    <div class="panel panel-primary">
     <div class="panel-heading">Account Update</div>
     <div class="panel-body">


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
                <input required  name="lu_pwd" type="password" class="form-control" placeholder="Enter Current Password  ">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
               
              <div class="row">
                 
                <div class="col-xs-12">
                  <input name="save_account" type="submit" class="btn btn-primary btn-block btn-flat" value="Save Record" />
                </div><!-- /.col -->

                 
              </div>
            </form>

      </div><!-- /.form-box -->

      </div>
      </div>
    </div><!--   end of first half -->

    <div class="col-lg-6"> 

















    <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-blue">
                  <div class="widget-user-image">
                    <img class="img-circle" src="<?php echo getUserImageLink($passport) ; ?>" alt="User image">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><?php echo   isset($lu_full_name) ? $lu_full_name : ''; ?></h3>
                  <h5 class="widget-user-desc"><?php  echo   isset($lu_acc_type) ? lu_acc_type_display($lu_acc_type) : ''; ?></h5>
                </div>
                <div class="box-footer nso-padding">
                <div class="row" style="width: 98%; margin: auto;"> <div class="col-lg-12s">  
                <h3> Password Update Form</h3>




                 <div class="row">
                    <?php
                      /*
                    var_dump($lu_id);
                    die();*/
                     if(isset($sSuccess2)  && strlen($sSuccess2)){
                      ?>
                        <div class="col-md-12">  <div class="alert alert-success"> <?php   echo $sSuccess2 ;?> </div></div> 
                    
                    <?php }
                      if(isset($errors2)  && count($errors2)){
                       // print_r($errors);

                        foreach ($errors2 as   $value) {
                          # code...
                          echo ' <div class="col-md-12">  <div class="alert alert-warning">'.$value.' </div></div> ';
                        }
                      } 
                    ?>

                    </div>

                 <form action="" method="post" enctype="multipart/form-data">
                   
                     
                    <div class="form-group has-feedback">
                    
                      <input required  name="lu_pwd1" type="password" class="form-control" placeholder="Enter Current Password  ">
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                     
                      <input required  name="lu_pwd2" type="password" class="form-control" placeholder="Enter New Password  ">
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>


                    <div class="form-group has-feedback">
                      
                      <input required  name="lu_pwd3" type="password" class="form-control" placeholder="Enter Verify Password  ">
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>



                     
                    <div class="row">
                       
                      <div class="col-xs-12">
                        <input name="update_pwd" type="submit" class="btn btn-primary btn-block btn-flat" value="Update Password" />
                      </div><!-- /.col -->

                       
                    </div>
                  </form>

                  </div></div>

 
                  
                </div>
              </div>















    </div>  <!--  end of second half -->
</div>