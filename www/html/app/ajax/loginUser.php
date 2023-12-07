<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

// ^ Read in email/password from request

$db = new Database(); // Setup a db instance

$log = new Log("login"); // Set up logger for this function

try {
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email", $email);
    $res = $db->single();

    // ^ Send a prepared (injection safe) query (to get the info we need to verify a login, and if a user exists)

    if ($res == null) {
        echo json_encode(array("code" => -1, "data" => "invalid login")); // If no result, user does not exist
    } else {
        if (password_verify($password, $res["password"])) { // Checks hashed password against password sent by the user
            $_SESSION["user"] = $res["id"];
	    $_SESSION["name"] = $res["fname"] . " " . $res["lname"];
	    $_SESSION['resetid'] = null;
            $_SESSION['question'] = null;
            $_SESSION['answer'] = null;
	    $_SESSION['userToReset'] = null;

	    // ^ If valid login, sets secure session variables that are used elsewhere, and clears out password reset process just in case.

            echo json_encode(array("code" => 1, "data" => "Logged in."));
        } else {
            echo json_encode(array("code" => -1, "data" => "invalid login")); // Do nothing if invalid login
        }
    }
} catch (PDOException $e) {
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "PDO Exception."));
}
?>