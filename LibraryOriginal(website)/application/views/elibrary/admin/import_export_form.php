<div class="panel panel-primary">
    <div class="panel-heading">Importing and Exporting Catalogue Item(s)  </div>
    <div class="panel-body">  
    


        <div class="row">

        <div class="col-lg-2">
             <?php echo '   <a href="'.elibraryAdminUrl('catalog/import').'" type="button" class="btn btn-primary">Import Record (s)</a>  ';?>

            </div><!-- /.col-lg-6 -->



            

            <div class="col-lg-4">
             <?php echo '   <a href="'.elibraryAdminUrl('catalog/export/').'?template=false&amp;catalogue_item_query=&cat_library_pick=&pull_record=Load+Catalogue" type="button" class="btn btn-info">Download all Catalogue Items (Excel)</a>  ';?>

                 
            </div><!-- /.col-lg-6 -->

            

            <div class="col-lg-6">
                 <?php echo '   <a href="'.elibraryAdminUrl('catalog/export/').'?template=true" type="button" class="btn btn-warning">Download Offline Record Entry Format (Excel)</a>  ';?>

            </div><!-- /.col-lg-6 -->




        </div>    


    </div>
</div>
 