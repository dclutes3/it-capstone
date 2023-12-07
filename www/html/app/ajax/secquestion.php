<?php

// Reads in security question that was queried earlier for the user and returns it for the UI

if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$question = $_SESSION['question'];

if(!empty($question))
{
    echo json_encode(array('code' => 1, 'question' => $question));
}
else
{
    echo json_encode(array("code" => -1, "data" => "No user selected."));
}

?>