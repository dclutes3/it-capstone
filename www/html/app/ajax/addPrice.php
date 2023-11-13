<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$price = $_REQUEST["price"];
$store_id = $_REQUEST["store_id"];
$item_id = $_REQUEST["item_id"];

$db = new Database();
$db->query("INSERT INTO price (price, store_id, item_id, user_id) VALUES (:price, :store_id, :item_id, 1)");
$db->bind(':price', $price);
$db->bind(':store_id', $store_id);
$db->bind(':item_id', $item_id);
$db->execute();
?>