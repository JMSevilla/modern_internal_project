<?php

include_once "../../../config/db.php";
include_once "../../../config/queries.php";

$getMethod = new Server();
$getQuery = new Queries();
$config = new Database();

if($getMethod->checkGETServer()) {
    if($config->php_query($getQuery->getServicesContent("services_content", "ServiceContent"))){
        $config->php_exec();
        $row = $config->php_row();
        echo $config->php_responses(true, "single", array($row));
    }
}

?>