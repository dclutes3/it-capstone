<?php
include_once("/var/plugins/config.php");
class user {

    private $fname;
    private $lname;
    private $email;

    public function __construct($userId) {
        $db = new Database();
        $log = new Log("userinfo");
        try {
            $db->query("SELECT * FROM capstone.user WHERE ID = :id");
            $db->bind(":id", $userId);
            $res = $db->single();
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

}
?>
