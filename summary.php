<?php
require 'config.php';
session_set_cookie_params(0);
session_start();
$sql = "SELECT id, question FROM questions";
$result = $con->query($sql);


$num_rows = $result->num_rows;


$data =[];

if ($num_rows > 0) {
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $i++;
       // echo($row['question']);
        //echo "<p>".$row['question']."</p>";
        //echo '<label>Twoja Odpowiedź: </label> <textarea name="answerToQuestion['.$row['id'].']"></textarea> <input type="hidden" name="questionId['.$row['id'].']" value="'.$row['id'].'">';
        //$sql2 = "SELECT user_id, answer, question_id FROM answers;";
        
        $stmt = $con->prepare("SELECT user_id, answer, question_id FROM answers WHERE user_id = ? AND question_id=?");
        $question_id=$row['id'];
        $user_id = $_SESSION['id'];
        
        $stmt->bind_param('ii', $user_id, $question_id);
        $stmt->execute();
   
        $result2 = $stmt->get_result(); // get the mysqli result
        $answer = $result2->fetch_assoc();
      
        $data[$question_id] = ["answer"=> $answer['answer'], 'question'=>$row['question']];
    }
}

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
        <a href="survey.php">Ankieta</a>
        <a href="index.html">Logowanie</a>
        <a href="register.html">Rejestracja</a>
        <a href="about.html">O ankiecie</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="center">
            <h3>Dziękujemy za wypełnienie ankiety, twoje odpowiedzi:</h3>
            <ul style="list-style-type:none">
                <?php
                $i = 0;
                 foreach($data as $data){
                     $i++;
                     
                    echo "<li><p>Pytanie ".$i.": ".$data['answer'] ."</p></li>";
                    echo "<br>";
                   // echo($data['answer']);
                    
               }
                
                ?>
            </ul>
    </div>


    <div class="bottom">
        <footer>
          Copyright by Filip Sęk ©
        </footer>
    </div>
    </body>


</html>