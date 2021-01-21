@include('admin.layout.head')


<!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
		@include('admin.layout.header')
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 			@include('admin.layout.sidebar')
			 <!-- end sidebar menu -->
            <!-- start page content -->
            @yield('content')
            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
            @include('admin.layout.footer')
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    
    @include('admin.layout.scripts')
    <!-- end js include path -->
</body>

</html>
