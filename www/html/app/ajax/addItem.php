<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$name = $_REQUEST["name"];
$type_id = $_REQUEST["type_id"];

$db = new Database();
$db->query("INSERT INTO item (name, type_id) VALUES (:name, :type_id)");
$db->bind(':name', $name);
$db->bind(':type_id', $type_id);
$db->execute();
?>