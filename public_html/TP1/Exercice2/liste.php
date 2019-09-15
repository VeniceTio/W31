<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
</head>

<body>
<?php

$listeElement = [];
for ($i = 0; $i <10 ; $i++){
    $listeElement[]= rand();
}
foreach ($listeElement as $value){
    echo $value.'<br/>';
}
?>
</body>
</html>