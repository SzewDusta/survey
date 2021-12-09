
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

    $sql = "SELECT question FROM questions;";
    $result = $con->query($sql);
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
        <a href="index.html" >Logowanie</a>
        <a href="register.html">Rejestracja</a>
        <a href="about.html">O ankiecie</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="center">
    <?php while($row = $result->fetch_assoc()): 
        var_dump($row);
        endwhile?>
    </div>


    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>