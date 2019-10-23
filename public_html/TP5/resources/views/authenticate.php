<?php
/**if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: http://tp5.local/signin.php');
}**/
//else{
    session_start();
    include("models/User.php");
    $login = htmlspecialchars($_POST['login']);
    $user = new User($login,htmlspecialchars($_POST['pass']));

    try {
        $result = $user->exists();
    }
    catch (Exception $e){
        header('Location: fail.php');
        exit();
    }
    if ($result){
        $_SESSION['login']=$login;
        header('Location: http://tp5.local/welcome.php');
        exit();
    }
    else {
        $_SESSION['message']='Wrong try again';
        header('Location: http://tp5.local/signin.php');
    }
//}
