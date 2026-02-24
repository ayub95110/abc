</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>KaphoHospital BY IM &copy; AY.Web</strong>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Bootstrap 4 -->
<script src="../assets/bootstrap.bundle.min.js"></script>

<!-- DataTables JS libraries (เลือกเพียงชุดเดียว) -->
<script src="../assets/dataTables.buttons.min.js"></script>
<script src="../assets/buttons.bootstrap4.min.js"></script>
<script src="../assets/jszip.min.js"></script>
<script src="../assets/pdfmake.min.js"></script>
<script src="../assets/vfs_fonts.js"></script>
<script src="../assets/buttons.html5.min.js"></script>
<script src="../assets/buttons.print.min.js"></script>
<script src="../assets/buttons.colVis.min.js"></script>
<script src="../assets/tagsinput.js?v=1"></script>
<!-- DataTables -->
<link rel="stylesheet" href="../assets/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/buttons.bootstrap4.min.css">

<!-- Select2 CSS and JS -->
<script src="../assets/select2.full.min.js"></script>
<script src="../assets/sweetalert2@9.js"></script>
<script src="../assets/adminlte.min.js"></script>
<script src="../assets/demo.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    

    // Initialize DataTables for example1
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [
            [0, "asc"]
        ],
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // Initialize DataTables for example2
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true, // Enable length change
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
    });

    // Initialize DataTables for example3 (if needed)
    $('#example3').DataTable({
        scrollX: true,
        autoWidth: false,
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100, -1],
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: 'ดาวน์โหลด Excel',
            title: 'ข้อมูลบุคลากร',
            exportOptions: {
                columns: ':visible'
            }
        }]
    });

    // Initialize DataTables for example4
    $("#example4").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [
            [0, "asc"]
        ],
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
});
</script>