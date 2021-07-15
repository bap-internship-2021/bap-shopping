<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('admin/assets/images/favicon.png')}}">
    <title>Nice admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{URL::asset('admin/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{URL::asset('admin/dist/css/style.min.css')}}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> -->
    <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
            @include('admin.layouts.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
            @include('admin.layouts.left-sizebar')
        <!-- Left Sidebar - styllayouts.e you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <div class="page-wrapper" style="display:block";>
            @yield('content')
        </div>

        <!-- ============================================================== -->
            @include('admin.layouts.footer')
        <!-- End footer -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="{{URL::asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{URL::asset('admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{URL::asset('admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{URL::asset('admin/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{URL::asset('admin/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{URL::asset('admin/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{URL::asset('admin/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{URL::asset('admin/dist/js/pages/dashboards/dashboard1.js')}}"></script>
    
    <!-- ckeditor -->
    
    
    <!-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace('demo'); </script> -->
    

 
  

    

    
</body>

</html>