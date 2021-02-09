<div class="page-footer">
    <div class="page-footer-inner">
        2021 &copy; HnH Techsolutions 
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<!-- Change Password-->
<div id="Changepass" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form  id="passwordform" method="post">
          <div class="modal-body">
              <p id="passdone" class="text-success"></p>
              <p id="passerror" class="text-danger"> </p>
              <input type="hidden" id="userid" value="{{ Auth::user()->id }}">
              <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Password:</label>
                  <input type="password" class="form-control password" id="password" name="password" required>
              </div>
              <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Confirm Password:</label>
                  <input type="password" class="form-control" id="conpassword" name="conpassword" required>
              </div>
          </div>
          <div class="modal-footer">
              <button id="userpass" type="submit" class="btn btn-default" >Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
  
    </div>
  </div>
