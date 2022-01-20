<?php

interface queryInterface {
    function selectionQuery($table, $args);
    function RegisterQuery($table, $args);
    function RegisterQueryAdmin($table, $args);
}

class Queries {
    function selectionQuery($table, $args){
        if($args == "loginQuery"){
            $query = "SELECT * FROM " . $table . " where email=:email";
            return $query;
        }
    }
    function RegisterQuery($table, $args){
        if($args == "user"){
            $query = "INSERT INTO " . $table . "(id,email,password,istype,firstname,lastname,status,roles,occupation,createdAt,address) VALUES 
            (default, :email,:password,'2',:fname,:lname,'0',
            :roles,:occupation,current_timestamp,:address)";
             return $query;
        }
    }
    function RegisterQueryAdmin($table, $args){
        if($args == "admin"){
            $query = "INSERT INTO ". $table . "(id,email,password,istype,firstname,lastname,status,roles,occupation,createdAt,address) VALUES 
            (default, :email,:password,'1',:fname,:lname,'1',
    :roles,:occupation,current_timestamp,:address)";
             return $query;
        }
    }
}

class Server {
    function checkServer(){
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }
}