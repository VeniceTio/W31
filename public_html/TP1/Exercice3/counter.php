<?php

session_start();
$_SESSION['counter']++;
?>
<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php
echo 'Vous vous êtes connécté ' . $_SESSION['counter'] . ' fois !';
?>
<a href="http://w31.local/TP1/Exercice3/resetCounter.php">reset</a>
</body>
</html>

