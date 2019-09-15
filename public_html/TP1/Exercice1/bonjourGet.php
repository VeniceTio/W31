<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>

<?php
if (isset($_GET['module'])) {
    echo 'Le module s\'appelle ' . htmlspecialchars($_GET['module']) . '.<br>';
}
else {
    echo 'aucun module rempli';
}?>

</body>
</html>