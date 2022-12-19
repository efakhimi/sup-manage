
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
<!-- DataTables -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('/assets/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('/assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('/assets/dist/js/demo.js') }}"></script>
<script src="{{ asset('/assets/dist/js/pages/dashboard3.js') }}"></script>

@if(Illuminate\Support\Facades\Route::is('customerList'))
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "language": {
            "paginate": {
                "next": "بعدی",
                "previous" : "قبلی"
            }
        },
        "info" : false,
    });
  });
</script>
@endif

</body>
</html>