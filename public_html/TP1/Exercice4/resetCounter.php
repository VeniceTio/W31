<?php
setcookie('nbConnexion', '0', time() + 60 * 60 * 24 * 10);
header('Location: http://w31.local/TP1/Exercice3/counter.php');