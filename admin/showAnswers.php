<?php
    require "../config.php";
    
    
    $sql = "SELECT id, username FROM user";
    $result = $con->query($sql);
    if(isset($_POST['submit']))
    {
        
        $answersSql = $con->prepare( "SELECT id, user_id, answer FROM answers WHERE user_id = ? ");
        $user_id = $_POST['user'];
        $answersSql->bind_param("i", $user_id);
        $answersSql->execute();
        $result2 = $answersSql->get_result();

        $sql = "SELECT question, id FROM questions";
        $result3 = $con->query($sql);
       // $answers = $result2->fetch_assoc(); -> tak być nie moze
        //var_dump($answers);
       
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
       <h2>Wybierz użytkownika</h2>
       <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <select name="user"  >
            <?php while($row = $result->fetch_assoc()){ ?>
                <option value="<?=$row['id']?>"> <?=$row['username']?></option>    
            <?php } ?>
            </select>
            
        <input class="btn btn-primary btn-ghost" type="submit" name="submit" value="Pokaz odpowiedzi">
            <ul style="list-style-type:none;">
                <?php
                if(isset($_POST['submit'])){
                    if($result2->num_rows>0){
                        $i = 0;
                        
                        while($row = $result2->fetch_assoc())
                        {
                         
                           $row2 = $result3->fetch_assoc();
                            echo "<li><p>".$row2['question']."=>".$row['answer']."</p></li>";
                            
                            
                        }
                    }
                    else
                    {
                        echo "<p> Ten użytkownik nie odpowiedział na pytania </p>";
                    }
                }
                
                ?>
            </ul>
    </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>