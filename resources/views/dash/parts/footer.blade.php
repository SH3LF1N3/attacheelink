<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">Designed by Sherry Obare</div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; <script>
            document.write(new Date().getFullYear())
        </script> &nbsp;
        <a href="#" class="text-decoration-none">InternLink</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>
<!--end::Footer-->
</div>
<!--end::App Wrapper-->
<!--begin::Script-->
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
<script src="/src/js/adminlte.js"></script>
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

<!-- OPTIONAL SCRIPTS -->

<!-- apexcharts -->
<script
    src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
    crossorigin="anonymous"></script>

<script>
    // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
    // IT'S ALL JUST JUNK FOR DEMO
    // ++++++++++++++++++++++++++++++++++++++++++

    /* apexcharts
     * -------
     * Here we will create a few charts using apexcharts
     */

    //-----------------------
    // - MONTHLY SALES CHART -
    //-----------------------

    const sales_chart_options = {
        series: [{
                name: 'Digital Goods',
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                name: 'Electronics',
                data: [65, 59, 80, 81, 56, 55, 40],
            },
        ],
        chart: {
            height: 180,
            type: 'area',
            toolbar: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: 'smooth',
        },
        xaxis: {
            type: 'datetime',
            categories: [
                '2023-01-01',
                '2023-02-01',
                '2023-03-01',
                '2023-04-01',
                '2023-05-01',
                '2023-06-01',
                '2023-07-01',
            ],
        },
        tooltip: {
            x: {
                format: 'MMMM yyyy',
            },
        },
    };

    const sales_chart = new ApexCharts(
        document.querySelector('#sales-chart'),
        sales_chart_options,
    );
    sales_chart.render();

    //---------------------------
    // - END MONTHLY SALES CHART -
    //---------------------------

    function createSparklineChart(selector, data) {
        const options = {
            series: [{
                data
            }],
            chart: {
                type: 'line',
                width: 150,
                height: 30,
                sparkline: {
                    enabled: true,
                },
            },
            colors: ['var(--bs-primary)'],
            stroke: {
                width: 2,
            },
            tooltip: {
                fixed: {
                    enabled: false,
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter() {
                            return '';
                        },
                    },
                },
                marker: {
                    show: false,
                },
            },
        };

        const chart = new ApexCharts(document.querySelector(selector), options);
        chart.render();
    }

    const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
    const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
    const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
    const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
    const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
    const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
    const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

    createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
    createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
    createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
    createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
    createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
    createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
    createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

    //-------------
    // - PIE CHART -
    //-------------

    const pie_chart_options = {
        series: [700, 500, 400, 600, 300, 100],
        chart: {
            type: 'donut',
        },
        labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
        dataLabels: {
            enabled: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
    };

    const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
    pie_chart.render();

    //-----------------
    // - END PIE CHART -
    //-----------------
</script>
<!--plugins-->
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