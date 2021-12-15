<?php

    require "config.php";
    session_set_cookie_params(0);
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: index.html');
        exit;
    }
    
    $sql = "SELECT question,id FROM questions";
    // $sqlIns = "INSERT INTO answers (answer)
    // VALUES ('') ";
    $result = $con->query($sql);
   // print_r($result->fetch_assoc());

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ankieta</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="assets/main.js"></script> 
    </head>
    <body>
    <div class="topnav" id="myTopnav">
        <a href="survey.php" >Ankieta</a>
        <a href="index.html" >Logowanie</a>
        <a href="register.html">Rejestracja</a>
        <a href="about.html">O ankiecie</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="center">
    <form action="save.php" method="POST">
    <?php 
    //for($i = 1; $i<=$result2; $i++){
        // $row = $result->fetch_assoc();
        // echo($row['question']);
        $num_rows = $result->num_rows;
        $user_ide = $_SESSION['id'];
        $answers = $con->prepare( "SELECT id FROM answers WHERE user_id = ? ");
        $answers->bind_param("i", $user_ide);
        $answers->execute();
        $result3 = $answers->get_result();
        $row2 = $result3->fetch_assoc();
        $nums = $num_rows;
        

        if($row2 == null){
            $data = [];
        if ($num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
               // echo($row['question']);
                echo "<h3>".$row['question']."</h3>";
                echo '<label>Twoja Odpowiedź: </label> <textarea name="answerToQuestion['.$row['id'].']" required></textarea> <input type="hidden" name="questionId['.$row['id'].']" value="'.$row['id'].'">';
               
        }
    }
}       
        else{
            echo "<h2> Odpowiedzi zostały już udzielone ! </h2>";
            
           header('Location: surveyDone.html');
            
            }
        
       ?>
       <br>
       <br>
       <label>Wyślij odpowiedzi: </label> <input type="submit" name="submit" value="Wyślij odpowiedź">
        </form>
       
    </div>


    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>