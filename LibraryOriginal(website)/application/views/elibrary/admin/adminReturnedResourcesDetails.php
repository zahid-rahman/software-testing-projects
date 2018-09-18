<?php echo '<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Reservation Form</h4>
        </div>
        <div class="modal-body">
          <form  id="saveReservationModalFormID" name="sectionForm" class="form-horizontal" role="form" action="" method="post"  >
  <div class="form-group">
    <label for="secTitle" class="col-lg-3 control-label requiured">Item Title</label>
    <div class="col-lg-9">
      <input id="itemTitle" name="itemTitle" readonly="readonly" type="text" class="form-control col-lg-12" />
    </div>
  </div>
  <input id="itemID" name="itemID" type="hidden" />

  <div class="form-group">
    <label for="secTitle" class="col-lg-3 control-label requiured">Library</label>
    <div class="col-lg-9">
      <input  id="libs" readonly="readonly" type="text" class="form-control col-lg-12" />
    </div>
  </div>

  <div class="form-group">
    <label for="sectionType" class="col-lg-3 control-label requiured">Pick Up Date</label>
    


    					<div class="col-lg-9">
                            <div class="input-group input-append date" id="pickerDateAppend" data-date="'.date("d-m-Y",time()).'" data-date-format="dd-mm-yyyy">
                                <input id="pickupdatevalue" name="pickupdatevalue" required class="form-control" value="'.date("d-m-Y",time()).'"   type="date" data-provide="datepicker" >
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>

  </div>
  
   
 
   <div class="form-group">
    <label for="secDescription" class="col-lg-3 control-label ">Note</label>
    <div class="col-lg-9">
       <textarea name="secDescription" id="secDescription" class="form-control col-lg-12" rows="3" placeholder="Description / Note"></textarea>
    </div>
  </div>
  
  
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
      <button id="saveReservationButton" type="submit" class="btn btn-info">Submit Reservation</button>
    </div>
    
    
  </div>
  <div id="userResponseFiles"></div>
  
</form>
        </div>
        <div class="modal-footer">
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --><script>  $(\'#pickerDate\').datepicker()</script>';