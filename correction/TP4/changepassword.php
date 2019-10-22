<?php
/******************************************************************************
 * On démarre la session
 */
session_start();

// On reset les messages
unset($_SESSION['message']);

/******************************************************************************
 * On vérifie que l'utilisateur est connecté
 */
if ( !isset($_SESSION['user']) )
{
    header('Location: signin.php');
    exit();
}

/******************************************************************************
 * On vérifie que la méthode HTTP utilisée est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: formpassword.php');
    exit();
}

// On vérifie qu'on a bien reçu les données en POST
if ( !isset($_POST['newpassword'],$_POST['confirmpassword']) )
{
    $_SESSION['message'] = "Some POST data are missing.";
    header('Location: formpassword.php');
    exit();
}

// On les sécurise les données POST.
$login           = $_SESSION['user'];
$newpassword     = htmlspecialchars($_POST['newpassword']);
$confirmpassword = htmlspecialchars($_POST['confirmpassword']);

// On s'assure que les 2 mts de passes corrspondent
if ( $newpassword != $confirmpassword )
{
    $_SESSION['message'] = "Error: passwords are different.";
    header('Location: formpassword.php');
    exit();
}

/******************************************************************************
 * On inclut le fichier contenant les informations de connexion à la BDD
 */
 require_once('models/User.php');

 //On crée l'utilisateur
 $user = new User($login);

try {
    $user->changePassword($newpassword);
}
catch (PDOException $e) {
    // Si erreur lors de la création de l'objet PDO
    // (déclenchée par MyPDO::pdo())
    $_SESSION['message'] = $e->getMessage();
    header('Location: formpassword.php');
    exit();
}
catch (Exception $e) {
    // Si erreur durant l'exécution de la requête
    // (déclenchée par le throw de $user->changePassword())
    $_SESSION['message'] = $e->getMessage();
    header('Location: formpassword.php');
    exit();
}

/******************************************************************************
 * Si tout est ok, on retourne sur welcome.php
 */
$_SESSION['message'] = "Password successfully updated.";
header('Location: welcome.php');
exit();
