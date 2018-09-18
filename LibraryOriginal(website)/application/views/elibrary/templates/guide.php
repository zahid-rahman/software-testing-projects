<style type="text/css">
    
    .system_guide_details_writeup{
        padding: 10px;
    }
    .system_guide_details_writeup_header{
        padding-top: 20px;
        font-weight: bolder;
    }
</style>
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">System Guide</div>
                    <div class="panel-body"> 

            <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">System Guide</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#accord_ref_1">
                            elibrary Module Summary
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_ref_1" class="panel-collapse collapse">
                        <div class="box-body">
                          <p>This module is designed to enable the library administrator manage the library and carry out other sundry tasks. </p>
                            <p>The   module enables authorized users perform the following operations: borrow books from the library, recommend books, make a book order for the library, catalogue new books,   set fines payable by defaulting library users, approve/disapprove book loans, return of borrowed books; manage journals; administer the library which includes adding new library (internal and external), registering of external sites, managing all kinds of books (electronic and hard copy). Create a reading time table, edit reading time table, view existing time table, practice and review past questions.</p>
                        </div>
                      </div>
                    </div> 
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_dashboard">
                            Dashboard
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_dashboard" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>The "Dashboard" section of this system shows a summarized infomation of records which include <ul type="1">   
                             
                                <li>Reserved library Resources (For today and other days.) </li>
                                <li>Borrowed library Resources (For today and other days.) </li>
                                <li>Returned library Resources (For today and other days.)  </li>
                                <li>Violations (For today and other days.)  </li>

                                <li>Created local libraries</li>

                            </ul> </p>
                             
                      
                            </div>
                        </div>
                      </div>
                    </div>


<?php 

    if($this->AppUser->bHasAccess('elibrary_admin'))
    {


        ?>


                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_system_config">
                            System Management
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_system_config" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>
                                This section   allows an authorized user to set core system settings  which made up of two four(4) sub-sections which include  the following
                                <ul>
                                    <li><strong>Catalog management :  </strong> Creating/editing/deleting library catalog records</li>
                                    <li><strong>Physical library management: </strong> Adding/modifying physically sited library to the system </li>
                                    <li><strong>eLibrary mangement: </strong> Creating / editing / deleting eLibrary records</li>
                                     <li><strong> Misc. Records :</strong> This manages all the type of resources that can be added to library catalog system (format, category) and type of violations approved by the institution</li>


                                </ul>

             
                            </p>
                             
                            

                         <h4 class="system_guide_details_writeup_header">Viewing,  adding, editing and deleting  Category Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                             
                            <li>Click on "System Management" link</li>
                            <li>Click on "Misc. Record" sub-link</li>
                            <li>Select the "Category" tab</li>
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "action" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create new category +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>


                        <h4 class="system_guide_details_writeup_header">Viewing,  adding, editing and deleting  "Format" Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                             
                            <li>Click on "System Management" link</li>
                            <li>Click on "Misc. Record" sub-link</li>
                            <li>Select the "Format" tab</li>
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "action" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create new Format +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>




                        <h4 class="system_guide_details_writeup_header">Viewing,  adding, editing and deleting  "Violation" Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                            
                            <li>Click on "System Management" link</li>
                            <li>Click on "Misc. Record" sub-link</li>
                            <li>Select the "Violation" tab</li>
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "Manage" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create new Violation +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>


                        <h4 class="system_guide_details_writeup_header">Viewing,  adding, editing and deleting  "eLibrary" Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                             
                            <li>Click on "System Management" link</li>
                            <li>Click on "eLibrary Management" sub-link</li>
                            
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "Action" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create new External Library +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>

                        <h4 class="system_guide_details_writeup_header">Viewing,  adding, editing and deleting  "Local Library" Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                             
                            <li>Click on "System Management" link</li>
                            <li>Click on "Local Library Management" sub-link</li>
                            
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "Action" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create New  +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>


                        <h4 class="system_guide_details_writeup_header">Searching, Viewing all,  adding, editing and deleting  "Catalog" Record</h4>
                        <hr/>

                        <p> 
                        <ul type = "1"> 
                            
                            <li>Click on "System Management" link</li>
                            <li>Click on "Catalog" sub-link</li>
                            <li>To search for an item, type your search criteria in the "catalog query info" filed, select the library you want to search from and click on "Load Catalogue" button</li>
                            <li>To view all records, just click on "Load Catlogue" button</li>
                            <li>List of already created records will now be visible</li>
                            <li>To edit or delete, click on the "Action" button of the item you want to work on</li>
                            <li>To create new record, click on the "Create new Catalogue +" button and fill the neccessary fields" and save the record</li>


                        </ul>


                        </p>
                        <br/>

         
                         
                         </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_Transaction">
                            Transaction
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_Transaction" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>
                               The "Transaction" section of this system is divided into four sections which give access to authorized users to <ul type="1" > 
                               <li>View elibrary resources reservation made by  users</li>
                               <li>Lend resource and view lent resources</li>
                               <li>Enter record for resources being returned by users</li>
                               <li>View records of violators, fines and status of the record </li>

                                
                            </p>

                              
                        
                         <br/>


                        <h4 class="system_guide_details_writeup_header">Viewing Reservations Records</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                                 
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Resource Reservation" sub-link</li>
                                 

                            </ul>
                        </p>

                        <h4 class="system_guide_details_writeup_header">Viewing Borrowed Resource Records</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                                 
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Borrowed Resources" sub-link</li>
                                 

                            </ul>
                        </p>

                         <h4 class="system_guide_details_writeup_header">Borrow resource to user</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                              
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Borrowed Resources" sub-link</li>
                                <li>Click on "Create New +" button</li>
                                <li>Enter a search criteria for the item in question</li>
                                <li>Fill the neccessary field and save.</li>
                                 

                            </ul>
                        </p>

                        <h4 class="system_guide_details_writeup_header">Viewing Borrowed Resources Records</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                                
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Borrowed Resources" sub-link</li>
                                 

                            </ul>
                        </p>




                        <h4 class="system_guide_details_writeup_header">Viewing Returned Resources Records</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                                
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Returned Resources" sub-link</li>
                                 

                            </ul>
                        </p>


                        <h4 class="system_guide_details_writeup_header">Retuning borrowed Resources</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                               
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Returned Resources" sub-link</li>
                                <li>Click on "Create New +" button</li>
                                <li>Enter the user's unique code to view all unreturned linked to his/her account</li>
                                <li>Select the item to return and enter the neccessary information if the user has violate any rule/regulations</li>
                                 

                            </ul>
                        </p>

                        <h4 class="system_guide_details_writeup_header">Viewing violations Records</h4>
                        <hr/>
                        <p>
                            <ul type = "1">
                                
                                <li>Click on "Transaction" link</li>
                                <li>Click on "Violation" sub-link to view records</li>
                                 

                            </ul>
                        </p>

         


                        </div>
                        </div>
                      </div>
                    </div>




                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_courses">
                           News &amp; Event
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_courses" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>News &amp; events setion of this module allows authorized users to create/ edit and publish news/events to the library users community </p>

                            <h4 class="system_guide_details_writeup_header">Viewing List of created news and their publish status</h4>
                            <hr/>
                            <p>
                            <ul type = "1">
                                
                                <li>Click on "News &amp; Event" link</li>
                                 

                            </ul>
                        </p>

                        <h4 class="system_guide_details_writeup_header">Create a new news/events</h4>
                            <hr/>
                            <p>
                            <ul type = "1">
                               
                                <li>Click on "News &amp; Event" link</li>
                                <li>Click on "Create New   +" button</li>
                                <li>Fill the form fields(s) and click on "Save record" button</li>

                            </ul>
                        </p>

                        <h4 class="system_guide_details_writeup_header">Create a new news/events</h4>
                            <hr/>
                            <p>
                            <ul type = "1">
                                 
                                <li>Click on "News &amp; Event" link</li>
                                <li>Click on "Create New   +" button</li>
                                <li>Fill the form fields(s) and click on "Save record" button</li>

                            </ul>
                        </p>
         

                        </div>
                        </div>
                      </div>
                    </div>

                        <?php }
?>




                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_result_my_student">
                            OPAC Search
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_result_my_student" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>"OPAC Search" is an online catalog search system that allows you to search for library resources hosted on our local server (using basic / advanced searches) or external servers(external search). This feature also allow you to view your previous serach history.</p>
                            

                            <h4 class="system_guide_details_writeup_header">Performing a search</h4>
                            <hr/>
                                <p>This can be achieved in four different ways either  by  <ul>  
                                <li><strong>Basic Search : </strong>  Performs a basic and less-filtered search for resources hosted on our server(s)</li>
                                <li><strong>Advanced Search : </strong>  Performs an advanced and more-filtered search for resources hosted on our server(s)</li>
                                <li><strong>External Search : </strong>  This search will redirect you to a thirdparty server to fetch the resource you requested for</li>
                                <li><strong> Previous Search : </strong> This will show all the previous search queries(basic and advance only) linked to your account.</li>
                                </ul>  </p>
                             
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_reslut_summary">
                            My Library
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_reslut_summary" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>"My Librarys" is a section of this system that gives you access to record linked to your account which include 
                            <ul type='1'> 
                                <li>Your Private uploads</li> 
                                <li>Reservations</li> 
                                <li>Borrowed Resource</li> 
                                <li>Violations of rule/instructions and fines</li>  
                            </ul> 
                            </p>
                       
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_result_complaint">
                            Messages
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_result_complaint" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">
                            <p>Its an internal mailing systems thats allows you to send and recieve electronic messages.</p>
                      
                            <h4 class="system_guide_details_writeup_header">Creating &amp; Sending Messages</h4>
                            <hr/>
                             <p>
                              <ul>
                                    
                                    <li>Click on "Messages" link and then click on "Compose" link</li>
                                    <li>Enter the reciever's unique ID Code (email or library ID), subject of the message, messages's content</li>
                                    <li>Click on "Send Message" button </li>

                              </ul>
                            </p>

                            <h4 class="system_guide_details_writeup_header">Inbox</h4>
                            <hr/>
                            <p>It shows you all the messages sent to you by other users</p>
                              

                              <h4 class="system_guide_details_writeup_header">Sent</h4>
                            <hr/>
                            <p>It shows you all the messages  you sent to other users</p>
                               

                        </div>
                        </div>
                      </div>
                    </div>



                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_workspace">
                           My Shelves
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_workspace" class="panel-collapse collapse">
                        <div class="box-body">
                          <div class="system_guide_details_writeup">

                            <p>"My shelves" as the name implies is an electronic version of your physical library shelve that allows you to keep your library resources in group-like manner.</p>
                      
                            <h4 class="system_guide_details_writeup_header">Creating New shelve  </h4>
                            <hr/>
                             <p>
                                <ul type = "1">
                                     
                                    <li>Click on "My shelves" link</li>
                                    <li>Click on "Create New Shelf +" button</li>
                                    <li>Fill the form fields(s) and click on "Save record" button</li>

                                </ul>
                            </p>

                            <h4 class="system_guide_details_writeup_header">Viewing Shelf Items </h4>
                            <hr/>
                            <p><ul type = "1">
                                 
                                <li>Click on "My shelves" link</li>
                                <li>Click on the desired shelf title from the "My Shelves" table</li>
                                </ul>

                            </p>

                            <h4 class="system_guide_details_writeup_header">Adding Item to shelf</h4>
                            <hr/>
                            <p>
                                <ul type = "1">
                                
                                <li>Click on "OPAC Search" link</li>
                                <li>Select either basic or advance serach to search for a resource</li>
                                <li>Click on "Add to Shelf" button </li>
                                <li>Select the shelf you want to add the resource to and click on "Save Record" button</li>
                                </ul>

                            </p>
                 
                        </div>
                        </div>
                      </div>
                    </div>


                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a aria-expanded="false" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#accord_library_news">
                            Library News
                          </a>
                        </h4>
                      </div>
                      <div style="height: 0px;" aria-expanded="false" id="accord_library_news" class="panel-collapse collapse">
                        <div class="box-body">
                         <div class="system_guide_details_writeup">
                            <p>"Library News" section of this system shows you lists of the latest happenings (news/ events)</p>
                      
                            <h4 class="system_guide_details_writeup_header">Viewing news/events' details</h4>
                            <hr/>
                             <p>
                              To view the details of any news / events, simply click on the "Subject/title" link of your desired list item and the system will redirect you to a detail page.
                            </p>
                            </div>
                        </div>
                      </div>
                    </div>

 
 


                  </div>
                </div><!-- /.box-body -->
              </div>




 



 
    

     
  



 



  

 
 

        </div>
        </div>
        </div>
        </div>