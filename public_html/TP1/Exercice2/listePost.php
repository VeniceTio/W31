<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php
echo $_POST['nbItems'].'<br/>';
if ( isset($_POST['nbItems'])){
    $val = (int) htmlentities($_POST['nbItems']);
    $listeElement = [];
    for ($i = 0; $i < $_POST['nbItems']; $i++) {
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
