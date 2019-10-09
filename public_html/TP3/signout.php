<?php

session_start();
session_destroy(); //Unset($_SESSION[‘user’])
header('Location: http://tp3.local/signin.php');