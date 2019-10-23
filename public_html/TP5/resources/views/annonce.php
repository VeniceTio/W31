<?php
$_message = htmlspecialchars($_SESSION['message']);
?>
<section class="annonce">
    <h5><?php
        echo $_message;
        ?></h5>
</section>
