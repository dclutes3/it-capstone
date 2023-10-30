<?php
include_once("/var/plugins/config.php");
class user {

    private $fname;
    private $lname;
    private $email;
    private $db;
    private $id;

    public function __construct($userId) {
        $this->id = $userId;
        $this->db = new Database();
        $log = new Log("userinfo");
        try {
            $this->db->query("SELECT * FROM capstone.user WHERE ID = :id");
            $this->db->bind(":id", $userId);
            $res = $this->db->single();
            if ($res == null) {
                $log->error("Error finding userid in database");
            } else {
                $this->fname = $res["fname"];
                $this->lname = $res["lname"];
                $this->email = $res["email"];
            }
        } catch (PDOException $e) {
            $log->error("PDO EXCEPTION");
        }
    }

    public function getfName() {
        return $this->fname;
    }

    public function getlName() {
        return $this->lname;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function delete() {
        $log = new Log("deleteuser");
        try {
            $this->db->query("DELETE FROM capstone.user WHERE ID = :id");
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $log->error("PDO EXCEPTION");
        }
    }
    
    public function updateAll($fname, $lname, $email, $pass) {
        $log = new Log("updateuser");
        try {
            $this->db->query("UPDATE capstone.user SET fname = :fname, lname = :lname, email = :email, password = :pass WHERE ID = :id");
            $this->db->bind(":fname", $fname);
            $this->db->bind(":lname", $lname);
            $this->db->bind(":email", $email);
            $this->db->bind(":pass", password_hash($pass, PASSWORD_ARGON2ID));
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $log->error("PDO EXCEPTION");
        }
    }
    
    public function updateOther($fname, $lname, $email) {
        $log = new Log("updateuser");
        try {
            $this->db->query("UPDATE capstone.user SET fname = :fname, lname = :lname, email = :email WHERE ID = :id");
            $this->db->bind(":fname", $fname);
            $this->db->bind(":lname", $lname);
            $this->db->bind(":email", $email);
            $this->db->bind(":id", $this->id);
            $this->db->execute();
        } catch (PDOException $e) {
            $log->error("PDO EXCEPTION");
        }
    }

}
?>
