<?php
session_start()
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style/Home.css">
    <title>TP2</title>
</head>
<body>
    <!-- multistep form -->
    <form id="msform" action="http://tp2.local/authenticate.php" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">authentification</h2>
            <input type="text" name="login" placeholder="login"/>
            <input type="password" name="pass" placeholder="Password"/>
            <h4><?php if (isset($_SESSION['message'])) {echo $_SESSION['message'];}?></h4>
            <input type="submit" name="submit" class="submit action-button" value="Submit"/>
        </fieldset>
    </form>
</body>
</html>