<?php
/********************* */
/* Drew Clutes aack2f  */
/********************* */

class Database {
    private $host = "capstone.c8pz0fqew1c3.us-east-2.rds.amazonaws.com";
    private $user = "admin";
    private $password = "70NzYUJehuQ4MjMpZCsg";
    private $dbname = "capstone";

    private $dbh;
    private $stmt;

    public function __construct(){
        $this->dbh = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);

    }
    
    //this function prepares the SQL statement to be executed
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //this function binds the params by calling bind(":string",$value)
    public function bind($bindString,$bindValue){
        $this->stmt->bindParam($bindString,$bindValue);
    }

      //this function executes a query. this should be used directly only when the query does not expect a result (like a deletion)
    public function execute(){
        $this->stmt->execute();
    }

    //this function returns the number of rows of the most recently executed query
    public function rowCount(){
        return $this->stmt->rowCount();
    }

  
    //this function executes a query and returns only one row, so if you expect one value or want the first row only of a query
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //this function executes a query and returns all of the rows
    public function multiple(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //start a database transaction
    public function startTransaction(){
        $this->dbh->beginTransaction();
    }

    public function inTransaction(){
        if($this->dbh->inTransaction()){
            return true;
        } else {
            return false;
        }
    }

    //complete a database transaction
    public function commitTransaction(){
        $this->dbh->commit();
    }

    //stop a database transaction (if there is an exception for example)
    public function stopTransaction(){
        $this->dbh->rollBack();
    }
}
?>