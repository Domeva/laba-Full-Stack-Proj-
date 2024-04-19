<?php
require_once('../../sqlMain.php');


header('Access-Control-Allow-Origin: http://localhost:63342/*');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json");

$sqlMain = new MainSql();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $request = file_get_contents('php://input');
    $request = json_decode($request, true);

    $username = htmlspecialchars($request['register_username']);
    $password = htmlspecialchars($request['register_password']);
    $re_password = htmlspecialchars($request['register_re_password']);

    $errors = [];

    if(empty($username)){
        $errors[] = ['code' => 1, 'message' => "You don't fill username field!"];
    }
    if($username !== '' && $sqlMain->checkUser($username)){
        $errors[] = ['code' => 2, 'message' => "User was exists!"];
    }
    if(empty($password)){
        $errors[] = ['code' => 3, 'message' => "You don't fill password field!"];
    }
    if(empty($re_password)){
        $errors[] = ['code' => 4, 'message' => "You don't fill re-enter password field!"];
    }
    if($password !== '' && $re_password !== ''
    && $password !== $re_password){
        $errors[] = ['code' => 5, 'message' => "Passwords must match!"];
    }

    if(!empty($errors)){
        echo json_encode(['status' => false, 'errors' => $errors]);
        die();
    }
    else{
        if($sqlMain->createUser($username, $password)){
            if($sqlMain->grant($username)){
                echo json_encode(['status' => true, 'url' => 'http://localhost:63342/laba4/auth/login/login.php']);
            }
        }
    }
}
