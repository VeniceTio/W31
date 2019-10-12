<?php
session_start();
if (!isset($_SESSION['login']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp4.local/signin.php');
}
else{
    include("bdd.php");

    try {
        $pdo = new PDO(SQL_DNS,SQL_USERNAME,SQL_PASSWORD);
    }
    catch(PDOException $e){
        header('Location: fail.php');
        exit();
    }
    $login = htmlspecialchars($_SESSION['login']);
    $pass = htmlspecialchars($_POST['pass']);
    $result = $pdo->prepare("UPDATE users set password = :password WHERE login = :login");
    $result->bindValue(':login',$login,PDO::PARAM_STR);
    $result->bindValue(':password',sha1($pass),PDO::PARAM_STR);
    $result->execute();
    var_dump($result);
}
