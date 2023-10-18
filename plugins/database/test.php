<?php
    include_once("../config.php");

    $db = new DatabaseNew();
    $log = new Log("DBTEST");
    $db->query("SELECT * FROM user");
    $results = $db->multiple();
    foreach($results as $res){
        $log->error(json_encode($res)."\n");
    }

    $log2 = new Log("OTHERTEST");
    $log2->error("TEST");
    

?>