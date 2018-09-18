<?php echo   $this->load->view('elibrary/common/head_top',null,true) ?>
  <body class="hold-transition login-page">
  <style type="text/css">
  #install-box{
    width: 60%;
    
    margin: 5% auto;

  }

  </style>
    <div class="box box-info "  id="install-box">
                <div class="box-header with-border">
                  <h3 class="box-title text-center"><?php echo  $this->config->item('system.shortcode'); ?> Installation Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row"> <div class="col-lg-12"> <?php echo  validation_errors(); ?></div> </div>
                <form class="form-horizontal" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="hostname" class="col-sm-2 control-label">Hostname</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('hostname');?>"  name="hostname" class="form-control" id="hostname" placeholder="Hostname" type="text">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="dbuser" class="col-sm-2 control-label">DB User</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('dbuser');?>"   name="dbuser" class="form-control" id="dbuser" placeholder="DB User" type="text">
                      </div>
                    </div>



                    <div class="form-group">
                      <label for="dbpass" class="col-sm-2 control-label">DB Password</label>
                      <div class="col-sm-10">
                        <input    name="dbpass" class="form-control" id="dbpass" placeholder="Database Password" type="password">
                      </div>
                    </div>
                    <hr/>

                    <div class="form-group">
                      <label for="admin" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('admin');?>"  name="admin" class="form-control" id="admin" placeholder="Admin Full Name" type="text">
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="appuser" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('appuser');?>"  name="appuser" class="form-control" id="appuser" placeholder="Admin Email" type="text">
                      </div>
                    </div>

                    




                    <div class="form-group">
                      <label for="apppwd" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input required   name="apppwd" class="form-control" id="apppwd" placeholder="Admin User Password" type="password">
                      </div>
                    </div>
                    <hr/>

                     <div class="form-group">
                      <label for="apptitle" class="col-sm-2 control-label">App Title</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('apptitle');?>"  name="apptitle" class="form-control" id="apptitle" placeholder="Application Title e.g Doyin Library Soft" type="text">
                      </div>
                    </div>


                   

                     <div class="form-group">
                      <label for="appaddress" class="col-sm-2 control-label">Address</label>
                      <div class="col-sm-10">
                        <input required value="<?php echo $this->input->post('appaddress');?>"  name="appaddress" class="form-control" id="appaddress" placeholder="Enter address " type="text">
                      </div>
                    </div>

 



                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    
                    <button type="submit" class="btn btn-info pull-right">Install</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>


      
    <?php echo   $this->load->view('elibrary/common/body_end',null,true) ?>