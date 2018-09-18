<?php
	$aSubjects      =   $this->ElibrarySystem->loadSubjects();
  $aLibraries     =   $this->ElibrarySystem->getLibraries();
  $aCategories    =   $this->ElibrarySystem->getCategories();
  $aFormats       =   $this->ElibrarySystem->getCatalogueFormats();
  //print_r($aLibraries);
	/*$aCatalogueSubmitValidationconfig = array(
               array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'passconf',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required'
                  )
            );*/
/*echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
  */
  $aCatalogueSubmitValidationconfig   =   array();
    $aCatalogueSubmitValidationconfig = array(
               array(
                     'field'   => 'cat_title', 
                     'label'   => 'Catalogue Title ', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'library_key', 
                     'label'   => 'Location ', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'cat_isbn', 
                     'label'   => 'ISBN / ISSN ', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'cat_accession', 
                     'label'   => 'Accession Number ', 
                     'rules'   => 'required'
                  )
               /*,   
               array(
                     'field'   => 'cat_ppn', 
                     'label'   => 'Preliminary Page no', 
                     'rules'   => 'required'
                  ), 
               array(
                     'field'   => 'cat_pln', 
                     'label'   => 'Page Last no', 
                     'rules'   => 'required'
                  ), 
               array(
                     'field'   => 'notes', 
                     'label'   => 'Notes', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'cat_subject', 
                     'label'   => 'Subject', 
                     'rules'   => 'required'
                  ), 
               array(
                     'field'   => 'cat_author', 
                     'label'   => 'Author / Editor', 
                     'rules'   => 'required'
                  ),            
               array(
                     'field'   => 'cat_publish_year', 
                     'label'   => 'Year Published', 
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'date_acquired', 
                     'label'   => 'Date Acquired', 
                     'rules'   => 'required'
                  ),  
                  array(
                     'field'   => 'place_of_publish', 
                     'label'   => 'Place of publication', 
                     'rules'   => 'required'
                  ), 

               array(
                     'field'   => 'cat_subject', 
                     'label'   => 'Subject', 
                     'rules'   => 'required'
                  ),   
               
               array(
                     'field'   => 'lci_edition', 
                     'label'   => 'Edition ', 
                     'rules'   => 'required'
                  )
                */

            );

      $this->form_validation->set_rules($aCatalogueSubmitValidationconfig); 
       $error = '';
    //$this->ElibrarySystem->saveLibraryRecord($this->input->post());
     
    //var_dump($this->form_validation->run() );
   // print_r($this->input->post('saveCatalog'));


    if($this->input->post('saveCatalog') && $this->form_validation->run()) {
      $this->AppUser->validateAccess('elibrary_admin');
          $error =  $this->ElibrarySystem->saveCatalogueRecord($this->input->post(null,true));

          /*    $error = '<div class="alert alert-success">Record saved successfully.</div>';
            }else{
              $error = '<div class="alert alert-danger">This Record already exists.   Please review and try again. </div>';
            }*/
            //$this->form_validation->run();
    }
/*echo '<pre>';
 print_r($this->input->post('cat_author'));
 echo '</pre>';

    var_dump( count($this->input->post('cat_author')));
*/

    if(is_array($this->input->post('cat_author')) &&  count($this->input->post('cat_author'))){
        $getCatalogLinkedAuthors    =   $this->input->post('cat_author');
    }


    if( is_array($this->input->post('cat_subject')) && count($this->input->post('cat_subject'))){
        $getCatalogLinkedSubjects    =   $this->input->post('cat_subject');
    }

/*     echo '<pre>';
    print_r($getCatalogLinkedAuthors );
    echo '</pre>';*/





?>


<div class="row"> <div class="col-lg-12">
<?php echo '   <a href="'.elibraryAdminUrl('catalog').'" type="button" class="btn btn-info">View Record List</a>  ';?>
<?php   echo   '  <a href="'.elibraryAdminUrl('catalog/new').'" type="button" class="btn btn-primary">Create New  List +</a>  ';  echo  ( isset($lci_id)  && $lci_id > 0) ? ' <div class="btn-group"> <button type="button" class="btn btn-success">Print Catalog Card</button> <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><a href="'.elibrary_catalogue_print_page($lci_id,1).'" target ="_blanck">Author Card </a></li><li><a href="'.elibrary_catalogue_print_page($lci_id,2).'" target ="_blanck">Subject Card </a></li>    <li><a href="'.elibrary_catalogue_print_page($lci_id,3).'" target ="_blanck">Title Card </a></li></ul></div>': ''  ?>

<?php echo '   <a href="'.elibraryAdminUrl('catalog/export/').'?template=true" type="button" class="btn btn-warning">Download Offline Record Entry Format (Excel)</a>  ';?>

</div> </div>

<br/>


  <div class="panel panel-primary">
     <div class="panel-heading">Library Catalogue  Form  </div>
          	<div class="panel-body">  
              <div class="row"> <div class="col-lg-12 pull">  <?php echo validation_errors().$error ; ?></div>  </div>

              <div    id="primary_author_increament_holder_template"  class = "elibrary_hide_display parent_holder hide hidden row" style ="displasy:none;"> 
      <div class="col-lg-10">
      <input    name="cat_author[]" type="text" class="form-control required col-lg-12" id="cat_author" placeholder="Name of author / Editor"   value="">
      </div>

      <div class="col-lg-2">
      <button id = "primaryAuthorRemove" type="button" class="btn btn-info primaryAuthorRemoverBtn  removeBtn  primaryAuthorRemove"  onclick=  "removeThisElement(this);"><i class="glyphicon glyphicon-minus removeBtn"></i> </button>
      </div>       
</div>

<div    id="primary_subject_increament_holder_template" class =" row elibrary_hide_display  parent_holder hide hidden "  style ="displays:none;"> 
     <div class="col-lg-10">
      <input     name="cat_subject[]" type="text" class="form-control required col-lg-12"   placeholder="Subject"   value="">
      </div>

      <div class="col-lg-2">
        <button type="button" class="btn btn-info removeSubjectButton  removeBtn"  onclick=  "removeThisElement(this);"> <i class="glyphicon glyphicon-minus removeBtn"> </i> </button>
      </div>

</div>



          		<form role="form" method="post" action=""  enctype="multipart/form-data">
<div class="row">  <!--Beginning of grid row-->
	<div class="col-lg-4"> 
    <div class="form-group">
    <label for="cat_title">Title</label>
    <input required name="cat_title"  type="text" class="form-control required col-lg-12" id="cat_title" placeholder="Title "    value="<?php echo   set_value('cat_title', isset($lci_title) ? $lci_title : $this->input->post('cat_title')); ?>">
  </div>
     </div> <!--End of grid column row-->
      <input   type="hidden" name="cat_key" value="<?php echo   set_value('cat_key', isset($lci_id) ? $lci_id : 0); ?>"/> 

	<div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_ppn">Preliminary Page no</label>
    <input   name="cat_ppn" type="text" class="form-control required col-lg-12" id="cat_ppn" placeholder="Preliminary Page no"   value="<?php echo   set_value('cat_ppn', isset($lci_preliminary_page_no) ? $lci_preliminary_page_no : $this->input->post('cat_ppn')); ?>">
  </div>
  
     </div> <!--End of grid column row-->
    
    
    <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_pln">Page Last no</label>
    <input  name="cat_pln" type="text" class="form-control required col-lg-12" id="cat_pln" placeholder="Page Last no"     value="<?php echo   set_value('cat_pln', isset($lci_page_past_no) ? $lci_page_past_no : $this->input->post('cat_pln')); ?>">
  </div>
     </div> <!--End of grid column row-->
    
    
</div> <!--End of grid row-->


 









<div class="row">  <!--Beginning of grid row-->
  
  <div class="col-lg-6"> 
      <div class="form-group">
    <label for="cat_author">Author / Editor</label>

    <div class="row"  id="primary_author_increament_holder"> 
      <div class="col-lg-10">
      <input   name="cat_author[]" type="text" class="form-control required col-lg-12" id="cat_author" placeholder="Name of author / Editor"   value="<?php echo   set_value('cat_author', isset($getCatalogLinkedAuthors[0]['lcia_title']) ? $getCatalogLinkedAuthors[0]['lcia_title'] : ( isset($getCatalogLinkedAuthors[0]['cat_author']) ? $getCatalogLinkedAuthors[0]['cat_author'] : '' )   ); ?>">
      </div>
      <div class="col-lg-2">
      <button id = "primaryAuthorAdderBtn" type="button" class="btn btn-primary "><i class="glyphicon glyphicon-plus"></i> </button>
      </div>       
    </div>

    <?php 
      if(isset($getCatalogLinkedAuthors)  &&  ($iAuthorsCount  = count($getCatalogLinkedAuthors) ) >  1 ){        

     for($iCounterAAuther = 1; $iCounterAAuther < $iAuthorsCount;  $iCounterAAuther++){
      //$iCounterAAuther = 0;
      ?>
        <div class="row parent_holder"  id="primary_author_increament_holder"> 
      <div class="col-lg-10">
      <input   name="cat_author[]" type="text" class="form-control required col-lg-12"   placeholder="Name of author"    value="<?php echo   set_value('cat_author', isset($getCatalogLinkedAuthors[$iCounterAAuther]['lcia_title']) ? $getCatalogLinkedAuthors[$iCounterAAuther]['lcia_title'] : ( isset($getCatalogLinkedAuthors[$iCounterAAuther]['cat_author']) ? $getCatalogLinkedAuthors[$iCounterAAuther]['cat_author'] : '' ) ); ?>">
      </div>

      <div class="col-lg-2">
      <button id = "primaryAuthorRemoverBtn " type="button" class="btn btn-info primaryAuthorRemoverBtn"  onclick=  "removeThisElement(this);"><i class="glyphicon glyphicon-minus"></i> </button>
      </div>       
    </div>



      <?php
      }  

    }

      ?> 

    <div id="author_attacher"></div> 
  </div>
  
  </div> <!--End of grid column row-->
      

    



    
    <div class="col-lg-6"> 
      <div class="form-group">
    <label for="cat_subject" class="required">Subject</label>
   
    <div class=" row"> 
        
      <div class="col-lg-10">
      <input id="cat_subject"   name="cat_subject[]" type="text" class="form-control required col-lg-12"   placeholder="Subject"   value="<?php echo   set_value('cat_subject', isset($getCatalogLinkedSubjects[0]['lcis_title']) ? $getCatalogLinkedSubjects[0]['lcis_title'] : ( isset($getCatalogLinkedSubjects[0]['cat_subject']) ? $getCatalogLinkedSubjects[0]['cat_subject'] : '')  ); ?>">
      </div>




      <div class="col-lg-2">
      <button  id ="primarySubjectAdderBtn" type="button" class="btn btn-primary"><i class="glyphicon glyphicon-plus"> </i> </button>
      </div>

     

    </div>




      <?php 
      if(isset($getCatalogLinkedSubjects)  &&  ($iSubjectCounting  = count($getCatalogLinkedSubjects) ) >  1 ){  

       /* echo '<pre>';

        print_r($getCatalogLinkedSubjects);

        echo '</pre>';    */  

     for($iCounterSubject = 1; $iCounterSubject < $iSubjectCounting;  $iCounterSubject++){
      //$iCounterAAuther = 0;
      ?>
        <div class="row  parent_holder" > 
      <div class="col-lg-10">
      <input   name="cat_subject[]" type="text" class="form-control required col-lg-12"   placeholder="Subject"    value="<?php echo   set_value('cat_subject', isset($getCatalogLinkedSubjects[$iCounterSubject]['lcis_title']) ? $getCatalogLinkedSubjects[$iCounterSubject]['lcis_title'] : ( isset($getCatalogLinkedSubjects[$iCounterSubject]['cat_subject']) ? $getCatalogLinkedSubjects[$iCounterSubject]['cat_subject'] : '') ); ?>">
      </div>

    <div class="col-lg-2">
      <button type="button" class="btn btn-info removeSubjectButton  removeBtn"  onclick=  "removeThisElement(this);"> <i class="glyphicon glyphicon-minus removeBtn"> </i> </button>
      </div>

    </div>







 



      <?php
      }  

    }

      ?> 



 <div id="subject_attacher"></div> 
  </div>



     </div> <!--End of grid column row-->
    
    
</div> <!--End of grid row-->

 



<div class="row">  <!--Beginning of grid row-->


  <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_publisher">Publisher</label>
    <input  name="cat_publisher" type="text" class="form-control required col-lg-12" id="cat_publisher" placeholder="Publisher"    value="<?php echo   set_value('cat_publisher', isset($lci_publisher) ? $lci_publisher : $this->input->post('cat_publisher')); ?>">
  </div>
     </div> <!--End of grid column row-->
    



  <div class="col-lg-4"> 
    <div class="form-group">
    <label for="cat_publish_year" class="required">Year Published</label>
          <input  name="cat_publish_year" type="text" class="form-control required col-lg-12 " id="cat_publish_year" placeholder="Year Published"  value="<?php echo   set_value('cat_publish_year', isset($lci_year_published) ? $lci_year_published : $this->input->post('cat_publish_year')); ?>">
  
  </div>
     </div> <!--End of grid column row-->
     
     
  <div class="col-lg-4"> 
     <div class="form-group">
    <label for="place_of_publish" class="required">Place of publication</label>
    <input  name="place_of_publish" type="text" class="form-control required col-lg-12" id="place_of_publish" placeholder="Place of publication"     value="<?php echo   set_value('place_of_publish', isset($lci_place_of_publish) ? $lci_place_of_publish : $this->input->post('place_of_publish')); ?>">
  </div>
  
     </div> <!--End of grid column row--> 
    
</div> <!--End of grid row-->

 


<div class="row">  <!--Beginning of grid row-->
	<div class="col-lg-4"> 
    <div class="form-group">
    <label for="library_key" class="required">Location</label>
     <select required  name="library_key" id="library_key" class="form-control col-lg-12 ">
        <?php
              echo elibrary_form_select_element($aLibraries, set_value('library_key', isset($lci_library_id) ? $lci_library_id : $this->input->post('library_key'))  ,'ll_id','ll_title','--SELECT LOCATION--' );
        ?>
 
    </select>
    </div>
       </div> <!--End of grid column row-->
       
       
  	<div class="col-lg-4"> 
        <div class="form-group">
      <label for="cat_category"  class="required">Type </label>
       <select name="cat_category" id="cat_category" class="form-control col-lg-12 required">
          <?php
              echo elibrary_form_select_element($aCategories,set_value('cat_category', isset($lci_category) ? $lci_category : $this->input->post('cat_category')),'lcc_id','lcc_title','--SELECT TYPE--' );
                ?>
   
   </select>
  </div>
  
     </div> <!--End of grid column row-->
    
    
    <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_format"  class="required">Format</label>
     <select   name="cat_format" id="cat_format" class="form-control col-lg-12 required">
            <?php
            echo elibrary_form_select_element($aFormats,set_value('cat_format', isset($lci_format) ? $lci_format : $this->input->post('cat_format')),'lcf_id','lcf_title','--SELECT FORMAT--' );
              ?>
 
      </select>
  </div>
  
     </div> <!--End of grid column row-->
    
</div> <!--End of grid row-->



<div class="row">  <!--Beginning of grid row-->


<div class="col-lg-2"> 
    <div class="form-group">
    <label for="lci_edition">Edition</label>
    <input name="lci_edition"  type="text" class="form-control required col-lg-12" id="lci_edition" placeholder="Edition "    value="<?php echo   set_value('lci_edition', isset($lci_edition) ? $lci_edition : $this->input->post('lci_edition')); ?>">
  </div>
     </div> <!--End of grid column row-->


  <div class="col-lg-2"> 
    <div class="form-group">
    <label for="lci_qty_acquired">Quantity</label>
    <input name="lci_qty_acquired"  type="text" class="form-control required col-lg-12" id="lci_qty_acquired" placeholder="Quantity Acquired "   value="<?php echo   set_value('lci_qty_acquired', isset($lci_qty_acquired) ? $lci_qty_acquired : $this->input->post('lci_qty_acquired')); ?>">
    </div>
  </div> <!--End of grid column row-->
      

     <div class="col-lg-4"> 
    <div class="form-group">
    <label for="cat_callno">Call Number </label>
    <input name="cat_callno"  type="text" class="form-control required col-lg-12" id="cat_callno" placeholder="Call Number "    value="<?php echo   set_value('cat_callno', isset($lci_callnumber) ? $lci_callnumber : $this->input->post('cat_callno')); ?>">
  </div>
     </div> <!--End of grid column row-->


  
    
  


     <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_isbn">ISBN / ISSN </label>
    <input required name="cat_isbn"  type="text" class="form-control required col-lg-12" id="cat_isbn" placeholder="ISBN OR ISSN Number"   value="<?php echo   set_value('cat_isbn', isset($lci_isbn) ? $lci_isbn : $this->input->post('cat_isbn')); ?>">
  
  </div>
  
     </div> <!--End of grid column row-->
    
    


    
    
</div> <!--End of grid row-->



<div class="row">  <!--Beginning of grid row-->


  <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_accession">Accession Number</label>
    <input required  name="cat_accession" type="text" class="form-control required col-lg-12" id="cat_accession" placeholder="Accession Number"    value="<?php echo   set_value('cat_accession', isset($lci_accession) ? $lci_accession : $this->input->post('cat_accession')); ?>">
  </div>
     </div> <!--End of grid column row-->
    



  <div class="col-lg-4"> 
    <div class="form-group">
    <label for="cat_source" class="required">Source</label>
         <!--  <input  name="cat_source" type="text" class="form-control required col-lg-12 " id="cat_source" placeholder="Source"  required="required" value="<?php echo   set_value('cat_source', isset($lci_source) ? $lci_source : $this->input->post('cat_source')); ?>">
       -->

      <select   name="cat_source" id="cat_source" class="form-control col-lg-12 ">
        <?php
           // echo elibrary_form_select_element($aSubjects, set_value('cat_source', isset($lci_source) ? $cat_source : '')  ,'lcis_id','lcis_title','--SELECT SOURCE--' );
            echo elibrary_form_select_element($aSubjects,set_value('cat_source', isset($lci_source) ? $lci_source : $this->input->post('cat_source')),'lcis_id','lcis_title','--SELECT SOURCE--' );
        ?>
 
    </select>


  </div>
     </div> <!--End of grid column row-->
     
     
  <div class="col-lg-4"> 
     <div class="form-group">
    <label for="cat_cost" class="required">Cost</label>
    <input  name="cat_cost" type="text" class="form-control required col-lg-12" id="cat_cost" placeholder="Cost"    value="<?php echo   set_value('cat_cost', isset($lci_cost) ? $lci_cost : $this->input->post('cat_cost')); ?>">
  </div>
  
     </div> <!--End of grid column row--> 
    
</div> <!--End of grid row-->

 



  <div class="row">  <!--Beginning of grid row-->

  <div class="col-lg-4"> 
     <div class="form-group">
    <label for="date_acquired" class="required">Date acquired</label>
    <input  name="date_acquired" type="date" class="form-control required col-lg-12 datepicker" id="date_acquired" placeholder="Date acquired"     value="<?php echo   set_value('date_acquired', isset($lci_date_acquired) ? $lci_date_acquired : $this->input->post('date_acquired')); ?>">
  </div>
  
     </div> <!--End of grid column row--> 

  
     <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_screen">Screenshot</label> 
    <input id="cat_screen" name="cat_screen" type="file" class="form-control filestyle" data-size="sm" placeholder="Upload A downloadable file" >
  </div>
  
     </div> <!--End of grid column row-->
    


      <div class="col-lg-4"> 
      <div class="form-group">
    <label for="cat_downloadable">Downloadable File</label>
     
    <input name="cat_downloadable"  id="cat_downloadable"  type="file" class="form-control filestyle" data-size="sm" placeholder="Upload A downloadable file" >
  </div>
     </div> <!--End of grid column row-->



  
    
</div> <!--End of grid row-->





<div class="row">  <!--Beginning of grid row-->
	<div class="col-lg-12"> 
    <div class="form-group">
    <label for="description">Note </label>
   
<textarea rows="5" class="form-control col-lg-12" name="notes" placeholder="Enter a   note for this resource"><?php echo   set_value('notes', isset($lci_note) ? $lci_note : $this->input->post('notes')); ?></textarea>
</div>
     </div> <!--End of grid column row-->
        
</div> <!--End of grid row-->


<div class="row">  <!--Beginning of grid row-->
  <div class="col-lg-12"> 
    <div class="form-group">
    <label for="description"> Tracing</label>
   
<textarea rows="5" class="form-control col-lg-12" name="description" placeholder="Enter a tracing for this resource"><?php echo   set_value('description', isset($lci_description) ? $lci_description : $this->input->post('description')); ?></textarea>
</div>
     </div> <!--End of grid column row-->
        
</div> <!--End of grid row-->



  <input name="saveCatalog" type="submit" class="btn btn-success pull-right" value="Save Catalog"/>
</form>
</div>

    </div>