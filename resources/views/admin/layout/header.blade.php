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
            @if (Route::currentRouteName() == "sheet.list")
                <table class="mt-4 balance">
                    <tr>
                        {{-- <th class="py-1 px-2">Total: <span>100</span></th>
                        <th class="py-1 px-2">Pending: <span>100</span></th>
                        <th class="py-1 px-2">Waiting: <span>100</span></th>
                        <th class="py-1 px-2">Approved: <span>100</span></th> --}}
                        <input type="hidden" id="in-amount" value="0">
                        <input type="hidden" id="out-amount" value="0">
                        <th class="py-1 px-2">Balance: <span>0</span></th>
                    </tr>
                </table>
            @endif
        </ul>

        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
       <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                @if (Route::currentRouteName() == "sheet.list")
                    <li class="mt-3">
                        <div id="reportrange"  class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                    </li>
                    @livewire('select-category')
                    <li class="mt-1">
                        <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="Click here for full screen view" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a>
                    </li>
                    <li class="mt-1">
                        <a data-toggle="tooltip" data-placement="bottom" title="Refresh Sheet Data" class="fa fa-repeat btn-color spreadsheet-refresh" href="javascript:;"></a>
                    </li>
                    <li style="margin-top:0px;margin-left:17px;">
                        <a href="javascript:void(0)" >
                            <form action="{{ route('sheet.upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label data-toggle="tooltip" data-placement="bottom" title="Use this button to export sheet as excel" class="p-0" for="excelUpload">
                                    <i class="fa fa-upload"></i>
                                </label>
                                <input type="file" name="excelUpload" id="excelUpload" style="display:none">
                            </form>
                        </a>
                    </li> 
                    <li style="margin-top:21px;margin-left:17px;">
                        <a data-toggle="tooltip" data-placement="bottom" title="Use this button to export sheet as excel" href="javascript:;" id="excelExport" class="p-0">
                            <i class="fa fa-download"></i>
                        </a>
                    </li> 
                @endif
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile">
                            {{ Auth::user()->first_name." ".Auth::user()->last_name }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" id="headid">
                        <li id="userpassword">
                            <i class="icon-password"></i> Change Password </a>
                        </li>
                        <li>
                            <a href="{{route('auth.logout')}}">
                                <i class="icon-logout"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end manage user dropdown -->
            </ul>
        </div>
    </div>
</div>