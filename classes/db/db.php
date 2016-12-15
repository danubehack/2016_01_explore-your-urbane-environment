<?php
class DB{
	
	private $pdo;
	
	function connect(){	
	$this->pdo = new PDO("pgsql:host=XXX".";dbname=XXX", "user1", "XXX");
	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$this->pdo->beginTransaction();
	}
	
	function disconnect(){	
	$this->pdo = null;
	
	}
	
	function quote($string){ // useless
		
		return $this->pdo->quote($string);
		
	}
	
	function prepare($statement){
		
		return $this->pdo->prepare($statement);
	}
	
}

?>