<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
include_once("../../../../plugins/config.php");

try {
$usr = new user($_SESSION["user"]);

$usr->delete();

echo json_encode(array("code" => 1, "data" => "Successful."));
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
