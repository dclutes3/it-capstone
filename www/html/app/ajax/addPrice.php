<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$db->query("INSERT INTO price (price, store_id, item_id) VALUES (:price, :store, :item)");
$db->bind(':price', $itemType);

echo json_encode($result);
?>