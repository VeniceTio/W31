<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp3.local/signin.php');
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
    $login = htmlspecialchars($_POST['login']);
    $pass = htmlspecialchars($_POST['pass']);
    $result = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $result->bindValue(':login',$login,PDO::PARAM_STR);
    $result->execute();

    session_start();
    if (isset($_SESSION['message'])){
        unset($_SESSION['message']);
    }
    if ($result->rowCount()!=0){
        $donne = $result->fetch();
        if (password_verify($pass,$donne['password'])) {
            $_SESSION['login']=$login;
            header('Location: http://tp3.local/welcome.php');
            exit();
        }
        else {
            $_SESSION['message']='Wrong password';
            header('Location: http://tp3.local/signin.php');
        }
    }
    else {
        $_SESSION['message']='Wrong login';
        header('Location: http://tp3.local/signin.php');
    }
}