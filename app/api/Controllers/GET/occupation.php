<?php

include_once "../../../config/db.php";
include_once "../../../config/queries.php";

$getMethod = new Server();
$getQuery = new Queries();
$config = new Database();

if($getMethod->checkGETserver()) {
    if($config->php_query($getQuery->getAlloccupation("occupation", "registration/getAlloccupation"))){
        $config->php_exec();
        $row = $config->php_fetchAll_row();
        echo $config->php_responses(true, "single", array($row));
    }
}
?>