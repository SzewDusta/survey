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
        else
        {
            echo '<script type="text/javascript">';
            echo ' alert("Dodaj pytanie przed kliknieciem!")'; 
            echo '</script>';
            
        }
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ankieta</title>
        <link rel="stylesheet" href="../assets/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../assets/main.js"></script> 
    </head>
    <body>
    <div class="topnav" id="myTopnav">
        <a href="addQuestion.php" >Dodaj pytanie</a>
        <a href="deleteQuestion.php" >Usuń pytanie</a>
        <a href="showAnswers.php">Pokaz odpowiedzi</a>
        
        <a href="logOut.php">Wyloguj</a>
        <i class="fas fa-sign-out-alt" id="logOut" style="size: 64px;"></i>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        
        
        </a>
    </div>
    <div class="center">
        <h2>Dodaj pytanie</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <textarea name="question"></textarea>
            <input type="submit" name="submit" value="Dodaj pytanie">
        </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>