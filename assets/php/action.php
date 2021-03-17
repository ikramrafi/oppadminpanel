<?php

  session_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  //Load Composer's autoloader
  require 'vendor/autoload.php';

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);  

  require_once 'auth.php';
  $user = new Auth();

//Handle Register Ajax Request
 if (isset($_POST['action']) && $_POST['action'] == 'register') {
 	$name = $user->test_input($_POST['name']);
 	$email = $user->test_input($_POST['email']);
 	$pass = $user->test_input($_POST['password']);

 	$hpass = password_hash($pass, PASSWORD_DEFAULT);

 	//this method will check if the user is already registered this email or not
 	if ($user->user_exist($email)) {
 		echo $user->showMessage('warning', 'This E-mail is already registered!');
 	}
 	else{
 		if ($user->register($name,$email,$hpass)) {
 			echo 'register';
 			$_SESSION['user'] = $email;

      $mail->isSMTP();          
      $mail->Host       = "smtp.gmail.com";  
      $mail->SMTPAuth   = true;  
      $mail->Username   = DATABASE::USERNAME; 
      $mail->Password   = DATABASE::PASSWORD;   
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
      $mail->Port       = 587; 

      //Recipients
      $mail->setFrom(Database::USERNAME,'MUHAMMAD IKRAM RAFI');
      $mail->addAddress($cemail);     //Add a recipient
    
      //Content
      $mail->isHTML(true);  
      $mail->Subject = 'Email Verification';
      $mail->Body    = '<h3>Click the below link to verify your E-mail.<br> <a href="http://localhost/user_system/verify-email.php?email='.$cemail.'">http://localhost/user_system/verify-email.php?email='.$cemail.'</a><br>Regards<br>Muhammad Ikram Rafi</h3>';

      $mail->send();
 		}
 		else{
 			echo $user->showMessage('danger', 'Something went wrong! try again later!');
 		}
 	}
 }

//Handle Register Ajax Request
 if (isset($_POST['action']) && $_POST['action'] == 'login'){
 	$email = $user->test_input($_POST['email']);
 	$pass = $user->test_input($_POST['password']);

 	$loggedInUser = $user->login($email);

 	if ($loggedInUser != null) {
 		if (password_verify($pass, $loggedInUser['password'])) {
 			if (!empty($_POST['rem'])) {
 				setcookie("email", $email, time()+(30*24*60*60), '/');
 				setcookie("password", $pass, time()+(30*24*60*60), '/');
 			}
 			else{
 				setcookie("email","",1, '/');
 				setcookie("password","",1, '/');
 			}

 			echo 'login';
 			$_SESSION['user'] = $email;
 		}
 		else{
 			echo $user->showMessage('danger', 'Password is incorrect!');
 		}
 	}
 	else{
 			echo $user->showMessage('danger', 'User not found!');
 		}

 }


//Handle Forgot Password Ajax Request
 if (isset($_POST['action']) && $_POST['action'] == 'forgot'){
 	$email = $user->test_input($_POST['email']);

 	$user_found = $user->currentUser($email);

 	if ($user_found != null) {
 		$token = uniqid();  //uniqid will generate some unique alpha numeric characters
 		$token = str_shuffle($token); //when page refresh str_shuffle function will shuffle all unique ids

 		$user->forgot_password($token,$email);

 		//php mailer libaray to send email
 		try {
            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            // $mail->isSMTP();          
            $mail->SMTPDebug = 2;
            $mail->Host       = "smtp.gmail.com";  
            $mail->SMTPAuth   = true;  
            $mail->Username   = DATABASE::USERNAME; 
            $mail->Password   = DATABASE::PASSWORD;   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port       = 587; 

            //Recipients
            $mail->setFrom(Database::USERNAME,'MUHAMMAD IKRAM RAFI');
            $mail->addAddress($email);     //Add a recipient
    
            //Content
            $mail->isHTML(true);  
            $mail->Subject = 'Reset Password';
            $mail->Body    = '<h3>Click the below link to reset your password.<br> <a href="http://localhost/user_system/reset-pass.php?email='.$email.'&token='.$token.'">http://localhost/user_system/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>Muhammad Ikram Rafi</h3>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo $user->showMessage('success','We have send you the reset link in your email ID, Please check your E-mail!');
        }
        catch (Exception $e) {
        	echo $user->showMessage('danger','Something went wrong please try again later!'); 
        }
    }
    else{
        echo $user->showMessage('info','This email is not registered!');
    }

 	
 }




?>