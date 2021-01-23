<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
	@include('admin.layout.head')
	@stack('styles')
    <style type="text/css">
        html {
  --scrollbarBG: #cff3cf47;
  --thumbBG: #a8d4a8;
}
body::-webkit-scrollbar {
  width: 16px;
}
body {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
body::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
body::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}
/*Table Scrollbar*/
.table-responsive::-webkit-scrollbar {
  width: 11px;
}
.table-responsive {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
.table-responsive::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
.table-responsive::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}
        body{
            font-size: 13px !important;
        }
        .page-header.navbar {
            box-shadow: 12px 3px 22px 21px green;
        }
        .nav-li{
            margin-top: 19px;
        }
        .page-content {
            margin-top: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .page-footer .page-footer-inner {
            color: #ffffff;
        }
        .page-footer {
            padding: 3px 5px;
            font-size: 13px;
            background-color: #3e673b;
        }
        .page-content-wrapper .page-content {
            margin-left: 0px;
            margin-top: 0;
            min-height: 556px;
            padding: 0px 15px 0px;
        }
        .dataTables_wrapper {
            margin-top: 0px;
        }
        .page-header-fixed .page-container {
            margin-top: 7px;
        }
        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-bottom: 0px;
        }
        .page-header.navbar .page-logo {
            float: left;
            display: block;
            width: 235px;
            height: 60px;
            padding: 1px 36px 0px 29px;
            background: transparent !important;
        }

        /*Preloader*/
        body {
            overflow: hidden;
        }

        .preloader {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 99999999;
        }

        #preloader-logo {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .loading-msg {
            width: 100%;
            font-size: 0.75em;
            color: #555;
            position: absolute;
            bottom: 10%;
            left: 50%;
            transform: translate(-50%, 50%);
            text-align: center;
        }

        .spinner {
            width: 80px;
            height: 40px;
            border: 2px solid green;
            border-top: 5px solid green;
            border-radius: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            animation: spin 1s infinite ease;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        #loading-msg {
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 25px;
            text-align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 0.8em;
        }

        body {
            overflow: hidden;
        }
    </style>
</head>

<!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
     <div class="preloader">
        <div class="spinner"></div>
        <span id="loading-msg"></span>
    </div>
    <div class="page-wrapper">
        <!-- start header -->
		@include('admin.layout.header')
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 			
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
    <!-- end js include path -->
    @yield('script')
    <script>
        $(function(e){
            setInterval(function(){
                $(".preloader").hide();
            },5000);
            $("body").css("overflow", "scroll");
            $("body").css("overflow-x", "hidden");
            
            console.log("Hello World")
          });
    </script>
</body>

</html>
