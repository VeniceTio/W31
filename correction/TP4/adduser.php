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
    header('Location: signup.php');
    exit();
}

// On vérifie qu'on a bien reçu les données en POST
if ( !isset($_POST['login'],$_POST['password'],$_POST['confirm']) )
{
    $_SESSION['message'] = "Some POST data are missing.";
    header('Location: signup.php');
    exit();
}

// On les sécurise les données POST.
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);
$confirm = htmlspecialchars($_POST['confirm']);

if ( $password !== $confirm )
{
    $_SESSION['message'] = "The two passwords differ.";
    header('Location: signup.php');
    exit();
}

/******************************************************************************
 * On inclut le fichier contenant la définition de la classe User
 */
require_once('models/User.php');

//On crée l'utilisateur
$user = new User($login,$password);

try {
    // On crée l'utilisateur dans la BDD
    $user->create();
}
catch (PDOException $e) {
    // Si erreur lors de la création de l'objet PDO
    // (déclenchée par MyPDO::pdo())
    $_SESSION['message'] = $e->getMessage();
    header('Location: signup.php');
    exit();
}
catch (Exception $e) {
    // Si erreur durant l'exécution de la requête
    // (déclenchée par le throw de $user->create())
    $_SESSION['message'] = $e->getMessage();
    header('Location: signup.php');
    exit();
}

/******************************************************************************
 * Si tout est ok, on indique que le compte est crée et on se rend sur signin.php
 */
$_SESSION['message'] = "Account created! Now, signin.";
header('Location: signin.php');
exit();
