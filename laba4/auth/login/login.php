<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once('../../bootstrap/style.php'); ?>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row col-md-4 offset-md-4">
            <div class="modal" id="login_modal" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form" id="login_form">
                            <div class="modal-header d-flex flex-row justify-content-between">
                                <div class="modal-title fs-2">Login</div>
                                <a class="text-decoration-none" href="http://localhost:63342/laba4/auth/register/register.php">Register</a>
                            </div>
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="username_login">Username</label>
                                    <input type="text" id="username_login" name="username_login" class="form-control" />
                                    <span class="text text-danger" id="err_username_login"></span>
                                </div>
                                <div class="my-2">
                                    <label for="password_login">Password</label>
                                    <input type="password" id="password_login" name="password_login" class="form-control" />
                                    <span class="text text-danger" id="err_password_login"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../../bootstrap/script.php'); ?>
<script src="login.js" defer></script>
</body>
</html>








