@extends('admin.layout.master')

@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
           
        <div class="row">
            <div class="col-md-12 text-right mt-2">
                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">
                    Add User
                </button> 
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-topline-green">
                            <div class="card-head">
                                <header>USERS TABLE</header>
                                <div class="tools">
                                    {{-- <a class="fa fa btn-color fa fa-times" href="javascript:;"></a> --}}
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
        <form id="userAdd">
            <div class="modal-body">
            
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>

                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>

                <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Username:</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
                <p class="text-danger" id="error-user_name"></p>

                </div>

                <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Eamil:</label>
                <input type="text" class="form-control" id="email" name="email" required>
                <p class="text-danger" id="error-email"></p>
                </div>

                <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
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
                <input type="text" class="form-control" id="firstname" name="firstname" value="" required>
            </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Username:</label>
                <input type="text" class="form-control" value="" id="username" name="username" required>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Eamil:</label>
                <input type="text" class="form-control" id="uemail" value="" name="uemail" required>
              </div>

              <div class="form-group">
                <label for="recipient-name" class="col-form-label"> Password:</label>
                <input type="password" class="form-control" id="upassword" value="" name="upassword">
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
                url:'{{route("users.list")}}',
                
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
                        div +='<td><select class="form-control userstatus" >';
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
                let username = $('#user_name').val();
               $.ajax({
                      headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{ route("email.avail") }}',
                    type: 'post',
                    data: {
                    email:email,
                    username:username
                    },
                    success:function(data){
                        console.log(data);
                        if(data == "emailexist"){
                            $('#error-email').text('This email already register please enter another email')
                            $('#error-user_name').text('')
                        }
                        if(data == "emailuserexist"){
                            $('#error-user_name').text('This email already register please enter another email')
                            $('#error-email').text('This email already register please enter another email')
                        }
                        if(data == "userexist"){
                            $('#error-email').text('');                                        
                            $('#error-user_name').text('This email already register please enter another email')
                        }

                        
                        if(data == "notexist"){
                            let data = $('#userAdd').serialize();
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url:'{{ route("user.store") }}',
                                data: data,
                                type: 'POST',
                                success:function(data){
                                    if(data ==1){
                                        Swal.fire(
                                            'User Added!',
                                            'You clicked the button!',
                                            'success'
                                        )
                                        $('#exampleModal').modal('hide');
                                        $('#error-email').text('');
                                        $('#error-user_name').text('')                                        
                                        $("#userAdd").get(0).reset()

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
                                                    div +='<td><select class="form-control userstatus" >';
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
                        }
                    }
               })


        });

        $(document).on('click','#editUser',function(){
            let id = $(this).data('id');
            $.ajax({
                    url:'{{ url("/user/show/") }}/'+id,
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
                                    let tableBody = $('#user-table');
                                    tableBody.html();
                                    $.each( data, function( key, value ) {
                                        is_active = (value.status=='active');
                                        let tr = $("<tr/>");
                                        let td = $("<td/>");
                                        td.clone().text(value.id).appendTo(tr);
                                        td.clone().text(value.first_name).appendTo(tr);
                                        td.clone().text(value.last_name).appendTo(tr);
                                        td.clone().text(value.username).appendTo(tr);
                                        td.clone().text(value.email).appendTo(tr);
                                        td.clone().html(
                                            $("<select></select>").attr("class", "form-control new-status-select").html(
                                                '<option data-id="'+value.id+'" value="active" '+(is_active?"selected":"")+'>Active</option>\
                                                <option data-id="'+value.id+'" value="inactive"'+(is_active?"":"selected")+'>Inactive</option>'
                                            )
                                        ).appendTo(tr);
                                        td.clone().html(
                                            '<button id="editUser" data-id="'+value.id+'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>\
                                            <button id="delteUser" data-id="'+value.id+'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>'
                                        ).appendTo(tr);
                                        tr.appendTo(tableBody);
                                    });
                                    $(".new-status-select").addClass("userstatus").removeClass("new-status-select");
                                    // $('#user-table').html(div);
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
                                            div +='<td><select class="form-control userstatus" >';
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


        $(document).on('change','.userstatus',function(){
            console.log('change');
            var status = $(this).find(":selected").val();
            var userid = $(this).find(":selected").data("id");
            console.log(status);
            console.log(userid)
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
                        if(data =='updated'){
                            Swal.fire(
                                'Status Change!',
                                'Your status has been change.',
                                'success'
                                )
                                $.ajax({
                                type: 'GET',
                                url:'{{route("users.list")}}',
                                
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
                                        div +='<td><select class="form-control userstatus" >';
                                        div +='<option data-id="'+value.id+'" value="active" '+(is_active?"selected":"")+'>Active</option>';
                                        div +='<option data-id="'+value.id+'"    value="inactive"'+(is_active?"":"selected")+'>Inactive</option>';
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