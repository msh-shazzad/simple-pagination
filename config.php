<?php 
	class Database { 
		public $hostname='localhost'; 
		public $username='root'; 
		public $password=''; 
		public $dbname='for_test';
		public $conn; 

			function __construct(){
				try
 					{
 						$this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname",$this->username,$this->password);
 					}

 				catch(PDOException $e)
 					{
 						echo $e->getmessage();
 					}
			}


} ?> 