<?php 

namespace model;

use persistence\Database;
use \PDO;

class Query extends Database{

	private $query;

	public function __construct(){
	    parent::__construct();

	}

	public function __destruct(){
		parent::__destruct();
	}

	public function setQuery(string $query, array $params = array()){
		
		$this->query = $this->connection->prepare($query);
		
		if(!empty($params)){
			foreach ($params as $bind => $param) {
				$this->query->bindParam($bind,$param);
			}
		}
	}

	public function getQuery(){

	}

	public function getResults(){
		return $this->query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function execQuery(bool $bringResults = null){
		$this->query->execute();
	}

}