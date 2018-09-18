<?php 
  $page_link = trim($page_link);
?>
<!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar ">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div> -->
          <!-- search form -->
          <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li>
              <a href="<?php echo elibraryAdminUrl();?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>  
              </a>
            </li>



            <?php 

              if( $this->AppUser->bHasAccess()) 
                {

            ?>



             <li class="treeview <?php echo  ($page_link =='Import &amp; Export Catalogue' || $page_link =='Resource recommendation' || $page_link =='Catalogue' || $page_link =='Library Users Record' ||  $page_link =='External Library Management' || $page_link =='Library Management' || $page_link =='Misc. Record') ? 'active':'';   ?>  ">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span> System Management </span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
               
               <li class="<?php echo ($page_link =='Catalogue') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('catalog'); ?>"><i class="fa fa-circle-o"></i> Catalogue </a></li>
                        <li class="<?php echo ($page_link =='Import &amp; Export Catalogue') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('import_export'); ?>"><i class="fa fa-circle-o"></i> Import / Export (Excel) </a></li>
                        <li class="<?php  echo ($page_link =='Library Management') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('library'); ?>"><i class="fa fa-circle-o"></i> Local Library Management </a></li>
                        <li class="<?php  echo ($page_link =='External Library Management') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('external_library'); ?>"><i class="fa fa-circle-o"></i> eLibrary Management </a></li>
                        <li class="<?php echo  ($page_link =='Misc. Record') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('misc'); ?>"><i class="fa fa-circle-o"></i> Misc Record</a></li>
                        
                         <li class="<?php echo  ($page_link =='Resource recommendation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('recommendation'); ?>"><i class="fa fa-circle-o"></i>   Recommendation </a></li>
                         <li class="<?php echo  ($page_link =='Library Users Record') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('users'); ?>"><i class="fa fa-circle-o"></i> Users</a></li>


                 
              </ul>
            </li>






            <li class="treeview <?php echo  ($page_link =='Resource Reservation' || $page_link =='Borrowed Library Resources' || $page_link =='Returned borrowed resources' || $page_link =='Violations') ? 'active':'';   ?> ">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span>Transaction</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
              <li class="<?php  echo ($page_link =='Resource Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('reservations'); ?>"><i class="fa fa-circle-o"></i>  Resource Reservation </a></li>
                         <li class="<?php echo ($page_link =='Borrowed Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('borrowed'); ?>"><i class="fa fa-circle-o"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link =='Returned borrowed resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('returned'); ?>"><i class="fa fa-circle-o"></i> Returned Resources  </a></li>
                        <li class="<?php echo ($page_link =='Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('violation'); ?>"><i class="fa fa-circle-o"></i>   Violation </a></li>
                 
              </ul>
            </li>

            <li class=" <?php  echo ($page_link =='News &amp; Events Record list') ? 'active':'';   ?> "><a href="<?php echo elibraryAdminUrl('news_events'); ?>"><i class="fa fa-calendar"></i> <span> News &amp; Events </span>  
              </a>
            </li>








            <?php 


              } ?>



            <li class="treeview  <?php echo  ($page_link =='Basic Search' || $page_link =='Advanced Search' || $page_link =='External Search' || $page_link =='My previous search') ? 'active':'';   ?> ">
              <a href="#">
                <i class="fa fa-search"></i>
                <span> OPAC   Search</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
              <li class="<?php echo  ($page_link =='Basic Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('bsearch'); ?>"><i class="fa fa-circle-o"></i> Basic Search </a></li>
                         <li class="<?php echo  ($page_link =='Advanced Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('asearch'); ?>"><i class="fa fa-circle-o"></i> Advanced Search </a></li>
                        <li class="<?php echo  ($page_link =='External Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('esearch'); ?>"><i class="fa fa-circle-o"></i> e-Library </a></li>
                        <li class="<?php echo ($page_link =='My previous search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('shistory'); ?>"><i class="fa fa-circle-o"></i> My Previous Search </a></li>
                 
              </ul>
            </li>



            <li class="treeview <?php echo ($page_link =='My Recommended Library Resources' || $page_link =='My Recommendation' || $page_link =='My private Files' || $page_link =='Book Reservation' || $page_link =='Borrowed Resources'  || ( strpos($page_link ,'My private Files - Files Upload') > 0 ) || $page_link =='My Violations' || $page_link =='My private Files - Files Upload') ? 'active':'';   ?> ">
              <a href="#">
                <i class="glyphicon glyphicon-education"></i>
                <span> My Library  </span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">                  
                      <li class="<?php echo ($page_link =='My private Files') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('my_files'); ?>"><i class="fa fa-circle-o"></i> My Private Files </a></li>
                        <li class="<?php  echo ($page_link =='Book Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('reservation'); ?>"><i class="fa fa-circle-o"></i> Book Reservation </a></li>
                        <li class="<?php echo  ($page_link =='Borrowed Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('myborrowed'); ?>"><i class="fa fa-circle-o"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link ==' My Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('violations'); ?>"><i class="fa fa-circle-o"></i> Violations </a></li>
                        <li class="<?php echo  ($page_link =='My Recommended Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('recommend'); ?>"><i class="fa fa-circle-o"></i> My  Recommendation </a></li>





                 
              </ul>
            </li>


            <li class="treeview  <?php echo  ($page_link =='Compose new message' || $page_link =='Inbox' || $page_link =='Sent') ? 'active':'';   ?> ">
              <a href="#">
                <i class="fa fa-envelope"></i>
                <span> Mesages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 

                <li class="<?php echo  ($page_link =='Compose new message') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/compose'); ?>"><i class="fa fa-circle-o"></i> Compose</a></li>
                        <li class="<?php echo ($page_link =='Inbox') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/inbox'); ?>"><i class="fa fa-circle-o"></i> Inbox</a></li>
                        <li class="<?php echo  ($page_link =='Sent') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/sent');?>"><i class="fa fa-circle-o"></i> Sent </a></li>
                 
              </ul>
            </li>


            <li class=" <?php echo ($page_link =='Record list') ? 'active':'';   ?>   "><a href="<?php echo elibraryAdminUrl('favourite'); ?>"><i class="fa fa-dashboard"></i> <span>My Shelves</span>  
              </a>
            </li>

            <li  class=" <?php echo ($page_link =='Latest') ? 'active':'';   ?>  "><a href="<?php echo elibraryAdminUrl('news_event'); ?>">
                <i class="fa fa-bullhorn"></i> <span>News &amp; Events</span>  
              </a>
            </li>

             <li class=" <?php echo ($page_link =='Guide') ? 'active':'';   ?>  "><a href="<?php echo elibraryAdminUrl('guide'); ?>"> <i class="fa fa-key"></i>  <span> Guide</span> </a></li>
 


 
            
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->