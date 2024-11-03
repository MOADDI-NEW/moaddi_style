<!-- jQuery -->
<script src="../layout/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../layout/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<!--<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" href="../layout/plugins/bootstrap/js/rtl.js">
<!-- Bootstrap 4 -->
<script src="../layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../layout/plugins/datatables/jquery.dataTables.js"></script>
<script src="../layout/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- Select2 -->
<script src="../layout/plugins/select2/js/select2.full.min.js"></script>

<!-- ChartJS -->
<script src="../layout/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../layout/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../layout/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../layout/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="../layout/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../layout/plugins/moment/moment.min.js"></script>
<script src="../layout/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../layout/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../layout/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../layout/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../layout/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../layout/dist/js/pages/dashboard.js"></script> -->
<!-- SweetAlert2 -->
<script src="../layout/dist/js/sweetalert2.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../layout/dist/js/demo.js"></script>




<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        var printCounter = 0;
        // Append a caption to the table before the DataTables initialisation
        // $('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');

        $('#example').DataTable({
            "pageLength": 60,
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    messageTop: 'تم التصدير  بنجاح.'
                },

                {
                    extend: 'print',
                    messageTop: function() {
                        return '<img src=\"../layout/images/panne.jpg\" style=\"background-position: center;background-repeat: no-repeat;background-size: cover; position: relative; width:99%;\" />';
                    },
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body)
                            .css('text-align', 'center', );
                        $(win.document.body)
                            .css('direction', 'rtl', );
                        $(win.document.body)
                            .css('font-family', 'cairo', );
                        $(win.document.body)
                            .css('margin-left', '15px', );
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', '7pt');
                    },

                    messageBottom: null
                }
            ]
        });
    });
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    })
</script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            iconColor: 'white',
            showConfirmButton: false,
            customClass: {
                popup: 'colored-toast'
            },
            timer: 3000
        });

        // $('.swalDefaultSuccess').click(function() {
        //     Toast.fire({
        //         type: 'success',
        //         title: 'تمت عملية معالجة البيانات بنجاح'
        //     })
        // });


    });
</script>
<script>
    $('.deleteEmployee').click(function(event) {
        event.preventDefault();
        event.stopPropagation();
        var target = event.target
        Swal.fire({
            title: 'تأكيد عملية الحذف ؟',
            text: "بعد تأكيد الحذف لا يمكن التراجع",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم .. أحذف',
            cancelButtonText: 'لا .. تراجع',
            backdrop: `rgba(0,80,123,0.8)`
        }).then((result) => {
            if (result.value) {
                event.isDefaultPrevented = function() {
                    return false;
                }
                $(this).trigger(event);
            }
        })

    });
</script>

</body>

</html>