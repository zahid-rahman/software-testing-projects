<?php
   $aFavList       =   $this->MyLibrary->getShelves($this->AppUser->getUserId());
   //var_dump($aFavList);
?>

  <div class="modal fade" id="add2shelveModal" tabindex="-1" role="dialog" aria-labelledby="add2shelveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg  ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Item to my Shelf</h4>
      </div>
      <div class="modal-body">
         <span id="responsee"></span>

          <form id="add2shelveModalIDForms" class="form-horizontal" role="form">
            <div class="form-group">
              <label for="shelveitemTitle" class="col-lg-2 control-label">Item</label>
              <div class="col-lg-10">
                <p class="form-control-static" id="shelveitemTitle"></p>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword1" class="col-lg-2 control-label">Select Folder</label>
              <input type="hidden" name="add2ShelveHiddenKey" id="add2ShelveHiddenKey" value="0" /> 
              <input type="hidden" name="fromShelveHiddenKey" id="fromShelveHiddenKey" value="0" />
              <div id="folderHolder" class="col-lg-10">


                  <div class="input-group">
                    
                      <select name="recieving_shelf" id="recieving_shelf" class="form-control col-lg-12 chzn-select">
                
                        <?php
                         echo elibrary_form_select_element($aFavList,'','lufl_id','lufl_title','--Select Folder --' );
                          ?> 
                      </select>

                    <span class="input-group-btn">
                      <button id="shelveRefreshBtn" class="btn btn-info" type="button">Refresh List</button>
                    </span>
                  </div><!-- /input-group -->
                  
              </div>
            </div>

             <button type="submit" class="btn btn-primary pull-right">Save Record</button>
           
            <!-- <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-default">Save</button>
              </div>
            </div> -->
          </form>


      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Record</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
