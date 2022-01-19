<?php

include_once "../Controllers/LoginController.php";

if(isset($_POST['triggerLogin']) == true) {
    $data = [
        "username" => $_POST['username'],
        "password" => $_POST['password']
    ];
    $log = new LoginController();
    $log->Login($data);
}