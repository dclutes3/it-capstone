<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$db->query("SELECT id, name FROM item");
$result = $db->multiple();

echo json_encode($result);
?>