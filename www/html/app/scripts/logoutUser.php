<?php
try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION["user"])) {
        $_SESSION["user"] = null;
	$_SESSION["name"] = null;
	header("Location: ../../login");
    } else {
        $log->error("User is not logged in, however logout was called.");
    }
} catch (Exception $e) {
    $log->error("EXCEPTION");
}
?>