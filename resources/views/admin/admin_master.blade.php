<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

  <!-- select2 css -->
  <link href="{{asset('backend/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Plugins css -->
  <link href="{{asset('backend/assets/libs/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />

  <!-- DataTables -->
  <link href="{{asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="{{asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Bootstrap Css -->
  <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Icons Css -->
  <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- App js -->
  <script src="{{asset('backend/assets/js/plugin.js')}}"></script>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

<body data-sidebar="dark">

  <!-- <body data-layout="horizontal" data-topbar="dark"> -->

  <!-- Begin page -->
  <div id="layout-wrapper">


    @include('admin.body.header')

    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.body.sidebar')
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      @yield('admin')

      <!-- End Page-content -->

      @include('admin.body.footer')
    </div>
    <!-- end main content-->

  </div>
  <!-- END layout-wrapper -->

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>

  <!-- JAVASCRIPT -->
  <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

  <!-- Required datatable js -->
  <script src="{{asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

  <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

  <!-- Responsive examples -->
  <script src="{{asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

  <!-- Datatable init js -->
  <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>

  <!-- select 2 plugin -->
  <script src="{{asset('backend/assets/libs/select2/js/select2.min.js')}}"></script>

  <!-- Plugins js -->
  <script src="{{asset('backend/assets/libs/dropzone/dropzone-min.js')}}"></script>

  <!-- init js -->
  <script src="{{asset('backend/assets/js/pages/ecommerce-select2.init.js')}}"></script>

  <!-- apexcharts -->
  <script src="{{asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

  <!-- dashboard init -->
  <script src="{{asset('backend/assets/js/pages/dashboard.init.js')}}"></script>

  <!-- App js -->
  <script src="{{asset('backend/assets/js/app.js')}}"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ", '', { positionClass: 'toast-bottom-right' });
    break;
  }
  @endif
  </script>

  <script src="{{ asset('backend/validate.min.js') }}"></script>
  <script src="{{ asset('backend/handlebars.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script src="{{ asset('backend/code.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" ></script>

</body>
</html>
