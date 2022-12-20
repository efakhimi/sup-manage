
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-block-down">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>CopyRight &copy; 2022 <a href="https://www.arshammachine.com/">آرشام ماشین فرزام</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/assets/plugins/select2/select2.full.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('/assets/dist/js/adminlte.js') }}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('/assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- Persian Data Picker -->
<script src="{{ asset('/assets/dist/js/persian-date.min.js') }}"></script>
<script src="{{ asset('/assets/dist/js/persian-datepicker.min.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('/assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- <script src="{{ asset('/assets/dist/js/pages/dashboard3.js') }}"></script> -->

@if(Illuminate\Support\Facades\Route::is('customerList') OR Illuminate\Support\Facades\Route::is('contractList'))
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "columnDefs": [
          { "type": "num", "targets": 0 }
        ],
        "language": {
            "paginate": {
                "first":      "اولین",
                "last":       "آخرین",
                "next": "بعدی",
                "previous" : "قبلی"
            },
            "lengthMenu":     "نمایش _MENU_ شرکت در هر صفحه",
            "search":         "جستجو:",
            "zeroRecords":    "موردی یافت نشد",
            "infoEmpty":      "نمایش 0 تا 0 از 0 شرکت",
        },
        "info" : false,
    });
  });
</script>
@endif

@if(Illuminate\Support\Facades\Route::is('contractNew') or Illuminate\Support\Facades\Route::is('contractUpdate') or Illuminate\Support\Facades\Route::is('contractNewForCustomer'))
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()
    $('#start_date').persianDatepicker(
      {
        // calendar: {
        //   persian: {
        //     locale: "en",
        //   }
        // },
        format: 'YYYY/MM/DD',
        autoClose: true
      }
    );
    $('#end_date').persianDatepicker(
      {
        // calendar: {
        //   persian: {
        //     locale: "en",
        //   }
        // },
        initialValueType: 'gregorian',
        format: 'YYYY/MM/DD',
        autoClose: true
      }
    );
  })
</script>
@endif
</body>
</html>