<?php
session_start();
if (!isset($_SESSION['login']) && $_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp4.local/signin.php');
}
else{
    include("models/User.php");
    $login = htmlspecialchars($_SESSION['login']);
    $user = new User($login,htmlspecialchars($_POST['pass']));

    try {
        $result = $user->changePassword(sha1(htmlspecialchars($_POST['rpass'])));
    }
    catch (Exception $e){
        header('Location: fail.php');
        exit();
    }
    if ($result){
        $_SESSION['message'] = "The password has been changed";
        header('Location: http://tp4.local/welcome.php');
        exit();
    }
    else {
        $_SESSION['message'] = "Error try again";
        header('Location: http://tp4.local/formpassword.php');
        exit();
    }
    /**
    include("models/bdd.php");

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
    if($result->rowCount()!=0) {
        $_SESSION['message'] = "The password has been changed";
        header('Location: http://tp4.local/welcome.php');
        exit();
    }
    else{
        $_SESSION['message'] = "Error try again";
        header('Location: http://tp4.local/formpassword.php');
        exit();
    }**/
}
