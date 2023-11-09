<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$useranswer = $_REQUEST["answer"];

$answer = $_SESSION["answer"];

if(!empty($answer))
{
    if (password_verify($useranswer, $answer)) {
        $_SESSION["userToReset"] = $_SESSION["resetid"];
        echo json_encode(array("code" => 1, "data" => "Successful."));
    }
    else
    {
        echo json_encode(array("code" => -1, "data" => "Incorrect answer."));
    }
}
else
{
    echo json_encode(array("code" => -2, "data" => "No user selected."));
}

?>