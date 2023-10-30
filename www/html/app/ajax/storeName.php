<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$db->query("SELECT name FROM store");
$result = $db->multiple();

echo json_encode($result);
?>