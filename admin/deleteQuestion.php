<?php

    require '../config.php';
$sql = "SELECT id, question FROM questions";
$result = $con->query($sql);
if(isset($_POST['checkbox'])){
    
        $deleted = array();
        $deleted = $_POST['checkbox'];
        $sql2 = "DELETE FROM answers ";
        $destroy = $con->query($sql2);
        
        for($i=0;$i<count($deleted);$i++)
        {    
            $del_id=$deleted[$i];
            $int_del_id = (int)$del_id;
            $question = $con->prepare( "DELETE FROM questions WHERE id= ?");
            $question->bind_param("i", $int_del_id);
            $question->execute();
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
    <div class="center" >
        <h2>Usuń pytanie</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <?php
            $i=0;
            if($result->num_rows>0){
                while($row = $result->fetch_assoc())
                {
                    
                    $i++;
                    echo "<p> Pytanie ".$i.": ".$row['question']."<input type='checkbox' name='checkbox[]' value=".$row['id']." >";
                    
                }
            }
            else {
                echo "brak pytań";
            }
            
            ?>
            <br>
            <br>
            <input type="submit" name="submit" value="Usuń zaznaczone pytania">
            <br>
            <h3>Uwaga, po usunięciu pytania, wszystkie zapisane odpowiedzi zostaną usunięte!</h3>
        </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>