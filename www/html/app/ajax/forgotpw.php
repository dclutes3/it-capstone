<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$email = $_REQUEST["email"];
$db = new Database();
$log = new Log("forgotpw");

try{
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email",$email);
    $res = $db->single();
    if($res==null){
        echo json_encode(array("code"=>-1,"data"=>"invalid email"));
    } else {
        $_SESSION['resetid']=$res['id'];
        $_SESSION['question']=$res['squestion'];
        $_SESSION['answer']=$res['sanswer'];
        echo json_encode(array("code"=>1,"data"=>"User set."));
    }
} catch (PDOException $e){
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code"=>-2,"data"=>"PDO Exception."));
}

?>