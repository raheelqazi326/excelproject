<div class="page-header navbar">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <!-- <h2>Spread Sheet</h2> -->
            <img style="margin-top: -5px;width: 50%;height: 67px;" src="{{asset('assets/img/logo.png')}}" class="img-responsive" height="200" width="100">
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <!-- <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
             -->
             <!--  <li>
                <a href="{{route('sheet.list')}}"> 
                  <i class="fa fa-file-excel-o"></i>
                    <span class="title">Spread Sheet</span>
                </a>
              </li>
               <li >
                   <a href="{{route('user.list')}}"> 
                    <i class="fa fa-users"></i>
                       <span class="title">Users</span>
                   </a>
               </li>

               <li >
                <a href="{{route('auth.logout')}}"> 
                  <i class="fa fa-sign-out"></i>
                    <span class="title">Log Out</span></span>
                </a>
            </li> -->
        </ul>

        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
       <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="mt-1"><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                <li class="mt-1">
                    <a class="fa fa-repeat btn-color spreadsheet-refresh" href="javascript:;"></a>
                </li>
                
                @if (auth()->user()->role_id == 2)
                <li style="margin-top:17px;margin-left:7px;">
                    <a href="javascript:;" class="excel-import">
                        <i class="excel-import fa fa-upload"></i>
                    </a>
                    <input type="file" id="excel_import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none">
                </li>
                @endif
                @if (auth()->user()->role_id == 1)
                <li style="margin-top:17px;margin-left:7px;">
                    <a href="{{ route('sheet.move') }}">
                        <i class="fa fa-paper-plane"></i>
                    </a>
                </li>
                @endif
                  <li class="nav-li">
                <a href="{{route('sheet.list')}}"> 
                  <i class="fa fa-file-excel-o"></i>
                    <span class="title">Spread Sheet</span>
                </a>
              </li>
              @if(Auth::user()["role_id"] ==1)
               <li  class="nav-li">
                   <a href="{{route('user.list')}}"> 
                    <i class="fa fa-users"></i>
                       <span class="title">Users</span>
                   </a>
               </li>
               <li  class="nav-li">
                <a href="{{route('user.history')}}"> 
                 <i class="fa fa-users"></i>
                    <span class="title">History</span>
                </a>
            </li>
               @endif
                 <!-- start manage user dropdown -->
                 <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile">
                            {{ Auth::user()->role_id == 1? Auth::user()->last_name:Auth::user()->first_name }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" id="headid">
                        <li id="userpassword">
                            <i class="icon-password"></i> Change Password </a>
                        </li>
                        <li>
                            <a href="{{route('auth.logout')}}">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- end manage user dropdown -->
              </ul>
        </div>
    </div>
</div>