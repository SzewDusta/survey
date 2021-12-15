<?php
require "config.php";
session_set_cookie_params(0);
session_start();


if ( !isset($_POST['username'], $_POST['password']) ) {
	
	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password FROM user WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['logged'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            if($_POST['username'] == 'admin'){
                
                header('Location: admin/admin.html');
            }
            else{  
                header('Location: survey.php');
            }
           //session_destroy();
        } else {
           
            echo 'Incorrect username and/or password!';
        }
    } else {
       
        echo 'Incorrect username and/or password!';
    }

	$stmt->close();
}
?>
