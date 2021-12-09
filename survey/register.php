<?php
    require "config.php";
 

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	
	exit('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM user WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		
		echo 'Username exists, please choose another!';
	} else {
		
        if ($stmt = $con->prepare('INSERT INTO user (username, password, email) VALUES (?, ?, ?)')) {
	
	        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	        $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
	        $stmt->execute();
	        //echo 'You have successfully registered, you can now login!';
			header('Location: index.html');
    } else {
	
	        echo 'Could not prepare statement!';
}
        
	}
	$stmt->close();
} else {
	
	echo 'Could not prepare statement!';
}
$con->close();
?>



