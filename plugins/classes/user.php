<?php
include_once("/var/plugins/config.php");
class user {

    private $fname;
    private $lname;
    private $email;
    private $db;
    private $log;
    private $id;

    public function __construct($userId) {
        $this->id = $userId;
        $this->db = new Database();
        $this->log = new Log("User Class");
        try {
            $this->db->query("SELECT * FROM capstone.user WHERE ID = :id");
            $this->db->bind(":id", $userId);
            $res = $this->db->single();
            if ($res == null) {
                $this->log->error("Error finding userid in database");
            } else {
                $this->fname = $res["fname"];
                $this->lname = $res["lname"];
                $this->email = $res["email"];
            }
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
        }
    }

    public function getFname() {
        return $this->fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function delete() {
        try {
            $this->db->query("DELETE FROM capstone.user WHERE ID = :id");
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your account could not be deleted due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Account successfully deleted."));
    }
    
    public function updateAll($fname, $lname, $email, $pass) {
        try {
            $this->db->query("UPDATE capstone.user SET fname = :fname, lname = :lname, email = :email, password = :pass WHERE ID = :id");
            $this->db->bind(":fname", $fname);
            $this->db->bind(":lname", $lname);
            $this->db->bind(":email", $email);
            $this->db->bind(":pass", password_hash($pass, PASSWORD_ARGON2ID));
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your account could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Account successfully updated."));
    }
    
    public function updateOther($fname, $lname, $email) {
        try {
            $this->db->query("UPDATE capstone.user SET fname = :fname, lname = :lname, email = :email WHERE ID = :id");
            $this->db->bind(":fname", $fname);
            $this->db->bind(":lname", $lname);
            $this->db->bind(":email", $email);
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your account could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Account successfully updated."));
    }
    
    public function updateFname($fname) {
        try {
            $this->db->query("UPDATE capstone.user SET fname = :fname WHERE ID = :id");
            $this->db->bind(":fname", $fname);
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your first name could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"First name successfully updated."));
    }

    public function updateLname($lname) {
        try {
            $this->db->query("UPDATE capstone.user SET lname = :lname WHERE ID = :id");
            $this->db->bind(":lname", $lname);
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your last name could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Last name successfully updated."));
    }

    public function updateEmail($email) {
        try {
            $this->db->query("UPDATE capstone.user SET email = :email WHERE ID = :id");
            $this->db->bind(":email", $email);
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your email could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Email successfully updated."));
    }

    public function resetPass($pass) {
        try {
            $this->db->query("UPDATE capstone.user SET password = :pass WHERE ID = :id");
            $this->db->bind(":pass", password_hash($pass, PASSWORD_ARGON2ID));
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $this->log->error("PDO EXCEPTION");
            return json_encode(array("code"=>-1,"msg"=>"Your password could not be updated due to an error."));
        }
        return json_encode(array("code"=>1,"msg"=>"Password successfully updated."));
    }

}
?>
