<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("select2 store name");

try{
    $db->query("SELECT id, name as text FROM store");
    $result = $db->multiple();
} catch(PDOException $e){
    $log->warning("PDO Exception in /app/ajax/select2-storeName.php ".$e->getMessage());
    echo json_encode(array());
}

echo json_encode($result);
?>