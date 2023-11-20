<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$name = $_REQUEST["name"];
$type_id = $_REQUEST["type_id"];

try {
    $db = new Database();
    $db->query("SELECT id FROM item WHERE name = :name");
    $db->bind(':name', $name);
    $result = $db->single();
    if (!empty($result)){
        echo json_encode(array('code' => 1, 'result' => $result));
    }
    else{
        $db->query("INSERT INTO item (name, type_id) VALUES (:name, :type_id)");
        $db->bind(':name', $name);
        $db->bind(':type_id', $type_id);
        $db->execute();
        $db->query("SELECT id FROM item WHERE name = :name");
        $db->bind(':name', $name);
        $result = $db->single();
        echo json_encode(array('code' => 1, 'result' => $result));
    }
}
catch (Exception $e){
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -1, "data" => "An unknown error occurred."));
}
?>