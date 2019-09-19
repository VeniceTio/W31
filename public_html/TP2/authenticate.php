<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp2.local/signin.php');
}
else{
    include("users.php");
    if(array_key_exists($_POST['login'],$users)){
        if($users[$_POST['login']]==$_POST['pass']){
            session_start();
            $_SESSION['login']=$_POST['login'];
            header('Location: http://tp2.local/welcome.php');
        }
        else{
            header('Location: http://tp2.local/signin.php');
        }
    }
    else{
        header('Location: http://tp2.local/signin.php');
    }
}
