<?php 
  $page_link = trim($page_link);
?>
<!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
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
              <a href="<?php echo elibraryPortalUrl();?>">
                <i class="fa fa-home"></i> <span>Home</span>  
              </a>
            </li>
            <li class="treeview" class=" <?php echo  ($page_link =='Basic Search' || $page_link =='Advanced Search' || $page_link =='External Search' || $page_link =='My previous search') ? 'active':'';   ?> ">
              <a href="#">
                <i class="fa fa-search"></i>
                <span> OPAC   Search</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
              <li class="<?php echo  ($page_link =='Basic Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('bsearch'); ?>"><i class="fa fa-circle-o"></i> Basic Search </a></li>
                         <li class="<?php echo  ($page_link =='Advanced Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('asearch'); ?>"><i class="fa fa-circle-o"></i> Advanced Search </a></li>
                        <li class="<?php echo  ($page_link =='External Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('esearch'); ?>"><i class="fa fa-circle-o"></i> e-Library </a></li>
                        <li class="<?php echo ($page_link =='My previous search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('shistory'); ?>"><i class="fa fa-circle-o"></i> My Previous Search </a></li>
                 
              </ul>
            </li>



            <li class="treeview" class="<?php echo ($page_link =='My Recommended Library Resources' || $page_link =='My Recommendation' || $page_link =='My private Files' || $page_link =='Book Reservation' || $page_link =='Borrowed Resources'  || ( strpos($page_link ,'My private Files - Files Upload') > 0 ) || $page_link =='Violations' || $page_link =='My private Files - Files Upload') ? 'active':'';   ?> ">
              <a href="#">
                <i class="glyphicon glyphicon-education"></i>
                <span> My Library  </span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">                  
                      <li class="<?php echo ($page_link =='My private Files') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('my_files'); ?>"><i class="fa fa-circle-o"></i> My Private Files </a></li>
                        <li class="<?php  echo ($page_link =='Book Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('reservation'); ?>"><i class="fa fa-circle-o"></i> Book Reservation </a></li>
                        <li class="<?php echo  ($page_link =='Borrowed Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('borrowed'); ?>"><i class="fa fa-circle-o"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link =='Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('violations'); ?>"><i class="fa fa-circle-o"></i> Violations </a></li>
                        <li class="<?php echo  ($page_link =='My Recommended Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('recommend'); ?>"><i class="fa fa-circle-o"></i> My  Recommendation </a></li>





                 
              </ul>
            </li>


            <li class="treeview" class=" <?php echo  ($page_link =='Compose new message' || $page_link =='Inbox' || $page_link =='Sent') ? 'active':'';   ?> ">
              <a href="#">
                <i class="fa fa-envelope"></i>
                <span> Mesages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 

                <li class="<?php echo  ($page_link =='Compose new message') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/compose'); ?>"><i class="icon-angle-right"></i> Compose</a></li>
                        <li class="<?php echo ($page_link =='Inbox') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/inbox'); ?>"><i class="icon-angle-right"></i> Inbox</a></li>
                        <li class="<?php echo  ($page_link =='Sent') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/sent');?>"><i class="icon-angle-right"></i> Sent </a></li>
                 
              </ul>
            </li>


            <li class=" <?php echo ($page_link =='Record list') ? 'active':'';   ?>   "><a href="<?php echo elibraryPortalUrl('favourite'); ?>"><i class="fa fa-dashboard"></i> <span>My Shelves</span>  
              </a>
            </li>

            <li  class=" <?php echo ($page_link =='Latest') ? 'active':'';   ?>  "><a href="<?php echo elibraryPortalUrl('news_events'); ?>">
                <i class="fa fa-bullhorn"></i> <span>News &amp; Events</span>  
              </a>
            </li>

             <li class=" <?php echo ($page_link =='Guide') ? 'active':'';   ?>  "><a href="<?php echo elibraryPortalUrl('guide'); ?>"><i class="fa fa-key"></i> <span>Guide</span></a></li>


 
            
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->