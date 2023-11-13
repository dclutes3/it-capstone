<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
include_once("../../../../plugins/config.php");

try {
$usr = new user($_SESSION["user"]);
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

if(!empty($password))
{
    $usr->updateAll($fname, $lname, $email, $password);
}
else
{
    $usr->updateOther($fname, $lname, $email);
}

echo json_encode(array("code" => 1, "data" => "Successfully updated your account."));
$_SESSION["name"] = $fname . " " . $lname;
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
