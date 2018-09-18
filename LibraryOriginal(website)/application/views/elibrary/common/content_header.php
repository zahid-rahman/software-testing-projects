      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo  userRootUrl(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo  $this->config->item('system.shortcode'); ?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo  $this->config->item('system.shortcode'); ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
               <?php  $aAlert  =  $this->AppUser->getNewMessageAlert();  
               
               $aUserDetails    = $this->AppUser->getUserDetailsById($this->AppUser->getUserId()); 
               ?>
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"> <?php echo count($aAlert); ?></span>
                </a>
                <ul class="dropdown-menu">
               
                  <li class="header">You have <?php echo count($aAlert); ?> message(s)</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php  
                          foreach ($aAlert as $key => $value) {
                            # code...
                            echo '<li> <a href="'.userRootUrl('messages/'.$value['lur_id']).'">  ';

                            ?>
                              <div class="pull-left">
                                <img src="<?php echo getUserImageLink($value['passport']) ; ?>" class="img-circle" alt="User Image">
                              </div>
                              <h4>
                            <?php echo myTruncate($value['lu_full_name'],20) ; ?>
                           <!--  <small><i class="fa fa-clock-o"></i> <?php echo $value['lur_msg_date'] ; ?></small> -->
                          </h4>
                          <p><?php echo myTruncate($value['lur_msg_subject'],20)  ; ?></p>
                        </a>
                      </li>


                            <?php 


                          }
                      ?>

 

                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo  userRootUrl('messages/inbox/'); ?>">See All Messages</a></li>
                </ul>
              </li>
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo getUserImageLink($aUserDetails['passport'])  ; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $aUserDetails['lu_full_name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo getUserImageLink($aUserDetails['passport'])  ; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $aUserDetails['lu_full_name']; 
 
                     //die();
                      ?>
                      <small>Member since <?php echo $aUserDetails['lu_reg_date']  ; ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                   
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo   userRootUrl('myprofile');  ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('home/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->