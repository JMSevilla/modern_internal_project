<?php

include_once "../../../config/db.php";
include_once "../../../config/queries.php";

$getMethod = new Server();
$getQuery = new Queries();
$config = new Database();

if($getMethod->checkGETServer()){
    if($config->php_query($getQuery->getAllDepartment("roles", "registration/getAllDepartment"))){
        $config->php_exec();
        $row = $config->php_fetchAll_row();
        echo $config->php_responses(true, "single", array($row));
    }
}