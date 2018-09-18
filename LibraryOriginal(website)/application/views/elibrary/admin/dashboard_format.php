
<?php
    
    $this->load->helper('elibrary/elibrary');
     
  
      if($this->AppUser->bHasAccess())
        {
     
    ?>
       

 
            



    <h4><strong>Today's transactions</strong>   </h4><hr>
      <a class="btn btn-primary" href="<?php echo elibraryAdminUrl('reservations/') ;?>">
      Reserved Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('reservations')); ?></em></span>
      </a>
      <a class="btn btn-primary" href="<?php echo elibraryAdminUrl('borrowed') ;?>">
      Borrowed Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('borrowed') ); ?></em></span>
      </a>

      <a class="btn btn-primary" href="<?php echo elibraryAdminUrl('returned') ;?>">
      Returned Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('returned') ); ?></em></span>
      </a>

      <a class="btn btn-primary" href="<?php echo elibraryAdminUrl('violation') ;?>">
      Violations <span class="badge"><em><?php echo elibrary_toNumber( elibrary_dashboard('violation')); ?></em></span>
      </a>

       
      </hr>
       <br><br>

       <h4><strong>All  transactions</strong>   </h4><hr>
      <a class="btn btn-info" href="<?php echo elibraryAdminUrl('reservations/') ;?>">
      Reserved Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('reservations',true)); ?></em></span>
      </a>
      <a class="btn btn-info" href="<?php echo elibraryAdminUrl('borrowed') ;?>">
      Borrowed Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('borrowed',true) ); ?></em></span>
      </a>

      <a class="btn btn-info" href="<?php echo elibraryAdminUrl('returned') ;?>">
      Returned Resources <span class="badge"><em><?php echo elibrary_toNumber(elibrary_dashboard('returned',true) ); ?></em></span>
      </a>

      <a class="btn btn-info" href="<?php echo elibraryAdminUrl('violation') ;?>">
      Violations <span class="badge"><em><?php echo elibrary_toNumber( elibrary_dashboard('violation',true)); ?></em></span>
      </a>

       
      </hr>
       <br><br>



 
<h4><strong>Active Libraries / Catalogues</strong>   </h4><hr>
       <div class="row">
       
      <div class="col-lg-12"> 
          <div class="panel panel-primary">
                         <div class="panel-heading">Active Libraries / Catalogues  Record List</div>
                            <div class="panel-body">
                              <?php $aRecordList = getLibrariesWithCatalogueNumber();   
                               $sBuff = '';
                               if(count($aRecordList)){
                                $sBuff .= '<div class="list-group">';
                                foreach($aRecordList as $aVal){

                                
                                $sBuff .= '
                                <a href="'.base_url('elibrary/admin/catalog?cat_library_pick='.$aVal["ll_id"].'&amp;pull_record=Load+Catalogue').'" target ="_blanck" class="list-group-item">
                                        <i class=" icon-comment"></i> '.$aVal["ll_title"].'
                                      <span class="pull-right text-muted small badge"><em>'.elibrary_toNumber($aVal["ll_count"]).' </em>
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



    <?php 
  }
  else{
        echo '<div class = "alert alert-warning">You do not have access to view the information on this page.</div>';
       }
       // return;
?>












 