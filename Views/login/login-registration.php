
<!-- Login / Register Modal-->
<div class="modal fade" id="login-registration" role="dialog">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#login-form"> Login <span class="glyphicon glyphicon-user"></span></a></li>
                    <li><a data-toggle="tab" href="#registration-form"> Register <span class="glyphicon glyphicon-pencil"></span></a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="tab-content">

                    <div id="login-form" class="tab-pane fade in active">
                        <form action="/">
                            <input type="hidden" name="form-name" value = "login">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>

                    <div id="registration-form" class="tab-pane fade">
                        <form action = '/Service/Login-Registration/Login-Registration.php' id="registration" method = "POST">
                            <input type="hidden" name="form-name" value = "registration">
                            <div class="form-group">
                                <label for="name">Your Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="newemail">Email:</label>
                                <input type="email" class="form-control" id="newemail" placeholder="Enter new email" name="newemail">
                            </div>
                            <div class="form-group">
                                <label for="newpwd">Password:</label>
                                <input type="password" class="form-control" id="newpwd" placeholder="New password" name="newpwd">
                            </div>
                            <button type="submit" class="btn btn-default">Register</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
