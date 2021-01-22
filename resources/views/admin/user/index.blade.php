@extends('admin.layout.master')

@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add User
        </button>    
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-purple">
                            <div class="card-head">
                                <header>STRIPED TABLE</header>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                </div>
                            </div>
                            <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-table">
                                        
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->
<!-- start chat sidebar -->
<div class="chat-sidebar-container" data-close-on-body-click="false">
    <div class="chat-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"  data-toggle="tab"> <i class="material-icons">chat</i>Chat
                        <span class="badge badge-danger">4</span>
                    </a>
            </li>
            <li class="nav-item">
                <a href="#quick_sidebar_tab_3" class="nav-link tab-icon"  data-toggle="tab"> <i class="material-icons">settings</i> Settings
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Start User Chat --> 
             <div class="tab-pane active chat-sidebar-chat in active show" role="tabpanel" id="quick_sidebar_tab_1">
                <div class="chat-sidebar-list">
                    <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd" data-wrapper-class="chat-sidebar-list">
                        <div class="chat-header"><h5 class="list-heading">Online</h5></div>
                        <ul class="media-list list-items">
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof3.jpg" width="35" height="35" alt="...">
                                <i class="online dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">John Deo</h5>
                                    <div class="media-heading-sub">Spine Surgeon</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-status">
                                    <span class="badge badge-success">5</span>
                                </div> <img class="media-object" src="../assets/img/prof/prof1.jpg" width="35" height="35" alt="...">
                                <i class="busy dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Rajesh</h5>
                                    <div class="media-heading-sub">Director</div>
                                </div>
                            </li>
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof5.jpg" width="35" height="35" alt="...">
                                <i class="away dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Jacob Ryan</h5>
                                    <div class="media-heading-sub">Ortho Surgeon</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-status">
                                    <span class="badge badge-danger">8</span>
                                </div> <img class="media-object" src="../assets/img/prof/prof4.jpg" width="35" height="35" alt="...">
                                <i class="online dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Kehn Anderson</h5>
                                    <div class="media-heading-sub">CEO</div>
                                </div>
                            </li>
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof2.jpg" width="35" height="35" alt="...">
                                <i class="busy dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Sarah Smith</h5>
                                    <div class="media-heading-sub">Anaesthetics</div>
                                </div>
                            </li>
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof7.jpg" width="35" height="35" alt="...">
                                <i class="online dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Vlad Cardella</h5>
                                    <div class="media-heading-sub">Cardiologist</div>
                                </div>
                            </li>
                        </ul>
                        <div class="chat-header"><h5 class="list-heading">Offline</h5></div>
                        <ul class="media-list list-items">
                            <li class="media">
                                <div class="media-status">
                                    <span class="badge badge-warning">4</span>
                                </div> <img class="media-object" src="../assets/img/prof/prof6.jpg" width="35" height="35" alt="...">
                                <i class="offline dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Jennifer Maklen</h5>
                                    <div class="media-heading-sub">Nurse</div>
                                    <div class="media-heading-small">Last seen 01:20 AM</div>
                                </div>
                            </li>
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof8.jpg" width="35" height="35" alt="...">
                                <i class="offline dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Lina Smith</h5>
                                    <div class="media-heading-sub">Ortho Surgeon</div>
                                    <div class="media-heading-small">Last seen 11:14 PM</div>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-status">
                                    <span class="badge badge-success">9</span>
                                </div> <img class="media-object" src="../assets/img/prof/prof9.jpg" width="35" height="35" alt="...">
                                <i class="offline dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Jeff Adam</h5>
                                    <div class="media-heading-sub">Compounder</div>
                                    <div class="media-heading-small">Last seen 3:31 PM</div>
                                </div>
                            </li>
                            <li class="media"><img class="media-object" src="../assets/img/prof/prof10.jpg" width="35" height="35" alt="...">
                                <i class="offline dot"></i>
                                <div class="media-body">
                                    <h5 class="media-heading">Anjelina Cardella</h5>
                                    <div class="media-heading-sub">Physiotherapist</div>
                                    <div class="media-heading-small">Last seen 7:45 PM</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="chat-sidebar-item">
                    <div class="chat-sidebar-chat-user">
                        <div class="page-quick-sidemenu">
                            <a href="javascript:;" class="chat-sidebar-back-to-list">
                                <i class="fa fa-angle-double-left"></i>Back
                            </a>
                        </div>
                        <div class="chat-sidebar-chat-user-messages">
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:10</span>
                                    <span class="body-out"> could you send me menu icons ? </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:10</span>
                                    <span class="body"> please give me 10 minutes. </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:11</span>
                                    <span class="body-out"> ok fine :) </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:22</span>
                                    <span class="body">Sorry for
                                        the delay. i sent mail to you. let me know if it is ok or not.</span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                    <span class="body-out"> it is perfect! :) </span>
                                </div>
                            </div>
                            <div class="post out">
                                <img class="avatar" alt="" src="../assets/img/dp.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                    <span class="body-out"> Great! Thanks. </span>
                                </div>
                            </div>
                            <div class="post in">
                                <img class="avatar" alt="" src="../assets/img/prof/prof5.jpg" />
                                <div class="message">
                                    <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:27</span>
                                    <span class="body"> it is my pleasure :) </span>
                                </div>
                            </div>
                        </div>
                        <div class="chat-sidebar-chat-user-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message here...">
                                <div class="input-group-btn">
                                    <button type="button" class="btn deepPink-bgcolor">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End User Chat --> 
             <!-- Start Setting Panel --> 
             <div class="tab-pane chat-sidebar-settings" role="tabpanel" id="quick_sidebar_tab_3">
                <div class="chat-sidebar-settings-list slimscroll-style">
                    <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
                    <div class="chatpane inner-content ">
                        <div class="settings-list">
                            <div class="setting-item">
                                <div class="setting-text">Sidebar Position</div>
                                <div class="setting-set">
                                   <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                        <option value="left" selected="selected">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Header</div>
                                <div class="setting-set">
                                   <select class="page-header-option form-control input-inline input-sm input-small ">
                                        <option value="fixed" selected="selected">Fixed</option>
                                        <option value="default">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Sidebar Menu </div>
                                <div class="setting-set">
                                   <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                        <option value="accordion" selected="selected">Accordion</option>
                                        <option value="hover">Hover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Footer</div>
                                <div class="setting-set">
                                   <select class="page-footer-option form-control input-inline input-sm input-small ">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
                        <div class="settings-list">
                            <div class="setting-item">
                                <div class="setting-text">Notifications</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-1">
                                          <input type = "checkbox" id = "switch-1" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Show Online</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-7">
                                          <input type = "checkbox" id = "switch-7" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Status</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-2">
                                          <input type = "checkbox" id = "switch-2" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">2 Steps Verification</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-3">
                                          <input type = "checkbox" id = "switch-3" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                        <div class="settings-list">
                            <div class="setting-item">
                                <div class="setting-text">Location</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-4">
                                          <input type = "checkbox" id = "switch-4" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Save Histry</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-5">
                                          <input type = "checkbox" id = "switch-5" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-item">
                                <div class="setting-text">Auto Updates</div>
                                <div class="setting-set">
                                    <div class="switch">
                                        <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect" 
                                          for = "switch-6">
                                          <input type = "checkbox" id = "switch-6" 
                                             class = "mdl-switch__input" checked>
                                           </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- CREATE USER MODAL--}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="userAdd">
           
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Username:</label>
                <input type="text" class="form-control" id="user_name" name="user_name">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Eamil:</label>
                <input type="text" class="form-control" id="email" name="email">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Password:</label>
                <input type="text" class="form-control" id="password" name="password">
              </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>



  {{-- EDIT USER MODAL--}}

<div class="modal fade" id="editUsermodal" tabindex="-1" role="dialog" aria-labelledby="editUsermodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUsermodalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editAdd">
           <input type="hidden" class="user_id" id="user_id" value="">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="">
            </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Username:</label>
                <input type="text" class="form-control" value="" id="username" name="username">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Eamil:</label>
                <input type="text" class="form-control" id="uemail" value="" name="uemail">
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Password:</label>
                <input type="text" class="form-control" id="upassword" value="" name="upassword">
              </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')

<script>
    $(document).ready(function(){

        $.ajax({
                type: 'GET',
                url:'/users/list',
                
                success:function(data){
                    let div;
                    $.each( data, function( key, value ) {
                        is_active = (value.status=='active');
                        div +='<tr>';
                        div +='<td>'+value.id+'</td>';
                        div +='<td>'+value.first_name+'</td>';
                        div +='<td>'+value.last_name+'</td>';
                        div +='<td>'+value.username+'</td>';
                        div +='<td>'+value.email+'</td>';
                        div +='<td><select class="form-control" id="userstatus">';
                        div +='<option data-id="'+value.id+'" value="active" '+(is_active?"selected":"")+'>Active</option>';
                        div +='<option data-id="'+value.id+'" value="inactive"'+(is_active?"":"selected")+'>Inactive</option>';
                        div +='</select></td>';
                        div += '<td>';
                        div +='<button id="editUser" data-id="'+value.id+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
                        div +='<button id="delteUser" data-id="'+value.id+'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                        div += '</td>';
                        div +='</tr>';

                        });
                    $('#user-table').html(div);
                }
            });


        $('#userAdd').on('submit',function(){
            event.preventDefault();
               let email = $('#email').val();
               $.ajax({
                     url:'/email/avail/'+email,
                    type: 'get',
                    success:function(data){
                        console.log(data)
                    }
               })
        });

        $(document).on('click','#editUser',function(){
            let id = $(this).data('id');
            $.ajax({
                    url:'/user/show/'+id,
                    type: 'get',
                    success:function(data){
                        $('#user_id').val(data.id);
                        $('#firstname').val(data.first_name);
                        $('#lastname').val(data.last_name);
                        $('#username').val(data.username);
                        $('#uemail').val(data.email);
                        $('#editUsermodal').modal('show');
                    }
                });



        });


        $('#editAdd').on('submit',function(){
            event.preventDefault();
               
               let userid = $('#user_id').val();
               let first_name = $('#firstname').val();
               let last_name = $('#lastname').val();
               let user_name = $('#username').val();
               let email = $('#uemail').val();    
               let password = $('#upassword').val();   
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url:'/user/update',
                    data: {
                        userid:userid,
                        first_name:first_name,
                        last_name:last_name,
                        user_name:user_name,
                        email:email,
                        password:password
                    },
                    success:function(data){
                        if(data ==1){
                            $('#editUsermodal').modal('hide');
                            Swal.fire(
                                'User Upadate!',
                                'You clicked the button!',
                                'success'
                                )
                                $.ajax({
                                type: 'GET',
                                url:'/users/list',
                                
                                success:function(data){
                                    let div;
                                    $.each( data, function( key, value ) {
                                        is_active = (value.status=='active');
                                        div +='<tr>';
                                        div +='<td>'+value.id+'</td>';
                                        div +='<td>'+value.first_name+'</td>';
                                        div +='<td>'+value.last_name+'</td>';
                                        div +='<td>'+value.username+'</td>';
                                        div +='<td>'+value.email+'</td>';
                                        div +='<td><select class="form-control" id="userstatus">';
                                        div +='<option data-id="'+value.id+'" value="active" '+(is_active?"selected":"")+'>Active</option>';
                                        div +='<option data-id="'+value.id+'" value="inactive"'+(is_active?"":"selected")+'>Inactive</option>';
                                        div +='</select></td>';
                                        div += '<td>';
                                        div +='<button id="editUser" data-id="'+value.id+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
                                        div +='<button id="delteUser" data-id="'+value.id+'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                                        div += '</td>';
                                        div +='</tr>';
                                        });
                                    $('#user-table').html(div);
                                }
                            });
                        }
                    }
                });
        });

        $(document).on('click','#delteUser',function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                        $.ajax({
                        url:'/user/delete/'+id,
                        type: 'get',
                        success:function(data){
                            if(data ==1){
                                $.ajax({
                                    type: 'GET',
                                    url:'/users/list',
                                    
                                    success:function(data){
                                        let div;
                                        $.each( data, function( key, value ) {
                                            is_active = (value.status=='active');
                                            div +='<tr>';
                                            div +='<td>'+value.id+'</td>';
                                            div +='<td>'+value.first_name+'</td>';
                                            div +='<td>'+value.last_name+'</td>';
                                            div +='<td>'+value.username+'</td>';
                                            div +='<td>'+value.email+'</td>';
                                            div +='<td><select class="form-control" id="userstatus">';
                                            div +='<option data-id="'+value.id+'" value="active" '+(is_active?"selected":"")+'>Active</option>';
                                            div +='<option data-id="'+value.id+'" value="inactive"'+(is_active?"":"selected")+'>Inactive</option>';
                                            div +='</select></td>';
                                            div += '<td>';
                                            div +='<button id="editUser" data-id="'+value.id+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
                                            div +='<button id="delteUser" data-id="'+value.id+'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                                            div += '</td>';
                                            div +='</tr>';
                                            });
                                        $('#user-table').html(div);
                                    }
                                });
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                             }
                            }
                        });
                    
                }
                })
            
        });


        $(document).on('change','#userstatus',function(){
            var status = $(this).find(":selected").val();
            var userid = $(this).find(":selected").data("id");
            
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url:'/user/status',
                    data: {
                        userid:userid,
                        status:status
                    },
                    success:function(data){
                        if(data ==1){
                            Swal.fire(
                                'Status Change!',
                                'Your status has been change.',
                                'success'
                                )
                                $.ajax({
                                type: 'GET',
                                url:'/users/list',
                                
                                success:function(data){
                                    let div;
                                    $.each( data, function( key, value ) {
                                        is_active = (value.status=='active');
                                        div +='<tr>';
                                        div +='<td>'+value.id+'</td>';
                                        div +='<td>'+value.first_name+'</td>';
                                        div +='<td>'+value.last_name+'</td>';
                                        div +='<td>'+value.username+'</td>';
                                        div +='<td>'+value.email+'</td>';
                                        div +='<td><select class="form-control" id="userstatus">';
                                        div +='<option value="active" '+(is_active?"selected":"")+'>Active</option>';
                                        div +='<option value="inactive"'+(is_active?"":"selected")+'>Inactive</option>';
                                        div +='</select></td>';
                                        div += '<td>';
                                        div +='<button id="editUser" data-id="'+value.id+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>';
                                        div +='<button id="delteUser" data-id="'+value.id+'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>';
                                        div += '</td>';
                                        div +='</tr>';
                                        });
                                    $('#user-table').html(div);
                                }
                            });
                        }
                    }
                });

        });

       

    });
</script>


@endsection