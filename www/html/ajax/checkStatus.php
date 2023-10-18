<?php
try {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION["user"])) {
        echo json_encode(array("code" => 1, "data" => "User is logged in."));
    } else {
        echo json_encode(array("code" => -1, "data" => "User is not logged in."));
    }
} catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "Exception."));
}
?>