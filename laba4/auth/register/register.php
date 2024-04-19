<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once('../../bootstrap/style.php') ?>
    <title>Register</title>
</head>
<body>

    <div class="container">
        <div class="row col-md-4 offset-md-4">
            <div id="register_modal" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="register_form" class="form">
                            <div class="modal-header d-flex flex-row justify-content-between">
                                <div class="modal-title fs-3 bold">Register</div>
                                <a href="http://localhost:63342/laba4/auth/login/login.php" class="text-decoration-none">Login</a>
                            </div>
                            <div class="modal-body">
                                <div class="my-2">
                                    <label for="register_username">Username</label>
                                    <input type="text" id="register_username" class="form-control" name="register_username" autofocus>
                                    <span id="err_reg_username" class="text text-danger"></span>
                                </div>
                                <div class="my-2">
                                    <label for="register_password">Password</label>
                                    <input type="password" id="register_password" class="form-control" name="register_password">
                                    <span id="err_password" class="text text-danger"></span>
                                </div>
                                <div class="my-2">
                                    <label for="register_re_password">Repeat Password</label>
                                    <input type="password" id="register_re_password" class="form-control" name="register_re_password">
                                    <span id="err_re_password" class="text text-danger"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php require_once('../../bootstrap/script.php') ?>
<script src="register.js" defer></script>
</body>
</html>