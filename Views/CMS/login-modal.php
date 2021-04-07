
<!-- Login --->
<div class="modal fade" id="volunteer-login" role="dialog">
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
                    <form action = "/Service/CMS/login-registration.php" id = "login" method = "POST">
                        <input type="hidden" name="form-name" value = "login">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Volunteer email" name="email">
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
