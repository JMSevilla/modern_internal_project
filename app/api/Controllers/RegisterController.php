
<?php

include_once "../../config/db.php";
include_once "../../config/queries.php";

interface RegisterInterface
{
    public function registerPost($data);
    public function Admin($data, $q);
    public function User($data, $q);
}

class RegisterController extends Database implements RegisterInterface
{
    public function registerPost($data)
    {
        $server = new Server();
        $q = new Queries();
        if ($server->checkServer()) {
            Database::php_prepare($q->selectionQuery("users", "loginQuery"));
            Database::php_dynamics(":email", $data['email']);
            if (Database::php_exec()) {
                if (Database::php_row()) {
                    echo Database::php_responses(true, "single", array("exist_email" => 505));
                } else {
                    Database::php_query($q->checkIsType("check_is_type"));
                    if (Database::php_exec()) {
                        if (Database::php_row()) {
                            $user = new RegisterController();
                            $user->User($data, $q);
                        } else {
                            $admin = new RegisterController();
                            $admin->Admin($data, $q);
                        }
                    }
                }
            } else {
                echo Database::php_responses(
                    true,
                    "single",
                    array("invalid_execution" => 404)
                );
            }
        }
    }
    public function Admin($data, $q)
    {
        //non admin
        Database::php_prepare($q->RegisterQueryAdmin("users", "admin"));
        Database::php_dynamics(":email", $data['email']);
        Database::php_dynamics(":password", $this->php_password_encryptor($data['password']));
        Database::php_dynamics(":fname", $data['fname']);
        Database::php_dynamics(":lname", $data['lname']);
        Database::php_dynamics(":roles", $data['roles']);
        Database::php_dynamics(":occupation", $data['occupation']);
        Database::php_dynamics(":address", $data['address']);
        if (Database::php_exec()) {
            //success
            echo Database::php_responses(
                true,
                "single",
                array("success_admin" => 200)
            );
        }
    }
    public function User($data, $q)
    {
        Database::php_prepare($q->RegisterQuery("users", "user"));
        Database::php_dynamics(":email", $data['email']);
        Database::php_dynamics(":password", $this->php_password_encryptor($data['password']));
        Database::php_dynamics(":fname", $data['fname']);
        Database::php_dynamics(":lname", $data['lname']);
        Database::php_dynamics(":roles", $data['roles']);
        Database::php_dynamics(":occupation", $data['occupation']);
        Database::php_dynamics(":address", $data['address']);
        if (Database::php_exec()) {
            //success
            echo Database::php_responses(
                true,
                "single",
                array("success_user" => 200)
            );
        }
    }
}
