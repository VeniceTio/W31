<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp2.local/signin.php');
}
else{
    include("users.php");
    session_start();
    if(array_key_exists($_POST['login'],$users)){
        if($users[$_POST['login']]==$_POST['pass']){
            $_SESSION['login']=$_POST['login'];
            header('Location: http://w31.local/TP2/welcome.php');
        }
        else{
            $_SESSION['message']='Wrong password';
            header('Location: http://w31.local/TP2/signin.php');
        }
    }
    else{
        $_SESSION['message']='Wrong login';
        header('Location: http://w31.local/TP2/signin.php');
    }
}