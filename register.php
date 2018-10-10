<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('connect.php');
if (isset($_REQUEST['username'])){
	$name = stripslashes($_REQUEST['name']);
	$name = mysqli_real_escape_string($con,$name);
	$surname = stripslashes($_REQUEST['surname']);
	$surname = mysqli_real_escape_string($con,$surname);
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$phonenum = stripslashes($_REQUEST['phonenum']);
	$phonenum = mysqli_real_escape_string($con,$phonenum);
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username); 
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$usernameCheck = "SELECT * FROM user_data WHERE username = '$username'";
	$emailCheck = "SELECT * FROM user_data WHERE email = '$email'";
	$usernameCheckResult = mysqli_query($con, $usernameCheck);
	$emailCheckResult = mysqli_query($con, $emailCheck);
	}if(mysqli_num_rows($usernameCheckResult) > 0){
		echo "Username allready in use.";
    }else if(mysqli_num_rows($emailCheckResult) > 0){
		echo "Email allready in use.";
	}else{
	$passhash = password_hash($password, PASSWORD_DEFAULT);
	$query = "INSERT into 'user_data' (name, surname, email, phonenum, username, password)
	VALUES ('$name', '$surname', '$email', '$phonenum', '$username', '$passhash')";
        $result = mysqli_query($con,$query);
        if($result){
			echo "RESULT EXECUTED!";
            echo "<div class='form'>
			<h3>You are registered successfully.</h3>
			<br/>Click here to <a href='login.php'>Login</a></div>";
        }else{
			echo "<div class='form'>
				<h1>Registration</h1>
				<form name='registration' action='' method='post'>
				<input type='text' name='name' placeholder='Name' required />
				<input type='text' name='surname' placeholder='Surname' required />
				<input type='email' name='email' placeholder='Email' required />
				<input type='text' name='phonenum' placeholder='Phone' required />
				<input type='text' name='username' placeholder='Username' required />
				<input type='password' name='password' placeholder='Password' required />
				<input type='submit' name='submit' value='Register' />
				</form>
				</div>";
		 }
	}
?>
</body>
</html>