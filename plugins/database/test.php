<?php
    include_once("database_new.php");

    $db = new DatabaseNew();
    $db->query("SELECT * FROM user");
    $results = $db->multiple();
    foreach($results as $res){
        echo json_encode($res)."\n";
    }
    

?>