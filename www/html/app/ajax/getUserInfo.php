<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
include_once("../../../../plugins/config.php");

try {
$usr = new user($_SESSION["user"]);
$fname = $usr->getfName();
$lname = $usr->getlName();
$email = $usr->getEmail();

echo json_encode(array('code' => 1, 'fname' => $fname, 'lname' => $lname, 'email' => $email));
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
