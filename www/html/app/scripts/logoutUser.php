<?php
try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION["user"])) {
        $_SESSION["user"] = null;
	header("Location: ../pages/login.php");
    } else {
        $log->error("User is not logged in, however logout was called.");
    }
} catch (Exception $e) {
    $log->error("EXCEPTION");
}
?>