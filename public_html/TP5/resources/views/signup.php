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
    <form id="msform" action="http://tp5.local/adduser.php" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Sign up</h2>
            <input type="text" name="login" placeholder="Login" value="<?php if (isset($_SESSION['loginUp'])) {echo $_SESSION['loginUp'];unset($_SESSION['loginUp']);}?>" required/>
            <input type="password" id="pass" name="pass" placeholder="Password" required/>
            <input type="password" id="rpass" oninput="checkPassword(this)" name="rpass" placeholder="Repeat password" required/>
            <h4>
                <?php
                if (isset($_SESSION['messageInscription']) && !empty($_SESSION['messageInscription'])) {
                    echo $_SESSION['messageInscription'];
                    unset($_SESSION['messageInscription']);
                }?>
            </h4>
            <input type="submit" name="submit" class="submit action-button" value="Sign up"/>
            <h5 class="message">Already registered ?<a class="ac" href="http://tp5.local/signin.php">Sign in</a></h5>
        </fieldset>
    </form>
<script type="text/javascript" language="JavaScript">
    function checkPassword(input){
        const element = document.getElementById("pass").value;
        if (element !== input.value){
            input.setCustomValidity("Wrong Password");
        }
        else{
            input.setCustomValidity("");
        }
    }
</script>
</body>
</html>
