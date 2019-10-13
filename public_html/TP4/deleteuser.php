<?php
session_start();
if (!isset($_SESSION['login'])){
    header('Location: http://tp4.local/signin.php');
    exit();
}
else {
    include("models/bdd.php");

    try {
        $pdo = new PDO(SQL_DNS, SQL_USERNAME, SQL_PASSWORD);
    } catch (PDOException $e) {
        header('Location: fail.php');
        exit();
    }
    $login = htmlspecialchars($_SESSION['login']);
    $result = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $result->bindValue(':login', $login, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount()==1) {
            $result = $pdo->prepare("DELETE FROM users WHERE login = :login");
            $result->bindValue(':login', $login, PDO::PARAM_STR);
            $succes = $result->execute();
            if ($succes){
                session_destroy();
                header('Location: http://tp4.local/signin.php');
                exit();
            }
            else {
                $_SESSION['message']="Error can't delete this acount";
                header('Location: http://tp4.local/welcome.php');
                exit();
            }
    }
    else{
        $_SESSION['message']="Error can't delete this acount";
        header('Location: http://tp4.local/welcome.php');
        exit();
    }
}