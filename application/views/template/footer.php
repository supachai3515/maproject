

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>WISADEV</b> Admin System | Version 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="<?php echo base_url(); ?>">WISADEV</a>.</strong> All rights reserved.
    </footer>
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-1.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/locales/bootstrap-datepicker.th.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-timepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- page script -->
  <?php $this->load->view("js/main_app"); ?>
  <?php if(isset($script_file)){echo $this->load->view($script_file); }?>
</body>
</html>
