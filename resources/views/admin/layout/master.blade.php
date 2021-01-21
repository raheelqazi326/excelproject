@include('admin.layout.head')


<!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
		@include('admin.layout.header')
        <!-- end header -->
        <!-- start color quick setting -->
        <div class="quick-setting-main">
			<button class="control-sidebar-btn btn" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></button>
			<div class="quick-setting display-none">
				<ul id="themecolors" >
				<li><p class="selector-title">Main Layouts</p></li>
				<li class="complete"><div class="theme-color layout-theme">
				<a href="#" data-theme="light"><span class="head"></span><span class="cont"></span></a>
				<a href="http://radixtouch.in/templates/admin/smart/source/dark/basic_table.html" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
				</div></li>	
				<li><p class="selector-title">Sidebar Color</p></li>
				<li class="complete"><div class="theme-color sidebar-theme">
				<a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
				</div></li>
             	<li><p class="selector-title">Header Brand color</p></li>
             	<li class="theme-option"><div class="theme-color logo-theme">
             	<a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
				<a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
             	</div></li>
             	<li><p class="selector-title">Header color</p></li>
             	<li class="theme-option"><div class="theme-color header-theme">
             	<a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
             	<a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
             	</div></li>
			</ul>
			</div>
		</div>
		<!-- end color quick setting -->
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
	@stack('scripts')
</body>

</html>
