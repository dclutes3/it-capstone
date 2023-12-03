<?php
/********************* */
/* Drew Clutes aack2f  */
/********************* */

include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("select2-items AJAX");

try{
    $sql = "SELECT id, name as text FROM item"; //format in select2 format, where the name is called text
    $db->query($sql);
    $results = $db->multiple();
} catch(PDOException $e){
    $log->error("PDO EXCEPTION in /app/ajax/select2-items.php");
    echo json_encode(array());
}


echo json_encode($results);  //return the items in the select2 format the the JS call using AJAX

?>
