<?php

    

    require '../config.php';
    if(isset($_POST['question']))
    {
        if(!empty($_POST['question']))
        {

        $question = $_POST['question'];
        $stmt = $con->prepare("INSERT INTO questions (question) VALUES (?)");
        $stmt->bind_param("s", $question );
        $stmt->execute();
        }
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ankieta</title>
        <link rel="stylesheet" href="../assets/main.css">
        <link rel="icon" href="../assets/call-center.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../assets/main.js"></script> 
        <script src="https://kit.fontawesome.com/901f0de3f2.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="topnav" id="myTopnav">
        <a href="addQuestion.php" >Dodaj pytanie</a>
        <a href="deleteQuestion.php" >Usuń pytanie</a>
        <a href="showAnswers.php">Pokaż odpowiedzi</a>
        <a href="deleteUser.php">Usuń użytkownika</a>
        
        <a href="logOut.php">
        <i class="fas fa-sign-out-alt" id = "logOut"></i> </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        
        
        </a>
    </div>
    <div class="center">
        <h2>Dodaj pytanie</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <textarea name="question" required></textarea><br><br>
            <input class="btn btn-primary btn-ghost" type="submit" name="submit" value="Dodaj pytanie">
        </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>