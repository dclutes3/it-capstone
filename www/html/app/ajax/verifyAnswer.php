<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$useranswer = $_REQUEST["answer"];

$answer = $_SESSION["answer"];

// ^ Reads in the queried correct hashed answer for the user, as well as the given answer from the request

if(!empty($answer))
{
    if (password_verify($useranswer, $answer)) { // Verifies the user's answer against the hashed answer
        $_SESSION["userToReset"] = $_SESSION["resetid"]; // Sets the final verification session variable for the last step
        echo json_encode(array("code" => 1, "data" => "Successful."));
    }
    else
    {
        echo json_encode(array("code" => -1, "data" => "Incorrect answer.")); // Do nothing if incorrect
    }
}
else
{
    echo json_encode(array("code" => -2, "data" => "No user selected.")); // Do nothing if first step was not completed (entering email)
}

?>