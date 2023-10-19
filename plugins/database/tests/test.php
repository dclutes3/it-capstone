<?php
    include_once("../config.php");

    $db = new Database();
    $log = new Log("DBTEST");
    $db->query("SELECT * FROM user WHERE email='drewclutes@gmail.com'");
    $results = $db->multiple();
    echo "ROWS: ".$db->rowCount()."\n";
    foreach($results as $res){
        echo json_encode($res)."\n";
    }


?>