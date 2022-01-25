<?php

interface queryInterface
{
    function selectionQuery($table, $args);
    function RegisterQuery($table, $args);
    function RegisterQueryAdmin($table, $args);
    function checkIsType($table, $args);
    function getAllDepartment($table, $args);
    function setTokenization($args);
    function getTokenization($table, $args);
    function getAllUser($table, $args);
}

class Queries
{
    function selectionQuery($table, $args)
    {
        if ($args == "loginQuery") {
            $query = "SELECT * FROM " . $table . " where email=:email";
            return $query;
        }
    }
    function RegisterQuery($table, $args)
    {
        if ($args == "user") {
            $query = "INSERT INTO " . $table . "(id,email,password,istype,firstname,lastname,status,roles,occupation,createdAt,address,tokenization) VALUES 
            (default, :email,:password,'2',:fname,:lname,'0',
            :roles,:occupation,current_timestamp,:address, 'none')";
            return $query;
        }
    }
    function RegisterQueryAdmin($table, $args)
    {
        if ($args == "admin") {
            $query = "INSERT INTO " . $table . "(id,email,password,istype,firstname,lastname,status,roles,occupation,createdAt,address,tokenization) VALUES 
            (default, :email,:password,'1',:fname,:lname,'1',
    :roles,:occupation,current_timestamp,:address, 'none')";
            return $query;
        }
    }
    function checkIsType($args)
    {
        if ($args == "check_is_type") {
            $sql = "
            select * from users where istype = 1
        ";
            return $sql;
        }
    }
    function getAllDepartment($table, $args)
    {
        if ($args == "registration/getAllDepartment") {
            $sql = "select distinct roleName from " . $table . "";
            return $sql;
        }
    }
    function getAllUser($table, $args){
        if($args == "admin/getAllUser"){
            $sql = "select * from " . $table . "";
            return $sql;
        }
    }
    function getAlloccupation($table, $args)
    {
        if ($args == "registration/getAlloccupation") {
            $sql = "select distinct occupationName from " . $table . "";
            return $sql;
        }
    }
    function setTokenization($args)
    {
        if ($args == "setToken") {
            $sql = "update users set tokenization=:token where email=:email";
            return $sql;
        }
    }
    function getTokenization($table, $args)
    {
        if ($args == "getToken") {
            $sql = "select tokenization from " . $table . " where email=:email";
            return $sql;
        }
    }
}

class Server
{
    function checkServer()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }
    function checkGETServer()
    {
        return $_SERVER["REQUEST_METHOD"] == "GET";
    }
}
