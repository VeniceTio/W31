<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php
session_start();
if (!isset($_COOKIE["nbConnexion"])) {
    setcookie('nbConnexion', '1', time() + 60 * 60 * 24 * 10);
}
else {
    setcookie('nbConnexion', $_COOKIE["nbConnexion"]+1, time() + 60 * 60 * 24 * 10);
}
echo 'Vous vous êtes connécté ' . $_COOKIE["nbConnexion"] . ' fois !';
?>
<a href="http://w31.local/TP1/Exercice4/resetCounter.php">reset</a>
</body>
</html>

