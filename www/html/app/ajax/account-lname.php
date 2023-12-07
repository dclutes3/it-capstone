<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$user = new user($_SESSION['user']);

ob_start(); ?>

<input name="lname" id="lnameInput" type="text" value="<?php echo $user->getLname()?>" class="form-control"/>
<p id="lnameValue" class='p my-auto'><?php echo $user->getLname()?></p>

<?php echo ob_get_clean(); ?>