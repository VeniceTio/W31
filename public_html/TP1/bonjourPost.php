<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>

<?php
if ($_SERVER['REQUEST_METHOD']!='POST'){
    header('Location: http://w31.local/TP1/formulaire.html');
    exit();
}
if (isset($_POST['firstname'])) {
    echo 'Salut ' . htmlspecialchars($_POST['firstname']) . '!<br>';
}
else {
    echo 'aucun module rempli';
}?>

</body>
</html>