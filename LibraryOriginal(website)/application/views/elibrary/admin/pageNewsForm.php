<?php
  //print_r($s);
  //$s = $s[0];
?>
 
              <div class="form-group">
                <label for="inputSubjectTitle">Subject / Title </label>
                <input value ="<?php echo  $lne_subject; ?>" required id= "inputSubjectTitle" name= "inputSubjectTitle" type="text" class="form-control"   placeholder="Title / Subject ">
              </div>
              <div class="form-group">
                <label for="inputContent">Body</label>
                 <textarea required name ="inputContent" id="inputContent" class="form-control" rows="3" placeholder="Content of the news/ Event"><?php echo  $lne_content; ?></textarea>
              </div>


              <div class="form-group">
                <label for="inputContent">Status</label>
                  <select class="form-control" id="news_status" name="news_status">
                    <?php echo elibrary_form_select_element(newsStatus(),$lne_show,'id','title','--SELECT STATUS--' ); ?>
                  </select>
              </div>



              <input type = "hidden" name  =  "hidden_news_key" id = "hidden_news_key" value = "<?php echo $lne_id; ?>" />
               
              
              <button type="submit" name="saveRecord" class="btn btn-primary">Save Record</button>  <span class="pull-right" id="hidden_news_key_ajax_res"> </span>
            