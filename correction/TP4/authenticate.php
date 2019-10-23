<?php
/******************************************************************************
 * On démarre la session
 */
session_start();

// On reset les messages
unset($_SESSION['message']);

/******************************************************************************
 * On vérifie que la méthode HTTP utilisée est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: signin.php');
    exit();
}

// On vérifie qu'on a bien reçu les données en POST
if ( !isset($_POST['login'],$_POST['password']) )
{
    $_SESSION['message'] = "Some POST data are missing.";
    header('Location: signin.php');
    exit();
}

// On les sécurise les données POST.
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

/******************************************************************************
 * On inclut le fichier contenant la définition de la classe User
 */
require_once('models/User.php');

//On crée l'utilisateur
$user = new User($login,$password);

try {
    // On vérifie qu'il existe dans la BDD
    if ( !$user->exists() )
    {
        $_SESSION['message'] = 'Wrong login/password.';
        header('Location: signin.php');
        exit();
    }
}
catch (PDOException $e) {
    // Si erreur lors de la création de l'objet PDO
    // (déclenchée par MyPDO::pdo())
    $_SESSION['message'] = $e->getMessage();
    header('Location: signin.php');
    exit();
}
catch (Exception $e) {
    // Si erreur durant l'exécution de la requête
    // (déclenchée par le throw de $user->exists())
    $_SESSION['message'] = $e->getMessage();
    header('Location: signin.php');
    exit();
}

/******************************************************************************
 * Si tout est ok, on se connecte et se rend sur welcome.php
 */
$_SESSION['user'] = $login;
header('Location: welcome.php');
exit();
