<?php 
require_once 'config.php'; 

/**
 * 
 */
class Admin extends Database
{

	// Admin Login
	public function admin_login($username, $password) {
		$sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
 		$stmt = $this->conn->prepare($sql);
 		$stmt->execute(['username'=>$username, 'password'=>$password]);
 		$row = $stmt->fetch(PDO::FETCH_ASSOC);

 		return $row;
	}

	// Count Total number of Rows
	public function totalCount($tablename){
		$sql = "SELECT * FROM $tablename";
 		$stmt = $this->conn->prepare($sql);
 		$stmt->execute();
 		$count = $stmt->rowCount();
 		return $count;
	}

	// Count Total Verified/Unverified Users
	public function verified_users($status){
		$sql = "SELECT * FROM users WHERE verified = :status";
 		$stmt = $this->conn->prepare($sql);
 		$stmt->execute(['status'=>$status]);
 		$count = $stmt->rowCount();
 		return $count;
	}

	// Gender Percentage
	public function genderPer(){
		$sql = "SELECT gender, COUNT(*)";
 		$stmt = $this->conn->prepare($sql);
 		$stmt->execute(['status'=>$status]);
 		$count = $stmt->rowCount();
 		return $count;
	}

}




?>