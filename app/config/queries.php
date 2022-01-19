<?php

interface queryInterface {
    function selectionQuery($table, $args);
}

class Queries {
    function selectionQuery($table, $args){
        if($args == "loginQuery"){
            $query = "SELECT * FROM " . $table . " where username=:uname";
            return $query;
        }
    }
}

class Server {
    function checkServer(){
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }
}