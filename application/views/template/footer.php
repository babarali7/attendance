<footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, All Right Reserved
          </div>
        </div>
      </footer>
    
    </div>
  </div>
 
 
  <!--   Core JS Files   -->
  <!-- <script src="<//?=base_url();?>assets/js/core/jquery.min.js"></script> -->
  <script src="<?=base_url();?>assets/js/core/popper.min.js"></script>
  <script src="<?=base_url();?>assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?=base_url();?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="<?=base_url();?>assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?=base_url();?>assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
 <!--  <script src=".././assets/js/plugins/jquery.bootstrap-wizard.js"></script>
 -->  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?=base_url();?>assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?=base_url();?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?=base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="<?=base_url();?>assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?=base_url();?>assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
 <!--  <script src="../../assets/js/plugins/fullcalendar.min.js"></script> -->
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <!-- <script src="../../assets/js/plugins/jquery-jvectormap.js"></script> -->
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
 <!--  <script src="../../assets/js/plugins/nouislider.min.js"></script> -->
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="<?=base_url();?>assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
 <!--  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chartist JS -->
  <!-- <script src="../../assets/js/plugins/chartist.min.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="<?=base_url();?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=base_url();?>assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
   
       <!-- Include Quill stylesheet -->
   <!--     <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css" />  
 
       <script src="//cdn.quilljs.com/1.0.0/quill.min.js"></script>
  -->
    <!-- Include the Quill library -->
 <!--   <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>  -->

      <!-- Initialize Quill editor -->
       <!-- <script>
        var quill = new Quill('#editor-container', {
          modules: {
            syntax: true,
            toolbar: '#toolbar-container'
          },
          placeholder: 'Compose an epic...',
          theme: 'snow'
        });       
      </script> -->
  

 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  
  </script>
    
    <script type="text/javascript">
      $('.datepicker').datetimepicker({
         format: 'DD-MM-YYYY'
      });
    </script>


  <script>
    $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }

    // Initialise Sweet Alert library
    //  demo.showSwal();


    });
  </script>

 
  
  
</body>

</html>