<?php 
include_once("../../config.php");

$api = new Target();
$json = $api->callApi('category_id','65201');

$api->storeResponse($json, "Cereals");

?>