<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

try {
    $usr = new user($_SESSION["userToReset"]);
    $password = $_REQUEST["pass"];

    $usr->resetPass($password);
    
    $_SESSION["user"] = $_SESSION["userToReset"];

    echo json_encode(array("code" => 1, "data" => "Successfully reset password."));
} catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
