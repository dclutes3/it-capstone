<?php
    include_once("../../../../plugins/config.php");

    $db = new Database();
    $log = new Log("select2-questions AJAX");
    
    try{
        $sql = "SELECT id, question as text FROM secquestion"; //format the data in the select2 format where the question should be called text
        $db->query($sql);
        $results = $db->multiple();
    } catch(PDOException $e){
        $log->error("PDO EXCEPTION in /app/ajax/select2-questions.php");
        echo json_encode(array());
    }
    

    echo json_encode($results); //return the data to the JS ajax call for use

?>