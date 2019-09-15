<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php
echo $_POST['nbItems'].'<br/>';
$listeElement = [];
for ($i = 0; $i < $_POST['nbItems']; $i++) {
    $listeElement[] = rand();
}
foreach ($listeElement as $value) {
    echo $value . '<br/>';
}
?>
</body>
</html>
