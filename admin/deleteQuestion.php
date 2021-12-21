<?php

    require '../config.php';
$sql = "SELECT id, question FROM questions";
$result = $con->query($sql);
if(isset($_POST['checkbox'])){
    
        $deleted = array();
        $deleted = $_POST['checkbox'];
        $countDeleted = count($deleted);
        
        
        
        for($i=0;$i<$countDeleted;$i++)
        {    
            
            $del_id=$deleted[$i];
            $int_del_id = (int)$del_id;
            


            $sql2 = $con->prepare("DELETE FROM answers WHERE question_id = ? ");
            $sql2->bind_param("i", $int_del_id);
            $sql2->execute();

            $question = $con->prepare( "DELETE FROM questions WHERE id= ?");
            $question->bind_param("i", $int_del_id);
            $question->execute();
        }
        header("Refresh:0");
            
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
        <script src="https://kit.fontawesome.com/901f0de3f2.js" crossorigin="anonymous"></script>
        <script src="../assets/main.js"></script> 
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
            <input class="btn btn-primary btn-ghost" type="submit" name="submit" value="Usuń zaznaczone pytania" >
            <br>
            <h3>Uwaga, po usunięciu pytania, wszystkie zapisane odpowiedzi na usuwane pytanie zostaną usunięte!</h3>
        </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>