<?php
	$aLibrary		=	$this->ElibrarySystem->getNewsAndEvents();

	/*echo '<pre>';
	print_r($aLibrary);
	echo '</pre>';*/
	$sErrorMsg	=	'';
	if(!count($aLibrary)){
		$sErrorMsg	=	'';
	}
?>
<?php  

?>


	
	 <!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="news_events_modal" tabindex="-1" role="dialog" aria-labelledby="news_events_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">News &amp; Events Form</h4>
        </div>
        <div class="modal-body">
        	<!-- <ul class="nav nav-pills nav-stacked">
                <li><a href="javascript:;"> <i class="fa fa-clock-o"></i> Mail Inbox <span class="label label-primary pull-right r-activity">19</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-info pull-right r-activity">11</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-bell-o"></i> Notification <span class="label label-warning pull-right r-activity">03</span></a></li>
                <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Message <span class="label label-success pull-right r-activity">10</span></a></li>
            </ul> -->

            

            <form role="form" id="news_event_form" class="form-horizontals" role="form" name="news_event_form">
            <span id="news_event_ajax_reciever">
              <div class="form-group">
                <label for="inputSubjectTitle">Subject / Title</label>
                <input required id= "inputSubjectTitle" name= "inputSubjectTitle" type="text" class="form-control"   placeholder="Title / Subject ">
              </div>
              <div class="form-group">
                <label for="inputContent">Body</label>
                 <textarea required name ="inputContent" id="inputContent" class="form-control elibrary_editors" rows="3" placeholder="Content of the news/ Event"></textarea>
              </div>

              <div class="form-group">
                <label for="inputContent">Status</label>
                  <select class="form-control" id="news_status" name="news_status">
                    <?php echo elibrary_form_select_element(newsStatus(),'','id','title','--SELECT STATUS--' ); ?>
                  </select>
              </div>



              <input type = "hidden" name="hidden_news_key" id="hidden_news_key" value="hidden_news_key" />
               
              
              <button type="submit" name="saveRecord" class="btn btn-primary">Save Record</button>  <span class="pull-right" id="hidden_news_key_ajax_res"> </span>
            </span>
            </form>
             





        	

         




          
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteNewsModalFormID" target=" " method="post" name="deleteNewsModalFormID"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Record</h4>
                </div>
                  <div class="modal-body" id="needed"><span id="deleteResponse"> 
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div> </span>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="newsDeleteHiddenID" value="0" id="newsDeleteHiddenID" />
                  <input id="deleteNewsModalIDSubmit" type="submit" class="btn btn-danger" value="Yes, proceed."  name= "deleteNewsModalIDSubmit"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->




	<div class="row"> <div class="col-lg-4">  <a  data-toggle="modal" href="#news_events_modal" type="button" class="btn btn-success">Create New +</a></div> </div><br/> 
                                 
                        <div class="panel panel-primary">
                            <div class="panel-heading">News &amp; Events Record List</div>
                            <div class="panel-body">
                                           <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th> Title</th>
                                                            <th>Status</th>
                                                            <th>Date Added</th>
                                                            <th>Manage</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$iI=1;
															foreach($aLibrary as $aVals){
 																$o .= "<tr class=''>" ;
																	$o .= "<td>".$iI."</td>" ;
																	$o .= '<td><a href="#"  onclick ="launchAdminNewsModal('.$aVals['lne_id'].'); return false;">'.$aVals['lne_subject'].'</a></td>'; 
																	$o .= "<td>".elibrary_return_news_status_display($aVals['lne_show'])."</td>" ;
																	$o .= "<td>".$aVals['lne_date']."</td>" ;
																	$o .= "<td class='center'>";
                                  

																		$o .= '<div class="btn-group">
																		  <button type="button" class="btn btn-primary">Manage</button>
																		  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
																		    <span class="caret"></span>
																		  </button>
																		  <ul class="dropdown-menu" role="menu">
																		    <li><a href="#"  onclick ="launchAdminNewsModal('.$aVals['lne_id'].'); return false;">View / Edit </a></li>
																		    
																		    <li class="divider"></li>
																		    <li><a href="#" class="" onclick ="showNewsDeleteModal('.$aVals['lne_id'].'); return false;" >Delete</a></li>
																		  </ul>
																		</div>

																	</td>';



																	
																$o .= "</tr>" ;
																
															 
																$iI++;
															}
															echo $o;


															
														?>
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                            </div>
                            
                            
                            




                            