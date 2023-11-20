<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

try {
    if (empty($_SESSION["userToReset"])) {
        echo json_encode(array("code" => -1, "data" => "No user authorized/selected."));
    } else {
        $usr = new user($_SESSION["userToReset"]);
        $password = $_REQUEST["pass"];

        $usr->resetPass($password);

        $_SESSION["user"] = $_SESSION["userToReset"];
	$_SESSION["name"] = $usr->getfName() . " " . $usr->getlName();
	$_SESSION['resetid'] = null;
        $_SESSION['question'] = null;
        $_SESSION['answer'] = null;
	$_SESSION['userToReset'] = null;

        echo json_encode(array("code" => 1, "data" => "Successfully reset password."));
    }
} catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
