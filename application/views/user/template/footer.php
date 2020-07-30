        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Musrenbang</b>
      </div>
      <strong><a href="http://adminlte.io">Kelurahan Hamadi</a></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/appuser.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/controller/usercontroller.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/directives.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/angular-datatables/dist/angular-datatables.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?= base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url();?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="<?=base_url();?>assets/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?= base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url();?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?=base_url();?>assets/dist/js/demo.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/services/helper.services.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/directives.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/services/userdata.service.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/angular-locale_id-id.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/input-mask/angular-input-masks-standalone.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/bower_components/jquery-loading-overlay/dist/loadingoverlay.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle=tooltip]').hover(function(){
          // on mouseenter
          $(this).tooltip('show');
      }, function(){
          // on mouseleave
          $(this).tooltip('hide');
      });
    });
    
    $(document).ready(function () {
      bsCustomFileInput.init();
    });

    $(function () {
      $(document).ready(function () {
          var data = $('.data-flush').data('flash');
          console.log(data);
          if (data) {
              var a = data.split(',');
              if (a[1].replace(/\s/g, '') == 'success') {
                  swal("Information!", a[0], "success");
              } else {
                  swal("Information!", a[0], "error");
              }
          }
      })
    })

    $('.select2').select2({
      placeholder: "Pilih item"
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  </script>
</body>

</html>