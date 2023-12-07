<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

try {
    if (empty($_SESSION["userToReset"])) { // Checks if user has passed previous two steps (provide email and answer question correctly).
        echo json_encode(array("code" => -1, "data" => "No user authorized/selected.")); // Do nothing if not at the correct step.
    } else {
        $usr = new user($_SESSION["userToReset"]);
        $password = $_REQUEST["pass"];

	// ^ Creates a new user instance from the ID of the user to be reset and reads in the new password from the request.

        $usr->resetPass($password); // Resets the users password (hashed) using a function in the instance.

        $_SESSION["user"] = $_SESSION["userToReset"];
	$_SESSION["name"] = $usr->getfName() . " " . $usr->getlName();
	$_SESSION['resetid'] = null;
        $_SESSION['question'] = null;
        $_SESSION['answer'] = null;
	$_SESSION['userToReset'] = null;

	// ^ Sets session variables for logging in, and clears out reset process session variables.

        echo json_encode(array("code" => 1, "data" => "Successfully reset password."));
    }
} catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
