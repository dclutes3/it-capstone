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
    if($user){ //if the user is logged in
        $db->query("SELECT prices FROM cart WHERE user_id=:id");
        $db->bind(":id",$user);
        $currentPrices = json_decode(($db->single()['prices']),true); //get an array of objects currently stored in the database. 
        $keys = array();
        foreach($currentPrices as $value){ //create an array of all id's from the current ids
            if(is_int(intval($value['id']))){
                $keys[]=$value['id'];
            }
        }
        $new = array();
        foreach(json_decode($prices,true) as $id){ //loop through all of the prices from the JS call and add a new entry to the current prices array
            if(in_array($id,$keys,true)==false){
                $currentPrices[]=array("id"=>$id,"quantity"=>0);
            }
        }
        foreach($currentPrices as $price){ //for every object in the current prices, update it.
            $row = array();
            $row['id']=$price['id'];
            $row['quantity']=$price['quantity'];
            foreach(json_decode($prices,true) as $i){ //if there is an instance (there may be multiple) of a number, add it to the 
                if($price['id']==$i){
                    $row['quantity']+=1;
                }
            }
            $new[] = $row;
        }
            
        $sql = "INSERT INTO cart (user_id, prices) VALUES (:id,:prices) ON DUPLICATE KEY UPDATE prices=:prices"; //add the newly updated array back to the database.
        $db->query($sql);
        $db->bind(":id",$user);
        $db->bind(":prices",json_encode($new));
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


