    </div><!-- ./wrapper -->
 <!-- jQuery 2.1.4 -->
    <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
   <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
     /* $.widget.bridge('uibutton', $.ui.button);*/
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo getSystemRootPath() ; ?>assets/bootstrap/js/bootstrap.min.js"></script>
   
    <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    

    <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/ckeditor/ckeditor.js"></script>

    
    <!-- Slimscroll -->
   <!--  <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
    <!-- FastClick -->
   <!--  <script src="<?php echo getSystemRootPath() ; ?>assets/plugins/fastclick/fastclick.min.js"></script> -->
    <!-- AdminLTE App -->
      <script src="<?php echo getSystemRootPath() ; ?>assets/js/app.min.js"></script>  
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <!-- <script src="<?php echo getSystemRootPath() ; ?>assets/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
   <!--  <script src="<?php echo getSystemRootPath() ; ?>assets/js/demo.js"></script> -->

   <?php 
     $this->load->view('elibrary/templates/assets');
   ?>
  </body>
</html>