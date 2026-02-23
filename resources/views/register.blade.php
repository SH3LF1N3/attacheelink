<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>InternLink | Register </title>

  <!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <!--end::Accessibility Meta Tags-->

  <!--begin::Primary Meta Tags-->
  <meta name="title" content="AdminLTE 4 | Register Page" />
  <meta name="author" content="ColorlibHQ" />
  <meta
    name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
  <meta
    name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Features-->
  <!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark" />
  <link rel="preload" href="/src/css/adminlte.css" as="style" />
  <!--end::Accessibility Features-->

  <!--begin::Fonts-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
    crossorigin="anonymous"
    media="print"
    onload="this.media = 'all'" />
  <!--end::Fonts-->
  <link rel="stylesheet" href="/src/plugins/fontawesome-free/css/all.min.css">
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="/src/css/adminlte.css" />
  <!--end::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="/src/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/src/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/src/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <!-- DataTables -->
  <link rel="stylesheet" href="/src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="/src/plugins/bs-stepper/css/bs-stepper.min.css">

  <link rel="stylesheet" href="/src/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link rel="stylesheet" href="/src/plugins/select2/css/select2.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/src/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/src/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/src/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="register-page bg-body-secondary">
  <div class="register-box">
    <div class="register-logo">
      <a href="{{ route('login') }}"><b>Intern</b>Link</a>
    </div>
    <!-- /.register-logo -->
    <div class="card">
      <div class="card-body ">
        <p class="register-box-msg">Create a new account</p>

        <form action="../index3.html" method="post">

          <div class="form-group">
            <label>Select User Type</label>
            <select class="custom-select form-control-border" id="expa" onchange="expachange()" required>
              <option value="">Select User Type</option>
              <option value="0">Student</option>
              <option value="1">Company</option>
            </select>
          </div>

          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username" required>
          </div>

          <div id="fid" style="display: none;">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter full name">
            </div>
          </div>

          <div id="oid" style="display: none;">
            <div class="form-group">
              <label>Organization Name</label>
              <input type="text" class="form-control" id="orgname" name="orgname" placeholder="Enter organization name">
            </div>
          </div>


          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
          </div>



          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
          </div>

          <div id="gender" style="display: none;">
            <div class="form-group">
              <label>Gender</label>
              <select class="custom-select form-control-border" id="gen">
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
          </div>

          <div id="studentid" style="display: none;">
            <div class="form-group">
              <label for="exampleInputFile">Student Identification</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
          </div>

          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
          </div>
          <!--begin::Row-->
          <div class="row">
            <div class="col-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>

        <p class="mb-0">
          <a href="{{url('/') }}" class="text-center"> I already have a membership </a>
        </p>
      </div>
      <br>
      <!-- /.register-card-body -->
    </div>
  </div>
  <!-- /.register-box -->
  <script>
    function expachange() {


      const selectedType = document.getElementById("expa").value;
      const gender = document.getElementById("gender");
      const studentid = document.getElementById("studentid");
      const fid = document.getElementById("fid");
      const oid = document.getElementById("oid");


      if (selectedType === "0") {
        gender.style.display = "block";
        studentid.style.display = "block";
        fid.style.display = "block";
        oid.style.display = "none";

      } else {
        gender.style.display = "none";
        studentid.style.display = "none";
        fid.style.display = "none";
        oid.style.display = "block";
      }
    }
  </script>
  <script>
    document.getElementById('bform').addEventListener('submit', function(e) {
      const expaname = document.getElementById('expa');
      const comname = document.getElementById('com');
      const errordp = document.getElementById('statusError');
      const error = document.getElementById('comError');

      // alert(expaname.value);

      if (!expaname.value) {
        e.preventDefault(); // Prevent form from submitting
        errordp.style.display = 'block'; // Show error
        expaname.classList.add('is-invalid');
        expaname.focus();
      } else {
        errordp.style.display = 'none';
        expaname.classList.remove('is-invalid');
      }


      if (!comname.value) {
        e.preventDefault(); // Prevent form from submitting
        error.style.display = 'block'; // Show error
        comname.classList.add('is-invalid');
        comname.focus();
      } else {
        error.style.display = 'none';
        comname.classList.remove('is-invalid');
      }
    });
  </script>
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>

  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="src/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

      // Disable OverlayScrollbars on mobile devices to prevent touch interference
      const isMobile = window.innerWidth <= 992;

      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->
  <script src="/src/plugins/jquery/jquery.min.js"></script>
  <script src="/src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/src/plugins/select2/js/select2.full.min.js"></script>
  <script src="/src/dist/js/adminlte.js"></script>

  <!-- jQuery 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

  <!--<script src="/src/plugins/select2/js/select2.min.js"></script>
<script src="/src/plugins/select2/js/custom-select.js"></script>-->
  <script src="/src/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="/src/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <!-- bs-custom-file-input -->
  <script src="/src/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)


    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
  </script>

  <script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
  </script>
  <!-- Bootstrap 4 -->
  <!-- ChartJS -->
  <script src="/src/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="/src/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="/src/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="/src/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="/src/plugins/jquery-knob/jquery.knob.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="/src/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/src/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/src/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <!-- 
<script src="/src/dist/jss/jquery.dataTables.min.js"></script>
<script src="/src/dist/jss/dataTables.bootstrap4.min.js"></script>-->

  <script src="/src/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="/src/plugins/sweetalert2/sweetalerts.min.js"></script>

  <script src="/src/plugins/jszip/jszip.min.js"></script>
  <script src="/src/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/src/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/src/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/src/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/src/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        scrollX: true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        scrollX: true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
      $('#example3').DataTable({
        scrollX: true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
      $('#example4').DataTable({
        scrollX: true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
      new DataTable('#example', {
        scrollX: true
      });

      $('#example1').on('draw.dt', function() {
        $('.select2').select2();
      });


    });
  </script>
  <!-- daterangepicker -->
  <script src="/src/plugins/moment/moment.min.js"></script>
  <script src="/src/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="/src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="/src/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="/src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->


  <!-- AdminLTE for demo purposes -->
  <script src="/src/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="/src/dist/js/pages/dashboard.js"></script>
  <script src="/src/plugins/summernote/summernote-bs4.min.js"></script>
  <script src="/src/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      //Add text editor
      $('#compose-textarea').summernote()
    })


    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
  </script>
  <script>
    // Check every 30 seconds if user is still authenticated
    setInterval(function() {

      //alert("hey log out");
      fetch('/check-auth') // Create this route
        .then(response => {
          if (response.status === 401) {
            console.log('Not authenticated, redirecting...');
            window.location.href = '/';
          } else {
            console.log('Logged Out');
          }
        });
    }, 30000);
  </script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
      })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
      })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      $('#reservationdate').datetimepicker({
        format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({
        icons: {
          time: 'far fa-clock'
        }
      });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker({
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function(start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/target-url", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() {
        myDropzone.enqueueFile(file)
      }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
  </script>

  <script>
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
  </script>
  <!--end::Script-->
</body>
<!--end::Body-->

</html>