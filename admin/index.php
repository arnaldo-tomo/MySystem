<?php

	session_start();
	if(isset($_SESSION['username'])){
		header('location:home.php');
		exit();
	}

	include_once 'php/config.php';

?>

<?php 
	require_once '../connect/head.php';
	require_once '../connect/javascrip.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My-System</title>
</head>

<body>
    <div class="form-screen">
        <a href="index.html" class="spur-logo"><i class="fas fa-bolt"></i> <span>Admin</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white text-center"> Cpainel Admin </div>
            <div class="card-body">
               <form action="" method="post" class="px-3" id="admin-login-form">

                    <div id="adminLoginAlert"></div>

                    <div class="form-group">
                        <input type="text" class="form-control " name="username"  placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                   
                    <div class="account-dialog-actions">
                        <button type="submit" name="admin-login" value="Login" id="adminLoginBtn"  class="btn btn-primary">Logar</button>
                        </div>
                    </form>
                       <br>
                    <center>
                <h8>© 2021 Desenvolvido Por <a href="mailto:arnaldotomo@gmail.com">Arnaldo Tomo</a></h8>
                </center>
            </div>
        </div>
    </div>
    
    
    

	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#adminLoginBtn").click(function(e){
				if($("#admin-login-form")[0].checkValidity()){
					e.preventDefault();

					$(this).val('please Wait...');
					$.ajax({
						url: 'php/admin-action.php',
						method: 'post',
						data: $("#admin-login-form").serialize()+'&action=adminLogin',
						success:function(response){
							//console.log(response);
							if(response === 'admin_login'){
								window.location = 'home.php';
							}
							else{
								$("#adminLoginAlert").html(response);
							}
							$("#adminLoginBtn").val('Login');
						}
					});
				}
			});
		});
	</script>
</body>

</html>