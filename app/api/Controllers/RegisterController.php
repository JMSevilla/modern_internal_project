
<?php

include_once "../../config/db.php";
include_once "../../config/queries.php";

interface RegisterInterface {
    public function registerPost($data);
}

class RegisterController extends Database implements RegisterInterface {
    public function registerPost($data) {
        if(Server::checkServer()){
           Database::php_prepare(Queries::selectionQuery("users", "loginQuery"));
           Database::php_dynamics(":email", $data['email']);
           if(Database::php_exec()){
            if(Database::php_row()){
                echo Database::php_responses(true, "single", array("exist_email" => 505));
            }else{
                $get = Database::php_fetch_row();
                RegisterParams::$istype = $get['istype'];
                if(RegisterParams::$istype == "1"){
                    //non admin
                    Database::php_prepare(Queries::RegisterQuery("users", "user"));
                    Database::php_dynamics(":email", $data['email']);
                    Database::php_dynamics(":password", $this->php_password_encryptor($data['password']));
                    Database::php_dynamics(":fname", $data['fname']);
                    Database::php_dynamics(":lname", $data['lname']);
                    Database::php_dynamics(":roles", $data['roles']);
                    Database::php_dynamics(":occupation", $data['occupation']);
                    Database::php_dynamics(":address", $data['address']);
                    if(Database::php_exec()){
                        //success
                        echo Database::php_responses(
                            true, "single", array("success user" => 200)
                        );
                    }
                }else{
                    //admin
                    Database::php_prepare(Queries::RegisterQueryAdmin("users", "admin"));
                    Database::php_dynamics(":email", $data['email']);
                    Database::php_dynamics(":password", $this->php_password_encryptor($data['password']));
                    Database::php_dynamics(":fname", $data['fname']);
                    Database::php_dynamics(":lname", $data['lname']);
                    Database::php_dynamics(":roles", $data['roles']);
                    Database::php_dynamics(":occupation", $data['occupation']);
                    Database::php_dynamics(":address", $data['address']);
                    if(Database::php_exec()){
                        //success
                        echo Database::php_responses(
                            true, "single", array("success admin" => 200)
                        );
                    }
                }
            }
           }else{
              echo Database::php_responses(
                  true, "single", array("invalid_execution" => 404)
              );
           }
        }
    }
}