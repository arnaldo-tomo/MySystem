<?php  
	
	require_once 'config.php';

	class Auth extends Database{


		//Login Existing User
		public function login($email){
			$sql = "SELECT email, senha FROM  funcionario WHERE email = :email AND apagar !=0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}



		//Current user In Session
		public function currentUser($email){
			$sql = "SELECT * FROM funcionario WHERE email = :email AND apagar !=0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}


		//update profile of an user
		public function update_profile($name,$gender,$dob,$phone,$photo,$id){
			$sql = "UPDATE funcionario SET nome = :nome, genero = :genero, data_nascimento = :data_nascimento, telefone = :telefone, foto = :foto WHERE id_user = :id_user AND apagar != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['nome'=>$name,'genero'=>$gender,'data_nascimento'=>$dob,'telefone'=>$phone,'foto'=>$photo,'id_user'=>$id]);
			return true;
		}
      
//Change password of an user
		public function change_password($pass, $id){
			$sql = "UPDATE funcionario SET senha = :pass WHERE id_user = :id_user AND apagar != 0";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['pass'=>$pass,'id_user'=>$id]);
			return true;
		}
        
     
	}

?>