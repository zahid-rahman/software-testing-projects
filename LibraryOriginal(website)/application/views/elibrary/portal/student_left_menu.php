<?php $rootdir = $this->config->item("base_url") ; 
  //echo var_dump($page_link);
  $page_link = trim($page_link);
?>

<div style="border-bottom:#dddddd 1px solid;">
                 <a href="<?php echo elibraryPortalUrl();?>" style="text-decoration:none;border-bottom:1px;"><h5 class="text-info"><i class="glyphicon glyphicon-circle-arrow-right" style="font-weight:bold;margin-left:2px;"></i> isolibrary Home</h5></a>
                 </div>
              
                 
                 <li class="panel <?php echo  ($page_link =='Basic Search' || $page_link =='Advanced Search' || $page_link =='External Search' || $page_link =='My previous search') ? 'active':'';   ?> ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav1">
                        <i class="icon-table"> </i> OPAC   Search
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-nav1">
                       
                        <li class="<?php echo  ($page_link =='Basic Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('bsearch'); ?>"><i class="icon-angle-right"></i> Basic Search </a></li>
                         <li class="<?php echo  ($page_link =='Advanced Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('asearch'); ?>"><i class="icon-angle-right"></i> Advanced Search </a></li>
                        <li class="<?php echo  ($page_link =='External Search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('esearch'); ?>"><i class="icon-angle-right"></i> e-Library </a></li>
                        <li class="<?php echo ($page_link =='My previous search') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('shistory'); ?>"><i class="icon-angle-right"></i> My Previous Search </a></li>
                    </ul>
                </li>


                <li class="panel <?php echo ($page_link =='My Recommended Library Resources' || $page_link =='My Recommendation' || $page_link =='My private Files' || $page_link =='Book Reservation' || $page_link =='Borrowed Resources'  || ( strpos($page_link ,'My private Files - Files Upload') > 0 ) || $page_link =='Violations' || $page_link =='My private Files - Files Upload') ? 'active':'';   ?>">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav">
                        <i class="icon-table"> </i> My Library     
	   
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-nav">
                       
                        <li class="<?php echo ($page_link =='My private Files') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('my_files'); ?>"><i class="icon-angle-right"></i> My Private Files </a></li>
                        <li class="<?php  echo ($page_link =='Book Reservation') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('reservation'); ?>"><i class="icon-angle-right"></i> Book Reservation </a></li>
                        <li class="<?php echo  ($page_link =='Borrowed Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('borrowed'); ?>"><i class="icon-angle-right"></i> Borrowed Resources </a></li>
                        <li class="<?php echo ($page_link =='Violations') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('violations'); ?>"><i class="icon-angle-right"></i> Violations </a></li>
                        <li class="<?php echo  ($page_link =='My Recommended Library Resources') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('recommend'); ?>"><i class="icon-angle-right"></i> My  Recommendation </a></li>
                       
                    </ul>
                </li>

                 <li class="panel  <?php echo  ($page_link =='Compose new message' || $page_link =='Inbox' || $page_link =='Sent') ? 'active':'';   ?> ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-msg">
                        <i class="icon-table"> </i> Messages    
       
                        <span class="pull-right">
                          <i class="icon-angle-left"></i>
                        </span>
                      
                    </a>
                    <ul class="collapse" id="component-msg">
                       
                         <li class="<?php echo  ($page_link =='Compose new message') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/compose'); ?>"><i class="icon-angle-right"></i> Compose</a></li>
                        <li class="<?php echo ($page_link =='Inbox') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/inbox'); ?>"><i class="icon-angle-right"></i> Inbox</a></li>
                        <li class="<?php echo  ($page_link =='Sent') ? 'active':'';   ?>"><a href="<?php echo elibraryPortalUrl('messages/sent');?>"><i class="icon-angle-right"></i> Sent </a></li>
                       
                       <!--  <li class=""><a href="javascript:void(0)" ><i class="icon-angle-right"></i> Online Users </a></li> -->
                       
                    </ul>
                </li>


            

                <li class=" <?php echo ($page_link =='Record list') ? 'active':'';   ?>   panel"><a href="<?php echo elibraryPortalUrl('favourite'); ?>"><i class="icon-table"></i>  My Shelves</a></li>


                <li class=" <?php echo ($page_link =='Latest') ? 'active':'';   ?>  panel"><a href="<?php echo elibraryPortalUrl('news_events'); ?>"><i class="icon-table"></i>   News &amp; Events </a></li>
               
              <li class=" <?php echo ($page_link =='Guide') ? 'active':'';   ?>  panel"><a href="<?php echo elibraryPortalUrl('guide'); ?>"><i class="icon-table"></i>   Guide</a></li>


            