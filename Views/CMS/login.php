
<!-- Login / Register Modal-->
<div class="modal fade" id="login-registration" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">
                    <form action = "/Service/CMS/Login-Registration.php" method = "POST">
                        <input type="hidden" name="form-name" value = "login">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
