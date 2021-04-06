
<div class="modal fade" id="passwordResetModal" role="dialog">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
        <div class="modal-body">
            <div class="tab-content">

            <div class="row justify-content-center">
                <div class ="row"> <i class="bi bi-person-circle icons"></i></div>
            </div>

            <div class="row justify-content-center">
                 <div class = "row"><h5 class="modal-title">Reset volunteer password</h5></div>
            </div>
                    <form action = "/Service/CMS/password-reset.php" id="password-reset-form" method = "POST">
                        <input type="hidden" name="form-name" value = "reset-password">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Volunteer email" name="email">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Reset password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
