<?php 

namespace persistence;

use \PDO as PDO;
use Symfony\Component\Dotenv\Dotenv;


class Database{
	
	protected $connection;

	public static function getEnvVariables(){
	    $dotenv = new Dotenv();
	    $dotenv->load($_SERVER['DOCUMENT_ROOT'].'/DBCONNECTION.env');
    }


	protected function __construct(){
	    Database::getEnvVariables();
	    $host = getenv("DBHOST");
	    $dbname = getenv("DBNAME");
	    $dbuser = getenv("DBUSER");
	    $dbpassword = getenv("DBPASSWORD");
	    $dsn = "mysql:host=${host};dbname=${dbname}";
	    try{
            $this->connection = new PDO($dsn,$dbuser,$dbpassword,[
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
        }catch (\PDOException $e){
	        throw new \PDOException($e->getMessage());
        }
	}


	protected function __destruct(){
		$this->connection = null;
	}
}