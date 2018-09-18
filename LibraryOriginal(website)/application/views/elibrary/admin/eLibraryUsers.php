<?php

?>

                        <div class="panel panel-primary">
                            <div class="panel-heading">eLibrary System Users</div>
                            <div class="panel-body">
                                
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables" id="dataTables-courses">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Name</th>
                                                            <th>Access Type</th>
                                                            <th>Last Seen</th>
                                                            <th>Action</th>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php
															$o = "" ;
															 
															$row_total = 12;
															
															for($i = 0; $i < $row_total; $i++){
																
																$o .= "<tr class=''>" ;
																	$o .= "<td>".($i+1)."</td>" ;
																	$o .= "<td>COMPLEX ANALYSIS II</td>" ;
																	$o .= "<td>Laurent expansions. Isolated singularities and residues...</td>" ;
																	$o .= "<td class='center'>3</td>" ;
																	$o .= "<td class='center'>Mathematics</td>" ;
																	
																$o .= "</tr>" ;
																
																 
															}
															echo $o;
														?>
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                            </div>
                             
                            
                            