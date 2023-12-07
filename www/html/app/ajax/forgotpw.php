<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$email = $_REQUEST["email"];
$db = new Database();
$log = new Log("forgotpw");

// ^ Reads in email from request, creates a new db instance, and sets up logger.

try {
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email", $email);
    $res = $db->single();

    // ^ Sends a prepared query to get the info we need in order to determine if a valid email was entered

    if ($res == null) {
        echo json_encode(array("code" => -1, "data" => "invalid email")); // If no account exists, do nothing
    } else {
        $_SESSION['resetid'] = $res['id'];
        $_SESSION['answer'] = $res['sanswer'];
        $questionid = $res['squestion'];

	// ^ Sets secure session variables for use in further steps of the reset process, the answers are hashed.

        $db->query("SELECT * FROM capstone.secquestion WHERE ID = :questionid");
        $db->bind(":questionid", $questionid);
        $res = $db->single();

	// ^ Sends a prepared query to get the actual security question (string) from a seperate table for the option that the user chose.

        $_SESSION['question'] = $res['question']; // Sets a secure session variable for use in the next step in the process
        echo json_encode(array("code" => 1, "data" => "User set."));
    }
} catch (PDOException $e) {
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "PDO Exception."));
}
?>