<?php 
class Database {
	private $dbHost = "capstone.c8pz0fqew1c3.us-east-2.rds.amazonaws.com";
	private $dbUser = "admin";
	private $port = 3306;
	private $dbPassword = "70NzYUJehuQ4MjMpZCsg";
	private $dbName = "capstone";
	private $conn;
	private $query;
        private $stmt;

	public function __construct(){
		$this->conn =  new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName, $this->port);
	}	
	
	public function tester(){
		if($this->conn->connect_error){
			die("Connection failed: " . $this->conn->connect_error);
		} else {
			echo("Connection Success\n");
		}
	}

	public function query($query){
		$this->query = $query;
	}
        
        public function stmtprepare($stmt){
		$outstmt = $this->conn->prepare($stmt);
		return $outstmt;
	}
        
        public function stmt($stmt){
		$this->stmt = $stmt;
	}

	public function single(){
		$result =  $this->conn->query($this->query);
		$this->query="";
		return json_encode($result->fetch_all()[0],true);
	}

	public function multiple(){
		$result =  $this->conn->query($this->query);
		$this->query="";
		return json_encode($result->fetch_all(),true);
	}

	public function execute(){
		$this->conn->query($this->query);
		$this->query="";
		return "EXECUTED\n";
	}
        
        public function singleprepared(){
		$this->stmt->execute();
		$result = $this->stmt->get_result();
		$this->stmt="";
		return json_encode($result->fetch_all()[0],true);
	}

	public function multipleprepared(){
		$this->stmt->execute();
		$result = $this->stmt->get_result();
		$this->stmt="";
		return json_encode($result->fetch_all(),true);
	}

	public function executeprepared(){
		$this->stmt->execute();
		$this->stmt="";
		return "EXECUTED\n";
	}

	public function close(){
		$this->conn->close();
		return "DISCONNECTED\n";
	}
}
?>
