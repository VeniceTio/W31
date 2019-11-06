<?php

// On reset les messages
unset($_SESSION['message']);


// On vérifie qu'on a bien reçu les données en POST
if ( !isset($_POST['login'],$_POST['password']) )
{
    $_SESSION['message'] = "Some POST data are missing.";
    header('Location: http://tp5.local/signin');
    exit();
}

// On les sécurise les données POST.
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

/******************************************************************************
 * On inclut le fichier contenant la définition de la classe User
 */
use App\MyUser;

//On crée l'utilisateur
$user = new MyUser($login,$password);

try {
    // On vérifie qu'il existe dans la BDD
    if ( !$user->exists() )
    {
        $_SESSION['message'] = 'Wrong login/password.';
        header('Location: http://tp5.local/signin');
        exit();
    }
}
catch (PDOException $e) {
    // Si erreur lors de la création de l'objet PDO
    // (déclenchée par MyPDO::pdo())
    $_SESSION['message'] = $e->getMessage();
    header('Location: http://tp5.local/signin');
    exit();
}
catch (Exception $e) {
    // Si erreur durant l'exécution de la requête
    // (déclenchée par le throw de $user->exists())
    $_SESSION['message'] = $e->getMessage();
    header('Location: http://tp5.local/signin');
    exit();
}

/******************************************************************************
 * Si tout est ok, on se connecte et se rend sur welcome.php
 */
$_SESSION['user'] = $login;
header('Location: admin/welcome');
exit();
