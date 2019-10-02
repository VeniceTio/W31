<?php
const SQL_DNS = "mysql:host=localhost;dbname=2019_w31;charset=utf8";
const SQL_USERNAME = "root";
const SQL_PASSWORD = "";

try {
    $pdo = new PDO(SQL_DNS,SQL_USERNAME,SQL_PASSWORD);
}
catch(PDOException $e){
    header('Location: fail.php');
    exit();
}

//not secure $result = $pdo->querry("select...");

$login = htmlspecialchars($_GET['login']);
$password = htmlspecialchars($_GET['password']);
$result = $pdo->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
$result->bindValue(':login',$_GET['login'],PDO::PARAM_STR);
$result->bindValue('pasword',$_GET['password'],PDO::PARAM_STR);
$result->execute();

foreach ($result as $row){
    echo 'votre login :'.$row['login'].', Votre password : '.$row['password'];
}