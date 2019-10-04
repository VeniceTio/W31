<?php
session_start()
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
    <form id="msform" action="http://tp3.local/adduser.php" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Sign up</h2>
            <input type="text" name="login" placeholder="Login" value="<?php if (isset($_SESSION['loginUp'])) {echo $_SESSION['loginUp'];}else{echo "login";}?>"/>
            <input type="password" name="pass" placeholder="Password"/>
            <input type="password" name="rpass" placeholder="Repeat password"/>
            <h4><?php if (isset($_SESSION['messageInscription'])) {echo $_SESSION['messageInscription'];}?></h4>
            <input type="submit" name="submit" class="submit action-button" value="Sign up"/>
        </fieldset>
    </form>
</body>
</html>
