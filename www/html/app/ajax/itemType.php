<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$db->query("SELECT name FROM item_type");
$result = $db->multiple();

echo json_encode($result);
?>