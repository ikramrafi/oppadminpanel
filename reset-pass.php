<?php
 require_once 'assets/php/auth.php';
 $user = new Auth();
 $msg = '';

 if (isset($_GET['email']) && isset($_GET['token'])){
    $email = $user->test_input($GET['email']);
 	$token = $user->test_input($GET['token']);

 	$auth_user = $user->reset_pass_auth($email, $token);

 	if ($auth_user != null){
 	    if (isset($_POST['submit']))  {
 	        $newpass = $_POST['pass'];
 	        $cnewpass = $_POST['cpass'];

 	        $hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

 	        if ($newpass == $cnewpass){
 	            $user->update_new_pass($hnewpass,$email);
 	            $msg = 'Password Changed Successfully!<br><a href="index.php">Login Here!</a>';
 	        }
 	        else{
 	            $msg = 'Password did not matched!';
            }
 	    }
 	}
 	else{
 	    header('location:index.php');
 	    exit();
    }	
 }
 else{
 	header('location:index.php');
 	exit();
 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhammad Ikram Rafi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="container">
		<!-- Login Form Start -->
		<div class="row justify-content-center wrapper">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					<div class="card justify-content-center rounded-left myColor p-4">
						<h1 class="text-center font-weight-bold text-white">Reset Your Password Here!</h1>
						
					</div>

					<div class="card rounded-right p-4" style="flex-grow: 2;">
						<h1 class="text-center font-weight-bold text-primary">Enter New Password!</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3">
							<div class="text-center lead my-2"><?= $msg; ?></div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="pass" class="form-control rounded-0" placeholder="New Password" required minlength="5">
							</div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>
								</div>
								<input type="password" name="cpass" class="form-control rounded-0" placeholder="Confirm New Password" required minlength="5">
							</div>
							
							<div class="form-group">
								<input type="submit" value="Reset Password" name="submit" class="btn btn-success btn-lg btn-block myBtn">
							</div>
						</form>
					</div>
					
				</div>				
			</div>
		</div>
		<!-- Login Form End -->
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
</body>
</html>