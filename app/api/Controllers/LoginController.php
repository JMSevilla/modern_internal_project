<?php

include_once "../../config/db.php";
include_once "../../config/queries.php";

interface LoginInterface {
    public function Login($data);
}
class LoginController extends Database implements LoginInterface{
    public function Login($data) {
        $loginQueries = new Queries();
        $server = new Server();
        if($server->checkServer()){
            Database::php_prepare($loginQueries->selectionQuery("users", "loginQuery"));
            Database::php_dynamics(":uname", $data['username']);
            if(Database::php_exec()){
                if(Database::php_row()){
                    $get = Database::php_fetch_row();
                    LoginParams::$password = $get['password'];
                    LoginParams::$istype = $get['istype'];
                    LoginParams::$status = $get['status'];
                    if(
                        Database::php_password_verify($data['password'],
                     LoginParams::$password)
                     ){
                        if(LoginParams::$status == '1'){
                            if(LoginParams::$istype == '1'){
                                echo Database::php_responses(
                                    true,
                                    "single",
                                    array("test" => 200)
                                );
                            }
                        }else{
                            echo Database::php_responses(
                                true,
                                "single",
                                array("DEACTIVATE" => 303)
                            );
                        }
                    }
                }else{
                    echo Database::php_responses(
                        true,
                        "single",
                        array("NOT_FOUND" => 404)
                    );
                }
            }else{
                echo Database::php_responses(
                    true,
                    "single",
                    array("INVALID_EXECUTION" => 405)
                );
            }
        }
    }
}