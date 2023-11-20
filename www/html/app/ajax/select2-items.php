<?php
    include_once("../../../../plugins/config.php");

    $db = new Database();
    $log = new Log("GET ITEMS AJAX");
    
    try{
        $sql = "SELECT id, name as text FROM item";
        $db->query($sql);
        $results = $db->multiple();
    } catch(PDOException $e){
        $log->error("PDO EXCEPTION in /app/ajax/select2-items.php");
        echo json_encode(array());
    }
    

    echo json_encode($results);

?>