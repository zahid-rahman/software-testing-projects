<?php echo   $this->load->view('elibrary/common/head_top',array('temp_title'=>'Login'),true) ?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><?php echo  $this->config->item('system.shortcode'); ?></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <?php if(isset($sMessage)  && strlen($sMessage)){
        ?>
          <div class="row"><div class="col-md-12">  <div class="alert alert-warning"> <?php   echo $sMessage ;?> </div></div> </div>
      
      <?php }
      ?>
      
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input name = "user_id" type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
             
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

         
     <!--    <a href="#">I forgot my password</a><br> -->
        <a href="<?php echo getSystemRootPath('home/register');?>" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    <?php echo   $this->load->view('elibrary/common/body_end',null,true) ?>