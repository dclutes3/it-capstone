<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$usr = new user($_SESSION["user"]);
$fname = $usr->getfName();
$lname = $usr->getlName();
$email = $usr->getEmail();

echo json_encode(array('fname'=>$fname,'lname'=>$lname,'email'=>$email));
?>
