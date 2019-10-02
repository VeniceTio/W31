<?php
session_start();

if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
{
    header('Location: signin.php');
    exit();
}

unset($_SESSION['message']);

// Incusion du fichiers contenant les associations user => password
require_once('users.php');

if ( !isset($_POST['login'],$_POST['password']) )
{
    header('Location: signin.php');
    exit();
}

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

if ( !array_key_exists($login, $users) )
{
    $_SESSION['message'] = "Wrong login.";
    header('Location: signin.php');
    exit();
}

if ( $users[$login] !== $password )
{
    $_SESSION['message'] = "Wrong password.";
    header('Location: signin.php');
    exit();
}

$_SESSION['user'] = $login;
header('Location: welcome.php');
exit();
