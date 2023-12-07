<?php 
/********************* */
/* Drew Clutes aack2f  */
/********************* */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("updateQuantity AJAX");
$price_id = ($_REQUEST['price_id']) ? $_REQUEST['price_id'] : null;         //initialize variables to their values or defaults on NULL.
$quantity = ($_REQUEST['quantity']) ? intval($_REQUEST['quantity']) : 0;
$user = ($_SESSION['user']) ? $_SESSION['user'] : null;

if($user){
    try{
        $sql = "SELECT prices FROM cart WHERE user_id=:user";
        $db->query($sql);
        $db->bind(":user",$user);
        $prices = json_decode(($db->single()['prices']),true);              //decode the result into an associative array   
        $new = array();
        foreach($prices as $price){                                         //loop through each object in the cart. if you hit the right object update the quantity
            $row = array();
            $row['id']=$price['id'];
            if($price['id']==$price_id){
                $row['quantity']=$quantity;
            } else {
                $row['quantity']=$price['quantity'];
            }

            if($row['quantity'] > 0)                                        //delete invalid quantities or when the quantity is set to 0.
                $new[] = $row;
        }

        $sql2 = "UPDATE cart SET prices=:prices WHERE user_id=:user";       //update the database with the new array of objects
        $db->query($sql2);
        $db->bind(":prices",json_encode($new));
        $db->bind(":user",$user);
        $db->execute();
    } catch (PDOException $e){
        $log->debug("PDOException in updateQuantity");
    }
}
else
{
    header('Location: login');
}
