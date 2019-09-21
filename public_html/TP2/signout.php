<?php

session_start();
session_destroy();
header('Location: http://w31.local/TP2/signin.php');