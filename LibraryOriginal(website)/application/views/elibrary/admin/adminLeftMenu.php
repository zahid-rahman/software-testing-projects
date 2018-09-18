 <?php $rootdir = $this->config->item("base_url") ; 
 /* echo var_dump($page_link);*/
  $page_link = trim($page_link);
?>
<!--                  
                
                 <li class=" <?php  ($page_link =='Dashboard') ? 'active':'';   ?>  panel"><a href="<?php echo elibraryAdminUrl() ;?>" ><i class="icon-table"></i> Elibrary  Admin Dashboard</a></li> -->
                  

                  <div style="border-bottom:#dddddd 1px solid;">
                 <a href="<?php echo elibraryAdminUrl();?>" style="text-decoration:none;border-bottom:1px;"><h5 class="text-info"><i class="glyphicon glyphicon-circle-arrow-right" style="font-weight:bold;margin-left:2px;"></i> isoLibrary  Admin Dashboard</h5></a>
                 </div>

                 <?php if( $this->AppUser->bHasAccess()) {

                  ?>

                <li class="panel <?php echo  ($page_link =='Import &amp; Export Catalogue' || $page_link =='Resource recommendation' || $page_link =='Catalogue' || $page_link =='Library Users Record' ||  $page_link =='External Library Management' || $page_link =='Library Management' || $page_link =='Misc. Record') ? 'active':'';   ?>  ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-tasks"> </i> System Management    
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       
                    </a>
                    <ul class="collapse" id="component-nav">
                       
 
                         <li class="<?php echo ($page_link =='Catalogue') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('catalog'); ?>"><i class="icon-angle-right"></i> Catalogue </a></li>
                        <li class="<?php echo ($page_link =='Import &amp; Export Catalogue') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('import_export'); ?>"><i class="icon-angle-right"></i> Import / Export (Excel) </a></li>
                        <li class="<?php  echo ($page_link =='Library Management') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('library'); ?>"><i class="icon-angle-right"></i> Local Library Management </a></li>
                        <li class="<?php  echo ($page_link =='External Library Management') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('external_library'); ?>"><i class="icon-angle-right"></i> eLibrary Management </a></li>
                        <li class="<?php echo  ($page_link =='Misc. Record') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('misc'); ?>"><i class="icon-angle-right"></i> Misc Record</a></li>
                        
                         <li class="<?php echo  ($page_link =='Resource recommendation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('recommendation'); ?>"><i class="icon-angle-right"></i>   Recommendation </a></li>
                         <li class="<?php echo  ($page_link =='Library Users Record') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('users'); ?>"><i class="icon-angle-right"></i> Users</a></li>

                        <!-- <li class="<?php echo  ($page_link =='Library Report') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('reports'); ?>"><i class="icon-angle-right"></i> Reports</a></li>
 -->

                    </ul>
                </li>


                 <li class="panel <?php echo  ($page_link =='Resource Reservation' || $page_link =='Borrowed Library Resources' || $page_link =='Returned borrowed resources' || $page_link =='Violations') ? 'active':'';   ?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-transaction">
                        <i class="icon-tasks"> </i> Transaction     
       
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                       
                    </a>
                    <ul class="collapse" id="component-transaction">
                       
                        <li class="<?php  echo ($page_link =='Resource Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('reservations'); ?>"><i class="icon-angle-right"></i>  Resource Reservation </a></li>
                         <li class="<?php echo ($page_link =='Borrowed Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('borrowed'); ?>"><i class="icon-angle-right"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link =='Returned borrowed resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('returned'); ?>"><i class="icon-angle-right"></i> Returned Resources  </a></li>
                        <li class="<?php echo ($page_link =='Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('violation'); ?>"><i class="icon-angle-right"></i>   Violation </a></li>
                        
                    </ul>
                </li>

             
 
                <li class=" <?php  echo ($page_link =='News &amp; Events Record list') ? 'active':'';   ?> panel"><a href="<?php echo elibraryAdminUrl('news_events'); ?>"><i class="icon-tasks"></i> News &amp; Events </a></li>

                <?php 


                } ?>









                <li class="panel <?php echo  ($page_link =='Basic Search' || $page_link =='Advanced Search' || $page_link =='External Search' || $page_link =='My previous search') ? 'active':'';   ?> ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-opac">
                        <i class="icon-tasks"> </i> OPAC   Search
     
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span> 
                      
                    </a>
                    <ul class="collapse" id="component-opac">
                       
                        <li class="<?php echo  ($page_link =='Basic Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('bsearch'); ?>"><i class="icon-angle-right"></i> Basic Search </a></li>
                         <li class="<?php echo  ($page_link =='Advanced Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('asearch'); ?>"><i class="icon-angle-right"></i> Advanced Search </a></li>
                        <li class="<?php echo  ($page_link =='External Search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('esearch'); ?>"><i class="icon-angle-right"></i> External Search </a></li>
                        <li class="<?php echo ($page_link =='My previous search') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('shistory'); ?>"><i class="icon-angle-right"></i> My Previous Search </a></li>
                    </ul>
                </li>


                <li class="panel <?php echo ($page_link =='My Recommended Library Resources' || $page_link =='My Recommendation' || $page_link =='My private Files' || $page_link =='Book Reservation' || $page_link =='Borrowed Resources'  || ( strpos($page_link ,'My private Files - Files Upload') > 0 ) || $page_link =='My Violations' || $page_link =='My private Files - Files Upload') ? 'active':'';   ?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-mylib">
                        <i class="icon-tasks"> </i> My Library     
     
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-mylib">
                       
                        <li class="<?php echo ($page_link =='My private Files') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('my_files'); ?>"><i class="icon-angle-right"></i> My Private Files </a></li>
                        <li class="<?php  echo ($page_link =='Book Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('reservation'); ?>"><i class="icon-angle-right"></i> Book Reservation </a></li>
                        <li class="<?php echo  ($page_link =='Borrowed Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('myborrowed'); ?>"><i class="icon-angle-right"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link =='My Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('violations'); ?>"><i class="icon-angle-right"></i> Violations </a></li>
                         <li class="<?php echo  ($page_link =='My Recommended Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('recommend'); ?>"><i class="icon-angle-right"></i> My  Recommendation </a></li>
                       
                    </ul>
                </li>

                 <li class="panel  <?php echo  ($page_link =='Compose new message' || $page_link =='Inbox' || $page_link =='Sent') ? 'active':'';   ?> ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-msgs">
                        <i class="icon-tasks"> </i> Messages    
       
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-msgs">
                       
                         <li class="<?php echo  ($page_link =='Compose new message') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/compose'); ?>"><i class="icon-angle-right"></i> Compose</a></li>
                        <li class="<?php echo ($page_link =='Inbox') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/inbox'); ?>"><i class="icon-angle-right"></i> Inbox</a></li>
                        <li class="<?php echo  ($page_link =='Sent') ? 'active':'';   ?>"><a href="<?php echo elibraryAdminUrl('messages/sent');?>"><i class="icon-angle-right"></i> Sent </a></li>
                       
                       <!--  <li class=""><a href="javascript:void(0)" ><i class="icon-angle-right"></i> Online Users </a></li> -->
                       
                    </ul>
                </li>

            

                <li class=" <?php echo ($page_link =='Record list') ? 'active':'';   ?>   panel"><a href="<?php echo elibraryAdminUrl('favourite'); ?>"><i class="icon-tasks"></i>  My Shelves</a></li>
 
<!--                 <li class=" <?php  echo ($page_link =='News &amp; Events Record list') ? 'active':'';   ?> panel"><a href="<?php echo elibraryAdminUrl('news_event'); ?>"><i class="icon-tasks"></i> Library News </a></li> -->
                <li class=" <?php echo ($page_link =='Latest') ? 'active':'';   ?>  panel"><a href="<?php echo elibraryAdminUrl('news_event'); ?>"><i class="icon-tasks"></i>   Library News </a></li>

                <li class=" <?php echo ($page_link =='Guide') ? 'active':'';   ?>  panel"><a href="<?php echo elibraryAdminUrl('guide'); ?>"><i class="icon-tasks"></i>   Guide</a></li>

       