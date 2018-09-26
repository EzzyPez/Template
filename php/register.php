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
        $passhash = password_hash($password, PASSWORD_BCRYPT);
        
        $datacheck = "SELECT * FROM user_data WHERE (username = '$username' OR email = '$email');";
        $datacheckres = mysqli_query($con,$datacheck);

        if(mysqli_num_rows($datacheckres) > 0){
            echo "dicks";
            $row = mysqli_fetch_assoc($datacheckres);
            if($username == $row['username']){
                echo "Username allready exists.";
            }
            else{
                echo "E-mail allready registered.";
            }
        }else{
            $query = "INSERT INTO user_data (name, surname, email, phonenum, username, password) VALUES ('$name', '$surname', '$email', '$phonenum', '$username', '$passhash')";
            $result = mysqli_query($con,$query);
            if($result){
                echo "<div class='form'>
                <h3>You are registered successfully.</h3>
                <br/>Click here to <a href='../login.html'>Login</a></div>";
            }else{
                echo "DOESENT WORK BUDDY";
                //create an actual method....
            }
        }
    }
?>