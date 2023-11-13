<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
include_once("../../../../plugins/config.php");

try {
if(!empty($_SESSION["name"]))
{
    $name = $_SESSION["name"];
    echo json_encode(array('code' => 1, 'name' => $name));
}
else
{
    echo json_encode(array('code' => -1, 'data' => "Not logged in"));
}
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
