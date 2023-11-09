<?php

include_once("../../../../plugins/config.php");

try {
$db = new Database();
$db->query("SELECT * FROM store");
$result = $db->multiple();

echo json_encode(array('code' => 1, 'result' => $result));
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
