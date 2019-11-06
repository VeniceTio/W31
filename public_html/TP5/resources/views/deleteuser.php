<?php


// On reset les messages
unset($_SESSION['message']);

$login = $_SESSION['user'];

/******************************************************************************
 * On inclut le fichier contenant la définition de la classe User
 */
use App\MyUser;

//On crée l'utilisateur
$user = new MyUser($login);

// Création de l'objet PDO
try {
    // On crée l'utilisateur dans la BDD
    $user->delete();
}
catch (PDOException $e) {
    // Si erreur lors de la création de l'objet PDO
    // (déclenchée par MyPDO::pdo())
    $_SESSION['message'] = $e->getMessage();
    header('Location: admin/welcome');
    exit();
}
catch (Exception $e) {
    // Si erreur durant l'exécution de la requête
    // (déclenchée par le throw de $user->create())
    $_SESSION['message'] = $e->getMessage();
    header('Location: admin/welcome');
    exit();
}

/******************************************************************************
 * Si tout est ok, on détruit la session et retourne sur signin.php
 */
session_destroy();
$_SESSION['message'] = "Account successfully deleted.";
header('Location: signin');
exit();
