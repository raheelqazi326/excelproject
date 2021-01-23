<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/popper/popper.js')}}" ></script>
<script src="{{ asset('assets/plugins/jquery-blockui/jquery.blockui.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" ></script>
<script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" ></script>
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

$(document).submit("#passwordform",function() {
  alert('submit'); 
  $userid = $('#userid').val();
  $password = $('#password').val();
  $conpassword = $('#conpassword').val();

  
});
</script>
