<?php 
include_once("../../config.php");

$api = new Kroger();
$token = $api->getToken();
$json = $api->callApi($token,"eggs");
echo $json;
?>