<?php
/********************* */
/* Drew Clutes aack2f  */
/********************* */

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("select2-itemType AJAX");
try{
    $db->query("SELECT id, name as text FROM item_type"); //format the item type into the select2 format, where the name must be called text.
    $result = $db->multiple();
} catch(PDOException $e){
    $log->warning("PDOException in /app/ajax/select2-itemType.php ".$e->getMessage());
    echo json_encode(array());
}

echo json_encode($result); //return the result to the JS ajax call for use
?>