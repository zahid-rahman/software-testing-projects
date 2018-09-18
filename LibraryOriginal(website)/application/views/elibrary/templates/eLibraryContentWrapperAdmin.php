  <span id="showingit"></span>

  <div class="row"> 
    <span id="news_scroller" style="visibility:hidden;">   </span>
    </div>
                   

                  
                  <?php
                  
                  if(isset($sBodyContentTemplate)){
                     $this->load->view($sBodyContentTemplate,isset($mPreparedContent) ?$mPreparedContent : null);
                  }

                  ?>
                  
   <div class="modal fade bs-example-modal-lg" id="getUserDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title ">User Details</h4>
        </div>
        <div class="modal-body"><span id="getUserDetails"> </span>
         
        </div>
         
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
        <!--END PAGE CONTENT -->