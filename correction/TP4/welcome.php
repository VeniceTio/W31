<?php
	session_start();
	if ( !isset($_SESSION['user']) )
	{
        header('Location: signin.php');
        exit();
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My account</title>
    </head>
    <body>
        <p>
			Hello <?= $_SESSION['user']; ?> !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="changepassword.php">Change password.</a></li>
			<li><a href="deleteuser.php">Delete my account.</a></li>
		</ul>
        <p><a href="signout.php">Sign out.</a></p>
    </body>
	<?php if ( isset($_SESSION['message']) && !empty($_SESSION['message']) ) { ?>
			<section>
				<p><?= $_SESSION['message']; ?></p>
			</section>
	<?php } ?>
</html>
