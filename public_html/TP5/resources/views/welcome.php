<?php
session_start();
if (!isset($_SESSION['login'])){
    header('Location: http://tp5.local/signin.php');
}
?>
<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style/Home.css">
    <title>TP3</title>
</head>

<body>
    <!-- multistep form -->
    <form id="msform">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Bienvenue</h2>
            <?php
            echo '<h3 class="fs-subtitle">'.$_SESSION['login'].'</h3>'
            ?>
            <section id="action">
                <a name="logout" class="ac" value="ModifPass" href="formpassword.php">Change Password</a>
                <a name="logout" class="ac" value="delete" href="deleteuser.php">Delete User</a>
                <a name="logout" class="submit action-button" value="logout" href="signout.php">log-out</a>
            </section>
        </fieldset>
        <?php if (isset($_SESSION['message'])) {include("annonce.php");unset($_SESSION['message']);}?>
    </form>

</body>

</html>
