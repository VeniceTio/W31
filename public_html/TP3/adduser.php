<?php
session_start();
if($_SERVER['REQUEST_METHOD'] != 'POST' || empty(htmlspecialchars($_POST['login'])) || empty(htmlspecialchars($_POST['pass'])) || empty(htmlspecialchars($_POST['rpass'])) ){
    $_SESSION['messageInscription']="Fill all the fields";
    header('Location: http://tp3.local/signup.php');
    exit();
}
else {
    include("bdd.php");

    try {
        $pdo = new PDO(SQL_DNS, SQL_USERNAME, SQL_PASSWORD);
    } catch (PDOException $e) {
        header('Location: fail.php');
        exit();
    }
    $login = htmlspecialchars($_POST['login']);
    $pass = htmlspecialchars($_POST['pass']);
    $rpass = htmlspecialchars($_POST['rpass']);
    $result = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $result->bindValue(':login', $login, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount()==0) {
        if($pass == $rpass) {
            $result = $pdo->prepare("INSERT INTO users (login,password) VALUES (:login,:password)");
            $result->bindValue(':login', $login, PDO::PARAM_STR);
            $result->bindValue(':password', sha1($pass), PDO::PARAM_STR);
            $succes = $result->execute();
            if (succes){
                header('Location: http://tp3.local/signin.php');
                exit();
            }
            else {
                $_SESSION['messageInscription']="Request Error";
                header('Location: http://tp3.local/signup.php');
                exit();
            }
        }
        else {
            $_SESSION['messageInscription']="Wrong password";
            if (isset($login)){$_SESSION['loginUp']=$login;}
            header('Location: http://tp3.local/signup.php');
            exit();
        }
    }
    else{
        $_SESSION['messageInscription']="login is used";
        header('Location: http://tp3.local/signup.php');
        exit();
    }
}