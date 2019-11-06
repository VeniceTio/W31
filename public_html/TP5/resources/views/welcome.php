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
			<li><a href="formpassword">Change password.</a></li>
			<li><a href="deleteuser">Delete my account.</a></li>
		</ul>
        <p><a href="signout">Sign out.</a></p>
    </body>
	<?php if ( isset($_SESSION['message']) && !empty($_SESSION['message']) ) { ?>
			<section>
				<p><?= $_SESSION['message']; ?></p>
			</section>
	<?php } ?>
</html>
