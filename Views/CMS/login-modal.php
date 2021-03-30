
<!-- Login / Register Modal-->
<div class="modal fade" id="login-registration" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">

            <div class="row justify-content-center">
                <div class ="row"> <i class="bi bi-person-circle icons"></i></div>
            </div>

            <div class="row justify-content-center">
                 <div class = "row"><h5 class="modal-title">Volunteer Login</h5></div>
            </div>
                    <form action = "/Service/CMS/Login-Registration.php" method = "POST">
                        <input type="hidden" name="form-name" value = "login">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Volunteer username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Volunteer password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
