<?php
require_once 'admin-db.php';

$admin = new Admin();
session_start();

//Handle Admin Login Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
	$username = $admin->test_input($_POST['username']);
	$password = $admin->test_input($_POST['password']);

	$hpassword = sha1($password);

	$loggedInAdmin = $admin->admin_login($username, $hpassword);
	if ($loggedInAdmin != null) {
		echo 'admin_login';
		$_SESSION['username'] = $username;
	}
	else {
		echo $admin->showmessage('danger', 'Username or Password is Incorrect!');
	} 

}







?>