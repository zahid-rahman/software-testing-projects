 
  	 <span id="news_scroller" style="visibility:hidden;">   </span>
 
   <br/>  
                  <?php
                  if(isset($sBodyContentTemplate)){
                     $this->load->view($sBodyContentTemplate,isset($mPreparedContent) ?$mPreparedContent : null);
                  }

                  ?>
                  
  
        <!--END PAGE CONTENT -->