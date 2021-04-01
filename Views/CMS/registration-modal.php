<!-- Login / Register Modal-->
<div class="modal fade" id="registration-modal" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">
                    <div class="row justify-content-center">
                        <div class ="row"> <i class="bi bi-person-circle icons"></i></div>
                    </div>

                    <div class="row justify-content-center">
                        <div class = "row"><h5 class="modal-title">Create Volunteer Account</h5></div>
                    </div>
                     <form action="/Service/CMS/admin.php" id ="registration-form" method = "POST">
                            <input type="hidden" name="form-name" value = "registration">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                                <span id="response"></span>
                            </div>

                            <div class="form-group">
                                <label for="confirm_email">Confirm Email:</label>
                                <input type="text" class="form-control" id="confirm_email" placeholder="Confirm email" name="confirm_email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            </div>
 
                            <div class="form-group">
                                <label for="employee-type">Employee Type:</label>
                                <select name="employee-type" id="employee-type">
                                    <option value="regular">Regular</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Create account</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
