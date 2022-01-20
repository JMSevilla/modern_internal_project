<?php

class Params
{
    public static $host = "localhost";
    public static $username = "root";
    public static $password = "";
    public static $db = "db_modern";
    public static $helper;
    public static $stmt;
}

class LoginParams
{
    public static $password;
    public static $istype;
    public static $status;
}


class Database
{


    public function getConnection()
    {
        try {
            $dsn = "mysql:host=" . Params::$host . ";dbname=" . Params::$db;
            Params::$helper = new PDO($dsn, Params::$username, Params::$password);
            Params::$helper->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return Params::$helper;
        } catch (PDOException $th) {
            die("Invalid connection" . $th->getMessage());
        }
    }
    public function php_prepare($sql)
    {
        return Params::$stmt = $this->getConnection()->prepare($sql);
    }
    public function php_query($sql)
    {
        return Params::$stmt = $this->getConnection()->query($sql);
    }
    public function php_dynamics($val, $param, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case $type == 1:
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        return Params::$stmt->bindParam($val, $param, $type);
    }
    public function php_exec()
    {
        return Params::$stmt->execute();
    }
    public function php_row()
    {
        return Params::$stmt->rowCount() > 0;
    }
    public function php_fetch_row()
    {
        return Params::$stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function php_password_verify($request, $args)
    {
        return password_verify($request, $args);
    }
    public function php_responses(
        $bool,
        $payload = null,
        $isArray
    ) {
        switch ($bool) {
            case $payload == "single":
                return json_encode($isArray);
                break;
        }
    }
    public function php_password_encryptor($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
