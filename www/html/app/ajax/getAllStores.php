<?php
/********************* */
/* Drew Clutes aack2f  */
/********************* */


include_once("../../../../plugins/config.php");

try {
$db = new Database();
$db->query("SELECT * FROM store");
$result = $db->multiple();

echo json_encode(array('code' => 1, 'result' => $result)); //return the data to the user for use
}
catch (Exception $e) {
    $log->error("EXCEPTION");
    echo json_encode(array("code" => -2, "data" => "An unknown error occurred."));
}
?>
