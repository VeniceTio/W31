<!DOCTYPE html>
<html lang="francais">
<head>
    <title>HTML Tutorial</title>
    <link rel="stylesheet" href="Style/Home.css">
</head>

<body>
<form id="msform">
    <fieldset>
        <h2 class="fs-title">Liste d'items</h2>
        <?php
        echo '<h3 class="fs-subtitle">Nombre d\'item : '.$_POST['nbItems'].'</h3>';
        if ( isset($_POST['nbItems'])){
            $val = (int) htmlentities($_POST['nbItems']);
            $listeElement = [];
            for ($i = 0; $i < $_POST['nbItems']; $i++) {
                $listeElement[] = rand();
            }
            echo '<ul>';
            foreach ($listeElement as $value) {
                echo '<li>-  '.$value . '  -</li>';
            }
            echo '</ul>';
        }
        ?>
        <a href="http://w31.local/TP1/Exercice2/formulaire.html" name="submit" class="submit action-button">reset</a>
    </fieldset>
</form>
</body>
</html>
