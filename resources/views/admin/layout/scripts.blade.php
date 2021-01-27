<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/popper/popper.js')}}" ></script>
<script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" ></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<!-- Common js-->
<script src="{{ asset('assets/js/app.js')}}" ></script>
<script src="{{ asset('assets/js/layout.js')}}" ></script>
<script src="{{ asset('assets/js/theme-color.js')}}" ></script>
<!-- Material -->
<script src="{{ asset('assets/plugins/material/material.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
 
$("#headid li").click(function() {
    let check = $(this).attr('id'); 
    if (check == "userpassword") {
        $('#Changepass').modal('toggle');
    }
});

$("#conpassword").keyup(function() {
  const password = $('.password').val();
  const conpassword = $('#conpassword').val();
 
  if (password == conpassword) {
        $("#passdone").text("Password Match")
        $("#passerror").text("")
    }
    else{
        $("#passdone").text("")
        $("#passerror").text("Password dose not Match")
    }
});


$(document).on("submit","#passwordform",function() {
    event.preventDefault();

    let password = $('.password').val();
    let userid = $('#userid').val();

    $.ajax({ 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url:'/auth/change/password',
        data: {
            userid:userid,
            password:password,
        },success:function(data){
            console.log(data);
            if (data == 1) {
                $('#Changepass').modal('hide');
                Swal.fire(
                    'User Update Upadate!',
                    'You clicked the button!',
                    'success'
                    )
                    location.reload();
            }
        }

    });
  
});
</script>
