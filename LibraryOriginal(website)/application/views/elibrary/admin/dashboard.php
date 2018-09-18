<?php

    $sWhere = 'WHERE 1';
    $sToday = $this->db->escape(date('Y-m-d', time()));
    
?>

		<div class="row">  
			<div class="col-lg-12"> 
					<div class="panel panel-primary">
	                       <div class="panel-heading">Today's transactions</div>
	                          <div class="panel-body"> 

                              <!-- <ul class="nav nav-pills nav-stacked">
                                  <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                                </ul>
 -->

	                          	<div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <i class=" icon-file-text"></i> Reserved Resources
                                    <span class="pull-right text-muted small"><em><?php echo elibrary_toNumber($this->ElibrarySystem->dashBoardReservedResources( 'WHERE lbr.lbr_date_reserved = date('.$sToday .')')); ?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Borrowed Resources
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardBorrowed('WHERE lbci.lbci_date = date('.$sToday .')')); ?></em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Returned Resources
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardBorrowed('WHERE lbci.lbci_date = date('.$sToday .')  AND lbci.lbci_returned =  1')); ?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Violations
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardAdminOffenderViews( 'WHERE lo_date_commited =  date('.$sToday .')  ')); ?></em>
                                    </span>
                                    </a>


                                </div>



	                          </div>

                    </div>
            </div>    <!-- end of first division -->
           </div>



           <div class="row">  
            <div class="col-lg-12"> 
                    <div class="panel panel-primary">
                           <div class="panel-heading">All transactions</div>
                              <div class="panel-body"> 

                              <!-- <ul class="nav nav-pills nav-stacked">
                                  <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                                  <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
                                </ul>
 -->

                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <i class=" icon-file-text"></i> Reserved Resources
                                    <span class="pull-right text-muted small"><em><?php echo elibrary_toNumber($this->ElibrarySystem->dashBoardReservedResources( /*'WHERE lbr.lbr_date_reserved = date('.$sToday .')'*/)); ?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Borrowed Resources
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardBorrowed(/*'WHERE lbci.lbci_date = date('.$sToday .')'*/)); ?></em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Returned Resources
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardBorrowed(/*'WHERE lbci.lbci_date = date('.$sToday .')  AND lbci.lbci_returned =  1'*/)); ?></em>
                                    </span>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <i class="icon-file-text"></i> Violations
                                    <span class="pull-right text-muted small"><em> <?php echo elibrary_toNumber($this->ElibrarySystem->dashboardAdminOffenderViews( /*'WHERE lo_date_commited =  date('.$sToday .')  '*/)); ?></em>
                                    </span>
                                    </a>


                                </div>



                              </div>

                    </div>
            </div>    <!-- end of first division -->
           </div>





           <div class="row">
			<div class="col-lg-12"> 
					<div class="panel panel-primary">
	                       <div class="panel-heading">Active Libraries / Catalogues</div>
	                          <div class="panel-body">
	                          	<?php $aRecordList =  $this->ElibrarySystem->getLibrariesWithCatalogueNumber( );   
	                          	 $sBuff = '';
	                          	 if(count($aRecordList)){
	                          	 	$sBuff .= '<div class="list-group">';
	                          	 	foreach($aRecordList as $aVal){

	                          	 	
	                          	 	$sBuff .= '
	                          		<a href="#" class="list-group-item">
                                        <i class=" icon-comment"></i> '.$aVal["ll_title"].'
	                                    <span class="pull-right text-muted small"><em>'.elibrary_toNumber($aVal["ll_count"]).' </em>
	                                    </span>
                                    </a>';
		                          	
		                          }
		                          $sBuff .= '</div>';
		                          }else{
		                          	$sBuff .= '<div clas="alert alert-info"> You do not have any active libary record.  </div>';
		                          }

		                          echo $sBuff;

	                          	?>
	                          </div>
                    </div>
            </div>   <!-- end of second division -->
		</div> <!-- end of first row -->




	<!-- <hr/>

		<div class="row">  
			<div class="col-lg-4">  </div>   
			<div class="col-lg-4">  </div>   
		</div> -->


<!-- 
							<div class="panel panel-primary">
	                            <div class="panel-heading">Administrative</div>
	                            <div class="panel-body"></div>
                            </div>


 								<div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <i class=" icon-comment"></i> New Comment
                                    <span class="pull-right text-muted small"><em> 4 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-twitter"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em> 12 minutes ago</em>
                                    </span>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="icon-envelope"></i> Message Sent
                                    <span class="pull-right text-muted small"><em> 27 minutes ago</em>
                                    </span>
                                    </a>
                                </div>
 -->