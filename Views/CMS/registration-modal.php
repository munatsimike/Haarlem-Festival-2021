<!-- Login / Register Modal-->
<div class="modal fade" id="registration-modal" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">
                    <div class="row justify-content-center">
                        <div class ="row"></i></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class = "row"><h5 class="modal-title">Create Volunteer Account</h5></div>
                    </div>
                     <form action="/Service/CMS/login-registration.php" id ="registration-form" method = "POST">
                            <input type="hidden" name="form-name" value = "registration">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                <span id="response"></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password">
                            </div>
 
                            
                            <div class="mb-2">
                                 <button id = "submitbtn" type="submit" class="btn btn-primary btn-block">Create account</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
