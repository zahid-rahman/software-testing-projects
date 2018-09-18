
<div class="row"> 

 <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Today's transactions</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div style="display: block;" class="box-body"> 

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('reservations')); ?></h3>
                            <p>Reserved Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('reservations/') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('borrowed') ); ?></h3>
                            <p>Borrowed Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('borrowed') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('returned') ); ?></h3>
                            <p>Returned Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('returned') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3> <?php echo elibrary_toNumber( elibrary_dashboard('violation')); ?></h3>
                            <p>Violations</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('violation') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


 

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

</div>




<div class="row"> 

 <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">All  transactions</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div style="display: block;" class="box-body"> 

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('reservations',true)); ?></h3>
                            <p>Reserved Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('reservations/') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('borrowed',true) ); ?></h3>
                            <p>Borrowed Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('borrowed') ;?>+" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo elibrary_toNumber(elibrary_dashboard('returned',true) ); ?></h3>
                            <p>Returned Resources</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('returned') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3> <?php echo elibrary_toNumber( elibrary_dashboard('violation',true)); ?></h3>
                            <p>Violations</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                          </div>
                          <a href="<?php echo elibraryAdminUrl('violation') ;?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                    </div><!-- ./col -->


 

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

</div>



 

<div class="row"> 

 <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Active Libraries / Catalogues</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div style="display: block;" class="box-body"> 

              

                <div class="panel panel-primary">
                         <div class="panel-heading">Active Libraries / Catalogues  Record List</div>
                            <div class="panel-body">
                              <?php $aRecordList = getLibrariesWithCatalogueNumber();   
                               $sBuff = '';
                               if(count($aRecordList)){
                                $sBuff .= '<div class="list-group">';
                                foreach($aRecordList as $aVal){

                                
                                $sBuff .= '
                                <a href="'.base_url('elibrary/admin/catalog?cat_library_pick='.$aVal["ll_id"].'&amp;pull_record=Load+Catalogue').'" target ="_blanck" class="list-group-item">
                                        <i class=" icon-comment"></i> '.$aVal["ll_title"].'
                                      <span class="pull-right text-muted small badge"><em>'.elibrary_toNumber($aVal["ll_count"]).' </em>
                                      </span>
                                    </a>';
                                
                              }
                              $sBuff .= '</div>';
                              }else{
                                $sBuff .= '<div clas="alert alert-info"> You do not have any active libary record.  </div>';
                              }

                              echo $sBuff;

                              ?>
                            </div>
                    </div>
 

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

</div>
