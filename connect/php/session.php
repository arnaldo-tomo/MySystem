<?php

	session_start();
	require_once 'auth.php';
	$cuser = new Auth();

	if(!isset($_SESSION['user'])){
		header('location:index.php');
		die;
	}


	$cemail = $_SESSION['user'];

	$data = $cuser->currentUser($cemail);

	$cid = $data['id_user'];
	$cname = $data['nome'];
	$cpass = $data['senha'];
	$cphone = $data['telefone'];
	$cgender = $data['genero'];
	$cdob = $data['data_nascimento'];
	$cphoto = $data['foto'];
	$created = $data['criado_em'];

	$reg_on = date('d M Y', strtotime($created));

	$verified = $data['verficado'];

	$fname = strtok($cname, " ");


	if($verified == 0){
		$verified = 'Not verified!';
	}
	else{
		$verified = 'verified!';
	}

?>