<?php

	require_once 'session.php';


	//session_start();


	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);


	//handle Add New Note Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'add_note'){
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->add_new_note($cid, $title, $note);
	}

	//Handle Display All Notes Of An User
	if(isset($_POST['action']) && $_POST['action'] == 'display_notes'){
		$output = '';

		$notes = $cuser->get_notes($cid);

		if($notes){
			$output .= '<table class="table table-striped text-center">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Note</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
					foreach ($notes as $row) {
						$output .= '<tr>
								<td>'.$row['id'].'</td>
								<td>'.$row['title'].'</td>
								<td>'.substr($row['note'], 0, 75).'...</td>
								<td>
									<a href="#" id="'.$row['id'].'" title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;

									<a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNodeModal"></i></a>&nbsp;

									<a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
								</td>
							</tr>';
					}
				$output .= '</tbody></table>';
				echo $output;
		}
		else{
			echo '<h3 class="text-center text-secondary">:( You have not writen note yet! Wrire your first note now!</h3>';
		}

		//print_r($notes);
	}

	//Handle Edit Note of An User Ajax
	if(isset($_POST['edit_id'])){
		//print_r($_POST);
		$id = $_POST['edit_id'];

		$row = $cuser->edit_note($id);
		echo json_encode($row);

	}

	//Handle Update Note of An User Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
		//print_r($_POST);
		$id = $cuser->test_input($_POST['id']);
		$title = $cuser->test_input($_POST['title']);
		$note = $cuser->test_input($_POST['note']);

		$cuser->update_note($id,$title,$note);
	}

	//Handle Delete a Note of An User Ajax Request
	if(isset($_POST['del_id'])){
		$id = $_POST['del_id'];

		$cuser->delete_note($id);
	}

	//Handle Display a Note of An User Ajax Request
	if(isset($_POST['info_id'])){
		$id = $_POST['info_id'];


		$row = $cuser->edit_note($id);

		echo json_encode($row);
	}

		//Handle profile update Ajax Request
	if(isset($_FILES['foto_user'])){
		//print_r($_FILES);
		//print_r($_POST);
		$name = $cuser->test_input($_POST['name']);
		$gender = $cuser->test_input($_POST['gender']);
		$dob = $cuser->test_input($_POST['dob']);
		$phone = $cuser->test_input($_POST['phone']);

		$oldImage = $_POST['oldimage'];
		$folder = 'uploads/';

		if(isset($_FILES['foto_user']['name']) && ($_FILES['foto_user']['name'] != "")){
			$newImage = $folder.$_FILES['foto_user']['name'];
			move_uploaded_file($_FILES['foto_user']['tmp_name'], $newImage);
		
		}
		else{
			$newImage = $oldImage;
		}
		$cuser->update_profile($name, $gender, $dob, $phone,$newImage, $cid);
	}


	//handle change password ajax request
	if(isset($_POST['action']) && $_POST['action'] == 'change_pass'){
		//print_r($_POST);
		$currentPass = $_POST['curpass'];
		$newPass = $_POST['newpass'];
		$cnewPass = $_POST['cnewpass'];

		$hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

		if($newPass != $cnewPass){
			echo $cuser->showMessage('danger','Password did not matched!');
		}
		else{
			if(password_verify($currentPass, $cpass)){
				$cuser->change_password($hnewPass,$cid);
				echo $cuser->showMessage('success','Password Changed Successfully');
			}
			else{
				echo $cuser->showMessage('danger','Current Password is Wrong!');
			}
		}
	}

	//handle verify e-mail ajax request
	if(isset($_POST['action']) && $_POST['action'] == 'verify_email'){

		try{
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = Database::USERNAME;
				$mail->Password = Database::PASSWORD;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom(Database::USERNAME,'Marcelino');
				$mail->addAddress($cemail);

				$mail->isHTML(true);
				$mail->Subject = 'E-mail Verification';
				$mail->Body = '<h3>Click the below link to verify your E-mail.<br><a href="http://localhost/Ebeneze/verify-email.php?email='.$cemail.'">"http://localhost/Ebeneze/verify-email.php?email='.$cemail.'</a><br>Regards<br>Marcelino!</h3>';

				$mail->send();
				echo $cuser->showMessage('success','Verification link sent to your E-mail. Please check your E-mail!');
			}
			catch(Exception $e){
				echo $cuser->showMessage('danger','Something went wrong please try again later!');
			}

	}


?>