<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
       <div id="remove-scroll" class="left-sidemenu">
           <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
               <li class="sidebar-toggler-wrapper hide">
                   <div class="sidebar-toggler">
                       <span></span>
                   </div>
               </li>
               <li class="sidebar-user-panel">
                   <div class="user-panel">
                       
                       <div class="pull-left info">
                           <p> {{Auth::user()->first_name}} {{Auth::user()->last_name}} </p>

                           <!-- <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a> -->
                       </div>
                   </div>
               </li>
              <li class="nav-item">
                <a href="{{route('sheet.list')}}" class="nav-link nav-toggle"> 
                  <i class="fa fa-file-excel-o"></i>
                    <span class="title">Spread Sheet</span>
                </a>
              </li>
               <li class="nav-item">
                   <a href="{{route('user.list')}}" class="nav-link nav-toggle"> 
                    <i class="fa fa-users"></i>
                       <span class="title">Users</span>
                   </a>
               </li>

               <li class="nav-item">
                <a href="{{route('auth.logout')}}" class="nav-link nav-toggle"> 
                  <i class="fa fa-sign-out"></i>
                    <span class="title">Log Out</span></span>
                </a>
            </li>

           </ul>
       </div>
   </div>
</div>s