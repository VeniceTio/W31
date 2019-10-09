<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp2.local/signin.php');
}
else{
    include("users.php");
    session_start();
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['pass']);
    if(array_key_exists($login,$users)){
        if($users[$login]==sha1($password)){
            $_SESSION['login']=$login;
            header('Location: http://tp2.local/welcome.php');
        }
        else{
            $_SESSION['message']='Wrong password';
            header('Location: http://tp2.local/signin.php');
        }
    }
    else{
        $_SESSION['message']='Wrong login';
        header('Location: http://tp2.local/signin.php');
    }
}