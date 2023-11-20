<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("getCart AJAX");
$user = ($_SESSION['user']) ? $_SESSION['user'] : null;
try {
    if($user){
        $sql = "SELECT count,prices FROM cart WHERE id=:id";
        $db->query($sql);
        $db->bind(":id",$user);
        $result = $db->single();
        $count = $result['count'];
        $prices = json_decode($result['prices']);
        $full_array = array();
        if(is_array($prices)){
            foreach($prices as $price){
                $row = array();
                $db->query("SELECT item, price, price_id, type, store FROM view_item WHERE price_id = :price_id");
                $db->bind(":price_id",$price);
                $item = $db->single();
                $row['price_id']    = $item['price_id'];
                $row['item']        = $item['item'];
                $row['price']       = $item['price'];
                $row['type']        = $item['type'];
                $row['store']       = $item['store'];
                $full_array[] = $row;
            }
        } else {
            $log->debug("ERROR WITH DECODE");
        }
        echo json_encode(array("data" => $full_array));
    } else {
        $log->error("There is no user logged in");
        echo json_encode(array("data"=>""));
    }
} catch (PDOException $e) {
    $log->error("EXCEPTION in /app/ajax/updateCart.php".$e->getMessage());
    echo json_encode(array("data"=>""));
}
?>