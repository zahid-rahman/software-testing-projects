<!-- loading client side files for elibrary -->
<?php  $rootdir =eLibraryRootUrl(); ?>

    <script>
        var _elibrary_app_admin_root        =       '<?php echo  elibraryAdminUrl(); ?>';
        var _elibrary_app_user_root         =       '<?php echo  elibraryPortalUrl(); ?>';
        var _elibrary_app_root              =       '<?php echo  eLibraryRootUrl(); ?>';
         

       // alert(_elibrary_app_user_root);
  </script>
<!--   <script type="text/javascript" src="http://localhost/chats/arrowchat/external.php?type=djs" charset="utf-8"></script>
<script type="text/javascript" src="http://localhost/chats/arrowchat/external.php?type=js" charset="utf-8"></script>
   -->  
<?php
echo '<script src="'.elibraryAssetsLocation('js/system.js').'"> </script>';
echo '<script src="'.elibraryAssetsLocation('plugins/dataTables/jquery.dataTables.js').'"></script>';
?>  
     

    <script src="<?php echo   elibraryAssetsLocation('plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo   elibraryAssetsLocation('plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?php echo   elibraryAssetsLocation('fileinput/js/fileinput.js') ;?>" type="text/javascript"></script>
    <script src="<?php echo   elibraryAssetsLocation('modal/js/bootstrap-modalmanager.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo   elibraryAssetsLocation('modal/js/bootstrap-modal.js');?>" type="text/javascript"></script>
    <script>
    $("#userFileUploader").fileinput({
    dropZoneEnabled: true,
    uploadAsync: true,
    maxFileSize: <?php  echo __ElibraryMaxUploadSize() ; ?>,
    /*
    allowedFileExtensions: ["jpg", "gif", "png"],
    allowedFileTypes: ["image"],
    allowedPreviewTypes: ["image"],*/
    previewSettings: {
    image: {width: "240px", height: "auto"},
    other: {width: "240px", height: "auto"},
    },
    showRemove: true,
    showUpload: true,
    maxFileCount: 10,
    uploadUrl: "<?php echo elibraryPortalUrl('su'); ?>",
    msgFilesTooMany: "Number of files selected for upload ({n}) exceeds maximum allowed limit of {m}. Please retry your upload!",
    msgSizeTooLarge: "File {name} ({size} KB) exceeds maximum allowed upload size of {maxSize} KB. Please retry your upload!",
    msgInvalidFileExtension: "Invalid extension for file {name}. Only {extensions} files are supported.",
    msgFileNotFound: "File {name} not found!",
    msgFilePreviewError: "An error occurred while reading the file {name}.",
    msgInvalidFileType: "Invalid type for file {name}. Only {types} files are supported.",
    msgInvalidFileExtension: "Invalid extension for file {name}. Only {extensions} files are supported.",
    msgValidationError:"<span class='text-danger'><i class='glyphicon glyphicon-exclamation-sign'></i> File Upload Error</span>",
    msgSelected: "{n} files selected.",
    /*browseLabel: "Chọn ảnh",
    initialCaption: "Chọn tối đa 10 ảnh",*/
    });
</script> 

<?php




 
 
//echo '<script src="'.elibraryAssetsLocation('datepicker/js/bootstrap-datepicker.js').'"> </script>';
 
echo "<script>
                 $(document).ready(function () {
                   $('.dataTable .dataTables table').dataTable();     
 

                    $('#myMiscTab a').click(function (e) {
                      e.preventDefault()
                      $(this).tab('show')
                    })
 
<!-- 

                   $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'});

                    $('.dataTables, .dataTable').dataTable();
                 });
                 -->


              </script>



              ";

              
 
?>

 


<script type="text/javascript">
    
    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
    '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
        '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
    '</div>';
    </script>


<script type="text/javascript">

  $(function(){

    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
      '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
        '<div class="progress progress-striped active">' +
          '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
      '</div>';

    $.fn.modalmanager.defaults.resize = true;

    $('[data-source]').each(function(){
      var $this = $(this),
        $source = $($this.data('source'));

      var text = [];
      $source.each(function(){
        var $s = $(this);
        if ($s.attr('type') == 'text/javascript'){
          text.push($s.html().replace(/(\n)*/, ''));
        } else {
          text.push($s.clone().wrap('<div>').parent().html());
        }
      });
      
      $this.text(text.join('\n\n').replace(/\t/g, '    '));
    });

     
  });
</script>





 

 

 
 
 
 
 
                       

                     
<script src="<?php echo  elibraryAssetsLocation('js/jquery.li-scroller.1.0.js'); ?>" type="text/javascript"></script>   
 

 <script type="text/javascript">
 $(document).ready(function(){
 
 


  var slider_content = '';
 // $('#news_scroller').load(_elibrary_app_user_root+'news_events/news_pull/');
  //alert(_elibrary_app_user_root+'news_events/news_pull');
   //sendPostAjaxRequest(_elibrary_app_user_root+'news_events/news_pull','s','','#news_scroller','', '',true);
   <?php 
   $aANews = $this->MyLibrary->getNewsAndEvents(); 
   $sNews = '   <ul id="news_scroller">';
      foreach($aANews as $aNews){
 
if($this->AppUser->getUserType() == 'staff'){
  $sNews .= '<li><span>'.$aNews['lne_date'].'</span><a href="'.elibraryAdminUrl("news_event/".$aNews['lne_id']).'">'.myTruncate($aNews['lne_subject'],2).'</a></li>';
   
}else{
   $sNews .= '<li><span>'.$aNews['lne_date'].'</span><a href="'.elibraryPortalUrl("news_events/".$aNews['lne_id']).'">'.myTruncate($aNews['lne_subject'],2).'</a></li>';
    
}
         }
      $sNews .= '</ul> ';
      echo 'slider_content = '. $this->db->escape($sNews);
   ?>
   
   $("#news_scroller").html(slider_content);
   $("ul#news_scroller").liScroll();
  $("ul#news_scroller").css("visibility","visible");

  //$('.elibrary_editor').wysihtml5();

   CKEDITOR.replace('elibrary_editor');
 
 });

     
  
 </script>
 

 
