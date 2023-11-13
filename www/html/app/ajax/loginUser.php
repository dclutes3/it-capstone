<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$db = new Database();
$log = new Log("login");

try {
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email", $email);
    $res = $db->single();
    if ($res == null) {
        echo json_encode(array("code" => -1, "data" => "invalid login"));
    } else {
        if (password_verify($password, $res["password"])) {
            $_SESSION["user"] = $res["id"];
	    $_SESSION["name"] = $res["fname"] . " " . $res["lname"];
	    $_SESSION['resetid'] = null;
            $_SESSION['question'] = null;
            $_SESSION['answer'] = null;
	    $_SESSION['userToReset'] = null;
            echo json_encode(array("code" => 1, "data" => "Logged in."));
        } else {
            echo json_encode(array("code" => -1, "data" => "invalid login"));
        }
    }
} catch (PDOException $e) {
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "PDO Exception."));
}
?>