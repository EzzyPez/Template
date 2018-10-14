<?php
require('connect.php');
session_start();

if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);	

	$pass_query = "SELECT password FROM `user_data` WHERE username = '$username';";
	$hash_query = mysqli_query($con, $pass_query);
	$result = "";

    	if(mysqli_num_rows($hash_query) > 0){
		while($row = mysqli_fetch_assoc($hash_query)){
			$result = $result . $row["password"];
	    	}
    	}	    				
	if(password_verify($password, $result)){
		if(password_needs_rehash($result, PASSWORD_DEFAULT)){
			$new_hash = password_hash($password, PASSWORD_DEFAULT);
			$new_hash_query = mysqli_query("UPDATE `user_data` SET password = '$new_hash' WHERE username = '$username';");
		}
		$_SESSION['username'] = $username;
		//============================================================================
		header("Location: ../dashboard.php");  
		//============================================================================    		
	}else{
		echo "<div class='form'>
		<h3>Username/password is incorrect.</h3>
		<br/>Click here to <a href='../login.html'>Login</a></div>";
	}
}
?>