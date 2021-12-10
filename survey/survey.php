
<?php

    /**
     * TODO DODANIE PYTAŃ DO BAZY DANYCH
     * UTWORZENIE PANELU ADMINA GDZIE BEDZIE MOZNA DODAWAC PYTANIA
     * ZROBIC MECHANIKE WYKRYWANIA CZY PYTANIE JEST ZAMKNIETE CZY OTWARTE
     * REFRAKTORYZACJA KODU, OPISANIE FUNKCJI
     */



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

   
    
/*
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["email"] . "<br>";
        }
    }
*/

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

        $data = [];
        if ($num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
               // echo($row['question']);
                echo "<p>".$row['question']."</p>";
                echo '<label>Twoja Odpowiedź: </label> <textarea name="answerToQuestion['.$row['id'].']"></textarea> <input type="hidden" name="questionId['.$row['id'].']" value="'.$row['id'].'">';
            }
        }
       //print_r($row);
    //}
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