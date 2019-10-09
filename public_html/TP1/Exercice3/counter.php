<?php

session_start();
$_SESSION['counter']++;
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Counter</title>
    <link rel="stylesheet" href="Style/Home.css">
</head>

<body>
<form id="msform">
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Connexion</h2>
<?php
echo '<h3 class="fs-subtitle">Vous vous êtes connécté ' . $_SESSION['counter'] . ' fois !</h3>';
?>
<a href="http://w31.local/TP1/Exercice3/resetCounter.php" name="submit" class="submit action-button">reset</a>
    </fieldset>
</form>
</body>
</html>

