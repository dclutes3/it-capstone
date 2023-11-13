<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("ITEM TYPE AJAX");
try{
    $db->query("SELECT id, name as text FROM item_type");
    $result = $db->multiple();
} catch(PDOException $e){
    $log->warning("PDOException in /app/ajax/itemType.php ".$e->getMessage());
    echo json_encode(array());
}

echo json_encode($result);
?>