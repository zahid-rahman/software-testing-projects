<?php
    $aCategories       =   $this->ElibrarySystem->getCatalogueCategories();
    $aFormat           =   $this->ElibrarySystem->getCatalogueFormats();
    $aViolations       =   $this->ElibrarySystem->getViolations();
    $aSubjects         =   $this->ElibrarySystem->loadSubjects();
    /*echo '<pre>';
    print_r($aLibrary);
    echo '</pre>';*/
    $sErrorMsg  =   '';
    if(!count($aCategories)){
        $sErrorMsg  =   '';
    }
?>
<?php  

?>

 

  
          <ul class="nav nav-tabs" id="myMiscTab">
            <li class="active"><a href="#Category" class="btn btn-primary">Catalogue Item Type</a></li>
            <li><a href="#formats" class="btn btn-info">Formats</a></li>
            <li><a href="#subjects" class="btn btn-warning">Source</a></li>
            <li><a href="#Violation" class="btn btn-success">Violation</a></li>
          </ul>
          <hr/>

          <div class="tab-content">
            <div class="tab-pane active" id="Category">

                <div class="row"> <div class="col-lg-4">  <a  data-target="#myModalcat_category_"  data-toggle="modal" href="#myModalcat_category_" type="button" class="btn btn-primary">Create New Catlogue Type +</a></div> </div><br/> 
          <div class="panel panel-primary">
                         <div class="panel-heading">Catalogue Type List</div>
                            <div class="panel-body">
                              

                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>  Title</th>
                                                            
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $o = "" ;
                                                          
                                                            $iI=1;
                                                            foreach($aCategories as $aVals){
                                                                $o .= "<tr class=' '>" ;
                                                                    $o .= "<td>".$iI."</td>" ;
                                                                    $o .= '<td>'.$aVals['lcc_title'].'</td>'; 
                                                                    
                                                                    $o .= "<td>".$aVals['lcc_data_added']."</td>" ;
                                                                    $o .= "<td class='center'>";


                                                                        $o .= '<div class="btn-group">
                                                                          <button type="button" class="btn btn-primary">Action</button>
                                                                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                          </button>
                                                                          <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="#" onclick ="adminCategoryEditLauncher('.$this->db->escape($aVals['lcc_title']).' , \''.$aVals['lcc_id'].'\'); return false;">View / Edit </a></li>
                                                                            
                                                                            <li class="divider"></li>
                                                                            <li><a href="" class=""  onclick ="launchAdminCategoryModal(\''.$aVals['lcc_id'].'\'); return false;">Delete</a></li>
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


            </div> <!-- End of category tab holder -->



            <div class="tab-pane" id="formats">  
                  <div class="row"> <div class="col-lg-4">  <a href="#cat_format_titlemodal" data-target="#cat_format_titlemodal"  data-toggle="modal"  type="button" class="btn btn-info">Create New Format +</a></div> </div><br/> 
          <div class="panel panel-info">
                         <div class="panel-heading">Catalogue format list</div>
                            <div class="panel-body">
                              


                              <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>  Title</th>
                                                             
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $o = "" ;
                                                            
                                                            $iI=1;
                                                            foreach($aFormat as $aVals){
                                                                $o .= "<tr class=''>" ;
                                                                    $o .= "<td>".$iI."</td>" ;
                                                                    $o .= '<td> '.$aVals['lcf_title'].' </td>'; 
                                                                   
                                                                    $o .= "<td>".$aVals['lcf_date_created']."</td>" ;
                                                                    $o .= "<td class='center'>";


                                                                        $o .= '<div class="btn-group">
                                                                          <button type="button" class="btn btn-info">Action</button>
                                                                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                          </button>
                                                                          <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="#" onclick ="adminFormatEditLauncher('.$this->db->escape($aVals['lcf_title']).' , \''.$aVals['lcf_id'].'\'); return false;">View / Edit </a></li>
                                                                            
                                                                            <li class="divider"></li>
                                                                            <li><a href="#" class="" onclick ="launchAdminFormatModal(\''.$aVals['lcf_id'].'\'); return false;">Delete</a></li>
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

            </div> <!-- End of format category tab holder -->


 


              <div class="tab-pane" id="subjects">

                <div class="row"> <div class="col-lg-4">  <a href="#cat_subject_titlemodal" data-target="#cat_subject_titlemodal"  data-toggle="modal"  type="button" class="btn btn-warning">Create New Source +</a></div> </div><br/> 
          <div class="panel panel-warning">
                         <div class="panel-heading">Catalogue Acquisition Source List</div>
                            <div class="panel-body">
                              


                              <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Title</th>
                                                             
                                                            <th>Date Added</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $o = "" ;
                                                            
                                                            $iI=1;
                                                            foreach($aSubjects as $aVals){
                                                                $o .= "<tr class=''>" ;
                                                                    $o .= "<td>".$iI."</td>" ;
                                                                    $o .= '<td> '.$aVals['lcis_title'].' </td>'; 
                                                                   
                                                                    $o .= "<td>".$aVals['lcis_date_added']."</td>" ;
                                                                    $o .= "<td class='center'>";


                                                                        $o .= '<div class="btn-group">
                                                                          <button type="button" class="btn btn-warning">Action</button>
                                                                          <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                          </button>
                                                                          <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="#" onclick ="adminSubjectEditLauncher('.$this->db->escape($aVals['lcis_title']).' , \''.$aVals['lcis_id'].'\'); return false;">View / Edit </a></li>
                                                                            
                                                                            <li class="divider"></li>
                                                                            <li><a href="#" class="" onclick ="launchAdminSubjectModal(\''.$aVals['lcis_id'].'\'); return false;">Delete</a></li>
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




            </div>  <!-- End of subjects category content holder -->












            <div class="tab-pane" id="Violation">      <div class="row">  

      <div class="col-lg-12"> 

            <div class="row"> <div class="col-lg-4">  <a  data-target="#admiVioaltionFormsParentDiv"  data-toggle="modal" href="#admiVioaltionFormsParentDiv" type="button" class="btn btn-success">Create New Violation Type +</a></div> </div><br/> 
          <div class="panel panel-success">
                         <div class="panel-heading">Violation Type List</div>
                            <div class="panel-body">
                              

                            <div class="table-responsive">
                                                <table class="table table-striped table-condensed table-hover dataTables" id="dataTables-libraryList">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Title</th>
                                                            <th>Fine</th>
                                                             
                                                            
                                                            <th>Manage</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $o = "" ;
                                                          
                                                            $iI=1;
                                                            foreach($aViolations as $aVals){
                                                                $o .= "<tr class=' '>" ;
                                                                    $o .= "<td>".$iI."</td>" ;
                                                                    $o .= '<td>'.$aVals['loft_title'].'</td>'; 
                                                                    $o .= "<td>".$aVals['loft_fee']."</td>" ;
                                                                    
                                                                    $o .= "<td class='center'>";


                                                                        $o .= '<div class="btn-group">
                                                                          <button type="button" class="btn btn-success">Manage</button>
                                                                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="caret"></span>
                                                                          </button>
                                                                          <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="#" onclick ="adminViolationEditLauncher('.$this->db->escape($aVals['loft_title']).' ,'.$this->db->escape($aVals['loft_fee']).' , '.$this->db->escape($aVals['loft_description']).' , \''.$aVals['loft_id'].'\'); return false;">View / Edit </a></li>
                                                                            
                                                                            <li class="divider"></li>
                                                                            <li><a href="#" onclick ="launchAdminViotypeModal(\''.$aVals['loft_id'].'\'); return false;" class="">Delete</a></li>
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
            </div>
          </div>    </div> <!-- End of violation content holder -->

          </div> <!-- End of tab content -->
          
          












 <div class="modal fade" id="myModalcat_category_" tabindex="-1" role="dialog" aria-labelledby="myModalcat_category_Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="catcat_form" action="" method="post"  >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> Catalogue Type Form</h4>
      </div>
      <div class="modal-body"> 
      <span id="respy"> </span>
        <input type="hidden" name="cat_category_key" value="0"  id="cat_category_key"/>

        
          <div class="form-group">
            <label for="category_title">Catalogue Type Title</label>
            <input required type="text" name = "category_title" class="form-control" id="category_title" placeholder="Title of the category">
          </div>
        
          
          
       



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 
  

 <div class="modal fade" id="admiVioaltionFormsParentDiv" tabindex="-1" role="dialog" aria-labelledby="admiVioaltionFormsParentDivLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form name="adminViolation_form" id="adminViolation_form" action="" method="post"   >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> Violation Form</h4>
      </div>
      <div class="modal-body"> 
      <span id="respy3"> </span>
        <input type="hidden" name="admin_violation_key" value="0"  id="admin_violation_key"/>

        
          <div class="form-group">
            <label for="admin_violation_title"> Title</label>
            <input required type="text" name = "admin_violation_title" class="form-control" id="admin_violation_title" placeholder="Title of the category">
          </div>
           <div class="form-group">
            <label for="admin_violation_fine"> Fine</label>
            <input required type="text" name = "admin_violation_fine" class="form-control" id="admin_violation_fine" placeholder="Tine">
          </div>
           <div class="form-group">
            <label for="admin_violation_description"> Description</label>
            <textarea class="form-control" id="admin_violation_description" name="admin_violation_description" placeholder="Description"></textarea>
             
          </div>
        
          
          
       



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 



<div    class="modal fade " id="cat_format_titlemodal" tabindex="-1" role="dialog" aria-labelledby="cat_format_titlemodalModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="cat_format_form" action="" method="post"   >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> File Format/ Type Form</h4>
      </div>
      <div class="modal-body"> 
      <span id="respy2"> </span>
        <input type="hidden" name="cat_format_key" value="0"  id="cat_format_key"/>

        
          <div class="form-group">
            <label for="cat_format_title">Format / Type</label>
            <input  required type="text" name = "cat_format_title" class="form-control" id="cat_format_title" placeholder="Format or type">
          </div>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  
  <div    class="modal fade " id="cat_subject_titlemodal" tabindex="-1" role="dialog" aria-labelledby="cat_subject_titlemodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="cat_subject_form" action="" method="post"   >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"> Catalogue Item Acquisition Source</h4>
      </div>
      <div class="modal-body"> 
      <span id="respy_save_subject"> </span>
        <input type="hidden" name="cat_subject_key" value="0"  id="cat_subject_key"/>

        
          <div class="form-group">
            <label for="cat_subject_title">Source Title </label>
            <input  required type="text" name = "cat_subject_title" class="form-control" id="cat_subject_title" placeholder="Source Title">
          </div>
  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 








 

     <!-- Modal -->
        <div class="modal fade" id="adminViolationDeleteModalConfirm" tabindex="-1" role="dialog" aria-labelledby="adminViolationDeleteModalConfirm" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteViolationRecordForm"   method="post" name="deleteViolationRecordForm"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete </h4>
                </div>
                  <div class="modal-body" id="needed"> <span id="ViolationTypeIDajax_response2"> </span>
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="ViolationTypeID" value="0" id="ViolationTypeID" />
                  <input id="deleteViolationRecordFormSubmit" type="submit" class="btn btn-danger" value="Yes, Proceed"  name= "sav"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

           <!-- Modal -->
        <div class="modal fade" id="adminFormatDeleteModalConfirm" tabindex="-1" role="dialog" aria-labelledby="adminFormatDeleteModalConfirm" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteFormatRecordForm"   method="post" name="deleteFormatRecordForm"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete </h4>
                </div>
                  <div class="modal-body" id="needed"> <span id="formatIDajax_response1"> </span>
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="formatID" value="0" id="formatID" />
                  <input id="deleteFormatRecordFormSubmit" type="submit" class="btn btn-danger" value="Yes, Proceed"  name= "sav"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

           <!-- Modal -->
        <div class="modal fade" id="adminCategoryDeleteModalConfirm" tabindex="-1" role="dialog" aria-labelledby="adminCategoryDeleteModalConfirm" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteCategoryRecordForm"   method="post" name="deleteCategoryRecordForm"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete </h4>
                </div>
                  <div class="modal-body" id="needed">  <span id="categoryIDajax_response0"> </span>
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="categoryID" value="0" id="categoryID" />
                  <input id="deleteCategoryRecordFormSubmit" type="submit" class="btn btn-danger" value="Yes, Proceed"  name= "sav"/>
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

            <!-- Modal -->
        <div class="modal fade" id="adminSUbjectDeleteModalConfirm" tabindex="-1" role="dialog" aria-labelledby="adminSUbjectDeleteModalConfirm" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content " >
              <form id="deleteSubjectRecordForm"   method="post" name="deleteSubjectRecordForm"  >
          

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete </h4>
                </div>
                  <div class="modal-body"  >  <span id="subjectIDajax_response4"> </span>
                   <div class="alert alert-info"> Are you sure you want to delete this record? </div>
                  

                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Not now </button>
                  <input type= "hidden" name="subjectID" value="0" id="subjectID" />
                  <input id="deleteSubjectRecordFormSubmit" type="submit" class="btn btn-danger" value="Yes, Proceed"   />
                

                  </div>
                <div class="modal-footer">
                 </div>

                 </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->



	 




  <script src="<?php echo $this->config->item('base_url') ; ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
                            <script>
                                 $(document).ready(function () {
                                     $('.dataTables').dataTable();
                                 });
                            </script>



