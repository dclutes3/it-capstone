<?php
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("select2-stores AJAX");

try{
    $sql = "SELECT id, CONCAT(name, ' - ', address) as text FROM store"; //format into select2 format, where the store name is called text
    $db->query($sql);
    $results = $db->multiple();
} catch(PDOException $e){
    $log->error("PDO EXCEPTION in /app/ajax/select2-stores.php");
    echo json_encode(array());
}


echo json_encode($results); //return the data to the js call

?>