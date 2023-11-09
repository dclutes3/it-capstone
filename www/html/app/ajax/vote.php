<?php 
include_once('../../../../plugins/config.php');

$db = new Database();
$log = new Log("Vote Ajax");

$user = $_REQUEST['user'];
$price = $_REQUEST['price'];
$type = ($_REQUEST['type']=='upvote') ? 1 : -1;
$store = $_REQUEST['store'];

try{
    $db->query("SELECT id FROM store WHERE name=:store");
    $db->bind(":store",$store);
    $store_id = $db->single()['id'];

    $sql = "SELECT id FROM vote WHERE price_id=:price AND user_id=:user AND store_id=:store_id";
    $db->query($sql);
    $db->bind(":price",$price);
    $db->bind(":user",$user);
    $db->bind(":store_id",$store_id);
    $vote_id = $db->single()['id'];

    if($vote_id==null){
        $sql2 = "INSERT INTO vote (user_id, price_id, store_id, type) VALUES (:id, :price, :store_id, :type)";
    } else {
        $sql2 = "UPDATE vote SET type = :type WHERE id=:vote";
    }
     
    $db->query($sql2);
    $log->warning($sql2);
    $db->bind(":type",$type);
    if($vote_id != null) {
        $db->bind(":vote",$vote_id);
    } else {
        $db->bind(":id",$user);
        $db->bind(":price",$price);
        $db->bind(":store_id",$store_id);
    }
        
    $db->execute();

    echo json_encode(array("code"=>1,"msg"=>"vote successful"));
} catch (PDOException $e){
    $log->error("PDO EXCEPTION IN VOTE AJAX".$e->getMessage());
    echo json_encode(array("code"=>-1,"msg"=>"PDOException in /app/ajax/vote.php"));
}

?>