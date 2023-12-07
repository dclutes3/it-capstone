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

// ^ Reads in all fields from the request on "My Account" page

if(!empty($password))
{
    $usr->updateAll($fname, $lname, $email, $password); // If user chose to reset password, do that as well.
}
else
{
    $usr->updateOther($fname, $lname, $email); // If user did NOT choose to reset password, only update other info.
}

echo json_encode(array("code" => 1, "data" => "Successfully updated your account."));
$_SESSION["name"] = $fname . " " . $lname; // Changes name in corner instantly
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
