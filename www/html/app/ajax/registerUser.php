<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");

$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];
$email = $_REQUEST["email"];
$password = password_hash($_REQUEST["password"], PASSWORD_ARGON2ID);
$squestion = $_REQUEST["squestion"];
$sanswer = password_hash($_REQUEST["sanswer"], PASSWORD_ARGON2ID);
$db = new Database();
$log = new Log("registerUser");

// ^ Reads in all of the info from the request, creates a db instance, and creates a password hash (to go in the db) from the submitted password

try{
    $db->query("SELECT * FROM capstone.user WHERE EMAIL = :email");
    $db->bind(":email",$email);
    $res = $db->single();

    // ^ Sends a prepared query to get the info we need to determine if an email is already being used

    if($res!=null){
        echo json_encode(array("code"=>-1,"data"=>"duplicate email")); // Do nothing if duplicate user
    } else {
        $db->query("INSERT INTO user(fname, lname, email, password, squestion, sanswer) VALUES (:fname, :lname, :email, :password, :squestion, :sanswer)");
        $db->bind(":fname",$fname);
        $db->bind(":lname",$lname);
        $db->bind(":email",$email);
        $db->bind(":password",$password);
	$db->bind(":squestion",$squestion);
	$db->bind(":sanswer",$sanswer);
        $db->execute();

	// ^ Sends a prepared query to create a user, with all of the info, and the previously hashed password.

        $db->query("SELECT * FROM user WHERE email=:email");
        $db->bind(":email",$email);
        $_SESSION['user']=$db->single()['id'];
	$_SESSION["name"] = $fname . " " . $lname;
	$_SESSION['resetid'] = null;
        $_SESSION['question'] = null;
        $_SESSION['answer'] = null;
	$_SESSION['userToReset'] = null;
        echo json_encode(array("code"=>1,"data"=>"Account Created."));

	// ^ Gets the created user's id and sets that session variable (in order to log them in), sets other sessions variables to be used elsewhere
	// Also clears out the password reset process, just in case.
    }
} catch (PDOException $e){
    $log->error("PDO EXCEPTION");
    echo json_encode(array("code"=>-2,"data"=>"PDO Exception."));
}

?>