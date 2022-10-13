<?php


class Database{


	//const USERNAME = 'arnaldotomo@gmail.com';
	//const PASSWORD = '28021994';


	private $dns = "mysql:host=localhost;dbname=armazen";
	private $dbuser = "root";
	private $dbpass = "";

	public $conn;

	public function __construct(){
		try{
			$this->conn = new PDO($this->dns,$this->dbuser,$this->dbpass);
			//echo "work";
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
		}

		return $this->conn;
	}

	//check Input
	public function test_input($data){
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
		 return $data;
	}

	//Error Success Messagem Alert

	public function showMessage($type, $messagem){
		return '<div class="alert alert-'.$type.' alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong class="text-center">'.$messagem.'</strong>
				</div>';
	}



}

//$ob = new Database();


?>