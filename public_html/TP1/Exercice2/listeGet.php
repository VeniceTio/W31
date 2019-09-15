<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php
echo $_GET['nbItems'];
if ( isset($_GET['nbItems'])){
    $listeElement = [];
    for ($i = 0; $i < $_GET['nbItems']; $i++) {
        $listeElement[] = rand();
    }
    echo '<ul>';
    foreach ($listeElement as $value) {
        echo '<li>'.$value . '</li>';
    }
    echo '</ul>';
}
?>
</body>
</html>