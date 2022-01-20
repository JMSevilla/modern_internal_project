<?php

include_once "../Controllers/LoginController.php";

if(isset($_POST['triggerLogin']) == true) {
    $data = [
        "email" => $_POST['email'],
        "password" => $_POST['password']
    ];
    $log = new LoginController();
    $log->Login($data);
}