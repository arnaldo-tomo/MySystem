<?php

	require_once 'config.php';

	class Admin extends Database {

		//Admin Login
		public function admin_login($username,$password){
			$sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['username'=>$username, 'password'=>$password]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}
        
          //Fetch All Registered Users
		public function fetchAllUsers($val){
			$sql = "SELECT * FROM funcionario WHERE apagar != $val";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
	
        }
      //add dados do funcionario no db
    	public function register($name,$email,$password)
		{
			$sql = "INSERT INTO funcionario (nome, email, senha) VALUES (:nome, :email, :senha)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['nome'=>$name, 'email'=>$email, 'senha'=>$password]);
			return true;
		}
        // fim add dados do funcionario no db

        
    //vereficar email se esta registado
		//check if user already registered
		public function user_exist($email){
			$sql = "SELECT email FROM funcionario WHERE email = :email";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
// fim vereficar email se esta registado
        
        
//Fetch User's Details by ID
		public function fetchUserDetailsByID($id){
			$sql = "SELECT * FROM funcionario WHERE id_user = :id_user AND apagar != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id_user'=>$id]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
//fim Fetch User's Details by ID
    
    
    
    //Delete An User
		public function userAction($id, $val){
			$sql = "UPDATE funcionario SET apagar = $val WHERE id_user = :id_user";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id_user'=>$id]);

			return true;
		}
    
    }
   
        ?>