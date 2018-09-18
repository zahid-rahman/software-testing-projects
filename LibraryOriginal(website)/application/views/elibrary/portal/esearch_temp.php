<?php 
    //$this->load->model('elibrary/elibrarymodel') ;
   // $aExtLib    =   null;
   //$aExtLib       =   $this->ElibraryModel->getExternalLibraries();
    $aExtLib       =   $this->ElibrarySystem->getExternalLibraries();
    /*echo '<pre>';
    print_r($aLibrary);
    echo '</pre>';*/
    $sErrorMsg  =   '';
    if(count($aExtLib)){
        $sErrorMsg  =   '';
    }

?>
<div class="row">
                    <div class="col-lg-12">
                    

                     <!--  <section class="panel panel-primary">
                    <header class="panel-heading">
                   Information
                    </header>
                    <div class="panel-body">
                      

                    </div>
                    </section>
 -->

        <div class="alert alert-warning"> <h4> Important</h4> 
                            
                            Your browser will be redirected to an external page not on this server when you submit a seach keyword. </div> 


                    	
                        <section class="panel panel-primary">
                    <header class="panel-heading">
                        Searching other libraries (External Libraries)
                    </header>
                    <div class="panel-body">
                        <form role="form" action="<?php echo current_url(); ?>" method = "get" name="elibrary_esearch" target="_blank" onsubmit="return confirm('Are you sure you want to proceed to external page?');">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="bsearch_field" >External Library / Database / book Store</label>
                                <select class="form-control" id="esearch_field" name="esearch_field" required> 
                                         <option value=""> Please Select Library</option>
                                                        <?php  foreach($aExtLib as $aVal){
                                                            echo "<option value='".$aVal['lel_id']."'>".$aVal['lel_title']."</option>" ;
                                                            }

                                                        ?>

                                     </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Search keyword</label>
                                 
                                    <input name= "ekeyword" required class="form-control spinner" placeholder="Please enter a keyword to search" type="text">
                                    
                                 
                            </div>
                            <div class="form-group col-lg-4">
                        
                                <button class="form-controler btn btn-primary"   type="submit">Search  </button>
                            </div>
                             </div>

                        </form>

                    </div>
                </section>
                
                        
        		</div>  
                
        	</div>



