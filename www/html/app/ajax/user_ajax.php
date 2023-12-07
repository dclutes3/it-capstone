<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$log = new Log("user ajax");
$usr = new user($_SESSION["user"]);
$fname = ($_REQUEST['fname'] != null) ? $_REQUEST['fname'] : null;
$lname = ($_REQUEST['lname'] != null) ? $_REQUEST['lname'] : null;
$email = ($_REQUEST['email'] != null) ? $_REQUEST['email'] : null;
$password = ($_REQUEST['password'] != null) ? $_REQUEST['password'] : null;
$action = ($_REQUEST['action'] != null) ? $_REQUEST['action'] : null;

$log->debug("$action");

if($action == "updateAll"){
    //all fields
    echo $usr->updateAll($fname,$lname,$email,$password);
} else if ($action == "updateOther"){
    //all but password
    echo $usr->updateOther($fname,$lname,$email);
} else if ($action == "updateFname"){
    echo $usr->updateFname($fname);
} else if ($action == "updateLname"){
    echo $usr->updateLname($lname);
} else if ($action == "updateEmail"){
    echo $usr->updateEmail($email);
} else if ($action == "updatePassword"){
    echo $usr->resetPass($password);
} else if ($action == "delete"){
    echo $usr->delete();
}
?>