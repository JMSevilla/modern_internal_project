<?php

include_once "../Controllers/RegisterController.php";

if(isset($_POST['trigger']) == 1) {
    $data = [
        "fname" => $_POST['firstname'],
        "lname" => $_POST['lastname'],
        "status" => $_POST['istypeswitch'],
        "email" => $_POST['email'],
        "address" => $_POST['address'],
        "roles" => $_POST['roles'],
        "occupation" => $_POST['occupation'],
        "password" => $_POST['password'] 
    ];
    $reg = new RegisterController();
    $reg->registerPost($data);
}