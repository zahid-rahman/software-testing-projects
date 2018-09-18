<?php $rootdir = $this->config->item("base_url") ; ?>
<?php
    // Secure this for Admins Only
    if($this->AppUser->isUserTypeAdmin() === false){
        // redirect to Admin Login Page
        header("Location:$rootdir"."admin/login_in") ;
    }

    // Get User Details
    $user_id = $this->AppUser->getUserId();
    
    if($user_id !== false){
        // Get User Basic Info
        $a_bio = $this->UserBio->getUserBasicInfo($user_id);
        
        // Format Student Birth Date
        $a_birth_date = $this->UserBio->getUserBirthDate($a_bio['birth_date']);
    }else{
        die("User ID Conflict!");
    }

?>

        <!-- HEADER SECTION -->
        <?php
            $header_data = array(
                'temp_title' => 'Admin eLibrary Dashboard'
            );
            $this->load->view("course_reg/admin_temp_header", $header_data);
        ?>
        <!-- END HEADER SECTION -->
        
        
        <!-- TOP BAR SECTION -->
        <?php
            $topbar_data = array();
            $this->load->view("course_reg/admin_temp_topbar", $topbar_data);
        ?>
        <!-- END TOP BAR SECTION -->


        <!-- MENU SECTION -->
        <?php
            $menu_data = array();
            $this->load->view("elibrary/templates/adminLeftMenu", $menu_data);
            $sContent   =   '';
           // $this->load->view("course_reg/admin_temp_side_menu", $sContent);
        ?>
        <!--END MENU SECTION -->


        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Admin eLibrary Dashboard</h3>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        
                        <!-- Basic Info -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Admin Basic Info
                            </div>
                            <div class="panel-body">
                                
                                <?php
                                    echo "<p>Hello ".$a_bio['first_name']." ".$a_bio['surname']." ".$a_bio['other_name']."!</p>" ;
                                    echo "<p>Here are your other details: Gender, ".$this->UserBio->getUserGender($a_bio['gender']).". Birth Date, ".$a_birth_date.".</p>" ;
                                ?>
                            </div>
                        </div>
                        
                        <!-- Course Registration Progress Timeline -->
                        <div class="panel panel-primary">
                            <div class="panel-heading">Course Registration Process Settings for 2015/2016 Academic Session</div>
                            <div class="panel-body">
                                <span class="label label-success">Not Started</span>
                                <span class="label label-success">Selecting Courses</span>
                                <span class="label label-success">Submitted</span>
                                <span class="label label-info">Approval Pending</span>
                                <span class="label label-warning">Rejected</span>
                                <span class="label label-default">Approved</span>
                                <span class="label label-default">Completed (Approved and Locked)</span>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>  
                
            </div>
        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
            <?php
                $right_strip_data = array();
                $this->load->view("elibrary/templates/adminRightMenu", $right_strip_data);
            ?>
         <!-- END RIGHT STRIP  SECTION -->
    </div>

    <!--END MAIN WRAPPER -->

    <!-- FOOTER -->
        <?php
            $footer_data = array();
            $this->load->view("course_reg/admin_temp_footer", $footer_data);
        ?>
    <!--END FOOTER -->


