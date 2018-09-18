<?php echo   $this->load->view('elibrary/common/head_top',array('temp_title'=>'Register'),true) ?>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href=""><?php echo  $this->config->item('system.shortcode'); ?></a>
      </div>

      <div class="register-box-body">
      <?php if(isset($sMessage)  && strlen($sMessage)){
        ?>
          <div class="row"><div class="col-md-12">  <div class="alert alert-warning"> <?php   echo $sMessage ;?> </div></div> </div>
      
      <?php }
      ?>

      <?php if(isset($sSuccess)  && strlen($sSuccess)){
        ?>
          <div class="row"><div class="col-md-12">  <div class="alert alert-success"> <?php   echo $sSuccess ;?> </div></div> </div>
      
      <?php }
      ?>



      
        <p class="login-box-msg">Register a new membership</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input name="lu_full_name" type="text" class="form-control" placeholder="Full name">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="lu_email" type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input name="lu_phn" type="phn" class="form-control" placeholder="Phone Number">
            <span class="glyphicon glyphicon-phn form-control-feedback"></span>
          </div>


          <div class="form-group has-feedback">
            <input  name="lu_pwd" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="lu_pwd2" type="password" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
             
            <div class="col-xs-12">
              <input name="create_account" type="submit" class="btn btn-primary btn-block btn-flat" value="Register" />
            </div><!-- /.col -->

             
          </div>
        </form>

        

        <a href="login" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    <?php echo   $this->load->view('elibrary/common/body_end',null,true) ?>