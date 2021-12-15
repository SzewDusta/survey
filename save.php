<?php

require "config.php";
    session_set_cookie_params(0);
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location: index.html');
        exit;
    }
    var_dump($_POST);
    $save = false;
    foreach($_POST["answerToQuestion"] as $key => $answer) {
        try {
        
            var_dump($answer);
            $stmt = $con->prepare("INSERT INTO answers (user_id, answer, question_id) VALUES (?,?,?)");
            $id_user = $_SESSION['id'];
            
            $questionId = $key;
            $questionAnswer = $answer;
            $stmt->bind_param('isi', $id_user, $questionAnswer, $questionId);
            
            $save = $stmt->execute();
     
        } catch (Exception $e){
            echo($e->getMessage());
        }
            
    }
    if($save==true){
        header('Location: summary.php');
    }

    try {
        
        
     
    } catch (Exception $e){
        echo($e->getMessage());
    }

    // //$sql = "INSERT INTO answers (user_id, answer, question_id) VALUES ({$_SESSION['id']},'asjkhdkasd', 1 ) ";
    // $stmt = $con->prepare("INSERT INTO answers (user_id, answer, question_id) VALUES (?,?, ? ) ");
    // $id_user = $_SESSION['id'];
    // $stmt->bind_param('isi', $id_user, 'sadfaf', 1);
    // $stmt->execute();
    
?>