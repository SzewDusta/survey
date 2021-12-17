<?php
    require '../config.php';
$sql = "SELECT id, username FROM user";
$result = $con->query($sql);
if(isset($_POST['checkbox']))
{
    $deleted = array();
    $deleted = $_POST['checkbox'];
    for($i=0;$i<count($deleted);$i++)
    {
        
        
        $del_id=$deleted[$i];
        $int_del_id = (int)$del_id;
        
        $destroy = $con->prepare("DELETE FROM answers WHERE user_id =? ");
        $destroy->bind_param("i", $int_del_id);
        $destroy->execute();
        $users = $con->prepare( "DELETE FROM user WHERE id =? ");
        $users->bind_param("i", $int_del_id);
        $users->execute();
        
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
        <i class="fa fa-bars"></i></a>
    </div>
    <div class="center">
        <h2>Usuń użytkownika</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
       <?php while($row = $result->fetch_assoc())
       {
           echo $row['username']."<input type='checkbox' name = 'checkbox[]' value=".$row['id']."><br>";
       }
       ?>
       <br>
       <input class="btn btn-primary btn-ghost" type="submit" name="submit" value="Usuń zaznaczonych użytkowników (kliknij 2 razy)">
        </form>
    </div>
    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>
</html>