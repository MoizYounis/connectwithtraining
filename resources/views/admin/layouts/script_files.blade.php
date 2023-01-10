 <!-- Bootstrap core JavaScript-->
  <script src="{{asset('public/assets/admin/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/popper.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/bootstrap.min.js')}}"></script>
  
 <!-- simplebar js -->
  <script src="{{asset('public/assets/admin/plugins/simplebar/js/simplebar.js')}}"></script>
  <!-- sidebar-menu js -->
  <script src="{{asset('public/assets/admin/js/sidebar-menu.js')}}"></script>
  <!-- loader scripts -->
  <script src="{{asset('public/assets/admin/js/jquery.loading-indicator.html')}}"></script>
  <!-- Custom scripts -->
  <!--notification js -->
  <script src="{{asset('public/assets/admin/plugins/notifications/js/lobibox.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/notifications/js/notifications.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/notifications/js/notification-custom-script.js')}}"></script>
  
  <script src="{{asset('public/assets/admin/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>

  <script src="{{asset('public/assets/admin/js/app-script.js')}}"></script>
  <!-- Chart js -->
  
  <script src="{{asset('public/assets/admin/plugins/Chart.js/Chart.min.js')}}"></script>
  <!-- Vector map JavaScript -->
  <script src="{{asset('public/assets/admin/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- Easy Pie Chart JS -->
  <script src="{{asset('public/assets/admin/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
  <!-- Sparkline JS -->
  <script src="{{asset('public/assets/admin/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/jquery-knob/excanvas.js')}}"></script>
  <script src="{{asset('public/assets/admin/plugins/jquery-knob/jquery.knob.js')}}"></script>
  <script src="{{asset('public/assets/admin/js/formValidation.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="{{asset('public/assets/admin/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
  <!-- Dropzone css -->
    <script src="{{asset('public/assets/admin/plugins/dropzone/dropzone.js')}}"></script>
    <script>
        $(function() {
            $(".knob").knob();
        });


    </script>

<script>
    @if(Session::has('success'))
        success_noti("{{ Session::get('success') }}");
    @endif
    
    @if (count($errors) > 0)
        @foreach($errors->all() as $error)
            error_noti("{{ $error }}");
        @endforeach
    @endif
    
    $("#example1").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
  <!-- Index js -->
  <!-- <script src="{{asset('public/assets/admin/js/index.js')}}"></script> -->

<!-- <script src="{{asset('public/assets/admin/plugins/alerts-boxes/js/sweetalert.min.js')}}"></script>
<script src="{{asset('public/assets/admin/plugins/alerts-boxes/js/sweet-alert-script.js')}}"></script> -->
