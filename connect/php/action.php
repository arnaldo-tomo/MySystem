<?php

	session_start();


	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);



	require_once 'auth.php';
	$user = new Auth();

	//Handle Register Ajax Request Start
	if(isset($_POST['action']) && $_POST['action'] == 'register'){
		//print_r($_POST);
		$name = $user->test_input($_POST['name']);
		$email = $user->test_input($_POST['email']);
		$pass = $user->test_input($_POST['password']);

		$hpass = password_hash($pass, PASSWORD_DEFAULT);

		if($user->user_exist($email)){
			echo $user->showMessage('warning','This E-mail is already registered!');
		} 
		else{
			if($user->register($name,$email,$hpass)){
				echo 'register';
				$_SESSION["user"] = $email;
			} 
			else{
				echo $user->showMessage('danger','Something went wrong! try again later!');
			}
		}
	}

	//Handle Register Ajax Request End


	//Handle Login Ajax Request Start
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		$email = $user->test_input($_POST['email']);
		$pass = $user->test_input($_POST['senha']);

		$loggedInUser = $user->login($email);

		if ($loggedInUser != null) {
			if(password_verify($pass, $loggedInUser['senha'])){
				if(!empty($_POST['rem'])){
					setcookie("email", $email, time()+(30*24*60*60), '/');
					setcookie("senha", $pass, time()+(30*24*60*60), '/');
				}
				else{
					setcookie("email","",1,'/');
					setcookie("senha","",1,'/');
				}

				echo 'login';
				$_SESSION['user'] = $email;
			}
			else{
				echo $user->showMessage('danger','Senha ERRADA!');
			}
		}
		else{
			echo $user->showMessage('danger','Usuario Nao Encontrado!');
		}
	}

		//Handle Login Ajax Request End

		//Handle Forgot Password Ajax Request Start

	if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
		$email = $user->test_input($_POST['email']);

		$user_found = $user->currentUser($email);

		if($user_found != null){
			$token = uniqid();
			$token = str_shuffle($token);

			$user->forgot_password($token,$email);

			try{
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = Database::USERNAME;
				$mail->Password = Database::PASSWORD;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom(Database::USERNAME,'Marcelino');
				$mail->addAddress($email);

				$mail->isHTML(true);
				$mail->Subject = 'Reset Password';
				$mail->Body = '<h3>Click the below link to reset your password.<br><a href="http://localhost/user_system/reset-pass.php?email='.$email.'&token='.$token.'">http://localhost/user_system/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>Marcelino!</h3>';

				$mail->send();
				echo $user->showMessage('success','We hava send you the reset link in your e-mail ID, please check your email!');
			}
			catch(Exception $e){
				echo $user->showMessage('danger','Something went wrong please try again later!');
			}
		}
		else{
			echo $user->showMessage('info','This e-mail is not registered!');
		}
	}

		//Handle Forgot Password Ajax Request End


	//checking user is logged in or not
	if(isset($_POST['action']) && $_POST['action'] == 'checkUser'){
		if(!$user->currentUser($_SESSION['user'])){
			echo 'bye';
			unset($_SESSION['user']);
		}
	}

?>