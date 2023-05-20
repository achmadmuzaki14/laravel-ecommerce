<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('/polluxui/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('/polluxui/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('/polluxui/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('/polluxui/images/favicon.png') }}" />
  @yield('cdn')
  @stack('style')
</head>
<body>
 
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   @include('dashboard.polluxui.partials.navbar')
    <!-- partial undernavbar-->
  
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
   
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
     @include('dashboard.polluxui.partials.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
       
        <!-- disini konten -->
        @yield('content')
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>
                    </div>
                </div>    
            </div>        
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  @yield('script')
  <script src="{{ asset('/polluxui/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('/polluxui/vendors/chart.js/Chart.min.js') }}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('/polluxui/js/off-canvas.js') }}"></script>
  <script src="{{ asset('/polluxui/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/polluxui/js/template.js') }}"></script>
  <script src="{{ asset('/polluxui/js/settings.js') }}"></script>
  <script src="{{ asset('/polluxui/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('/polluxui/js/dashboard.js') }}"></script>
  <!-- End custom js for this page-->
  @stack('script')
</body>

</html>

