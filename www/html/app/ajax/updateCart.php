<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("updateCart AJAX");
$prices = ($_REQUEST['prices']) ? $_REQUEST['prices'] : json_encode(array());
$count = ($_REQUEST['count']) ? intval($_REQUEST['count']) : 0;
$user = ($_SESSION['user']) ? $_SESSION['user'] : null;
try {
    if($user){
        $sql = "INSERT INTO cart (id, prices, count) VALUES (:id,:prices,:count) ON DUPLICATE KEY UPDATE prices=:prices, count=:count";
        $db->query($sql);
        $db->bind(":id",$user);
        $db->bind(":prices",$prices);
        $db->bind(":count",$count);
        $db->execute();

        echo json_encode(array("code" => 1, "msg" => "Successfully updated cart."));
    } else {
        $log->error("There is no user logged in");
        echo json_encode(array("code" => -1, "msg" => "No User Logged In"));
    }
} catch (PDOException $e) {
    $log->error("EXCEPTION in /app/ajax/updateCart.php".$e->getMessage());
    echo json_encode(array("code" => -2, "msg" => "An unknown error occurred."));
}
?>


