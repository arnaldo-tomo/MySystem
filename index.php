<?php 
	session_start();
	if(isset($_SESSION['user'])){
		header('location:home.php');
	}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="estilo/fontawesome-free/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="estilo/css/spur.css">
    <script src="estilo/chart.js/Chart.bundle.min.js"></script>
    <script src="estilo/js/chart-js-config.js"></script>
    <title>Thomo-System</title>
</head>

<body>
    <div class="form-screen">
        <a href="index.php" class="spur-logo"><i class="fas fa-bolt"></i> <span>Usuario</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-dark text-white"> Entre Com As suas Credencias </div>
            <div class="card-body">
                <form action="#" method="POST" class="px-3" id="login-form" id="forgot-box">
				<div id="loginAlert"></div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email"required value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email']; } ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Password" required value="<?php if(isset($_COOKIE['senha'])) {echo $_COOKIE['senha']; } ?>">
                    </div>
                    <div class="account-dialog-actions">
                        <button input type="submit" value ="Sing In" id="login-btn"  class="btn btn-dark">Logar</button>
                        </div>
                </form>
            </div>
        </div>
        <h5 > zbxclzx.cvjzllzl</h5>
    </div>
    
    <script src="estilo/sweetalert2/sweetalert2@8"></script>
    <script type="text/javascript" src="estilo/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="estilo/jquery/jquery-3.3.1.slim.min.js" ></script>
    <script type="text/javascript" src="estilo/jquery/jquery.min.js" ></script>
    <script type="text/javascript" src="estilo/popper/popper.min.js"></script>
    <script type="text/javascript" src="estilo/bootstrap/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="estilo/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script type="text/javascript" src="estilo/js/spur.js"></script>
</body>

</html>
<script>
	$(document).ready(function(){
			//login Ajax Request
			$("#login-btn").click(function(e){
				if($("#login-form")[0].checkValidity()){
					e.preventDefault();
					$("#login-btn").val('aguarde...');
					$.ajax({
						url: "connect/php/action.php",
						method: "POST",
						data: $("#login-form").serialize()+"&action=login",
						success:function(response){
							//console.log(response);
							$("#login-btn").val('Sign In');
							if(response === 'login'){
								window.location = 'home.php';
							}
							else{
								$("#loginAlert").html(response);
							}
						}
					});
				}
			});

		});
</script>