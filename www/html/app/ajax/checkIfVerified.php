<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$check = $_SESSION['userToReset'];
$check2 = $_SESSION['resetid'];

if(!empty($check))
{
    echo json_encode(array("code" => 1, "data" => "Verified."));
}
else if(!empty($check2))
{
    echo json_encode(array("code" => 2, "data" => "Not verified."));
}
else
{
    echo json_encode(array("code" => -1, "data" => "No user selected."));
}

?>