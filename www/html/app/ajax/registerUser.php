<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$password = password_hash($_REQUEST["password"], PASSWORD_ARGON2ID);
$db = new Database();
$log = new Log("registerUser");

try{
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email",$email);
    $res = $db->single();
    if($res!=null){
        echo json_encode(array("code"=>-1,"data"=>"duplicate email"));
    } else {
        $db->query("INSERT INTO user(fname, lname, email, password) VALUES (:fname, :lname, :email, :password)");
        $db->bind(":fname",$fname);
        $db->bind(":lname",$lname);
        $db->bind(":email",$email);
        $db->bind(":password",$password);
        $db->execute();

        $db->query("SELECT id FROM user WHERE email=:email");
        $db->bind(":email",$email);
        $_SESSION['user']=$db->single()['id'];
        echo json_encode(array("code"=>1,"data"=>"Account Created."));
    }
} catch (PDOException $e){
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code"=>-2,"data"=>"PDO Exception."));
}

?>