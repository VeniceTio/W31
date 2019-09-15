<?php
session_start();
$_SESSION['counter']=-1;
header("Location: http://w31.local/TP1/Exercice3/counter.php");
exit;