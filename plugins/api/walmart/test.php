<?php 
include_once("../../config.php");

$api = new Walmart();
//$json = $api->callApi('category_id','65201');
$json = file_get_contents("test.json");
$api->storeResponse($json, "Cereals");

?>