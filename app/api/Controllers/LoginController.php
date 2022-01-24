<?php

include_once "../../config/db.php";
include_once "../../config/queries.php";
include_once "Token/tokenization.php";

class Decision{
    public static $identifier;
    public static $OAuthTokenGetter;
}

interface LoginInterface {
    public function Login($data);
    public function tokenSetter($data);
    public function tokenGetter($data);
}
class LoginController extends Database implements LoginInterface{
    public function tokenSetter($data){
        $tokenQuery = new Queries();
        if(Database::php_prepare($tokenQuery->setTokenization("setToken"))){
            $tokenToBeHashed = Database::crypto_secure();
                                LoginParams::$token = $tokenToBeHashed;
                                Database::php_dynamics(":token", LoginParams::$token);
                                Database::php_dynamics(":email", $data['email']);
                                if(Database::php_exec()){
                                    return Decision::$identifier = true;
                                }
        }
                                
    }
    public function tokenGetter($data){
        if(Database::php_prepare(Queries::getTokenization("users", "getToken"))){
            Database::php_dynamics(":email", $data['email']);
            Database::php_exec();
            $getToken = Database::php_fetch_row();
            return Decision::$OAuthTokenGetter = $getToken['tokenization'];
        }
    }
    public function Login($data) {
        $loginQueries = new Queries();
        $oaktoken = new Tokenization();
        $server = new Server();
        if($server->checkServer()){
            Database::php_prepare($loginQueries->selectionQuery("users", "loginQuery"));
            Database::php_dynamics(":email", $data['email']);
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
                                $this->tokenSetter($data);
                                if(Decision::$identifier){
                                    $this->tokenGetter($data);
                                    $oaktoken->tokenConfiguration(
                                        "setter",
                                        Decision::$OAuthTokenGetter,
                                        "TA",
                                        true,
                                        true,
                                        time() + 60*60*24*7,
                                        '/'
                                    );
                                    echo Database::php_responses(
                                        true,
                                        "single",
                                        (object)[0 => array("key" => "ADMIN_SUCCESS")]
                                    );   
                                }
                            }
                        }else{
                            echo Database::php_responses(
                                true,
                                "single",
                                (object)[0 => array("key" => "DEACTIVATED")]
                            );
                        }
                    }else{
                      echo Database::php_responses(
                          true,
                          "single",
                          (object)[0 => array("key" => "INVALID_PASSWORD")]
                      );
                    }
                }else{
                    echo Database::php_responses(
                        true,
                        "single",
                        (object)[0 => array("key" => "NOTFOUND")]
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
