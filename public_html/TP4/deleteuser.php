<?php
session_start();
if (!isset($_SESSION['login'])){
    header('Location: http://tp4.local/signin.php');
    exit();
}
else {
    include("models/User.php");
    $login = htmlspecialchars($_SESSION['login']);
    $user = new User($login,"voila");
    try {
        $del = $user->deleteUser();
        /**if ($del){
            session_destroy();
            header('Location: http://tp4.local/signin.php');
            exit();
        }
        /**else {
            $_SESSION['message']="Error can't delete this acount";
            header('Location: http://tp4.local/welcome.php');
            exit();
        }**/
        var_dump($del);
    }
    catch (Exception $e){
        var_dump($e);
    }

}