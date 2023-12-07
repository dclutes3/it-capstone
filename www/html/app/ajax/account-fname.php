<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$user = new user($_SESSION['user']);

ob_start(); ?>

<input name="fname" id="fnameInput" type="text" value="<?php echo $user->getFname()?>" class="form-control" />
<p id="fnameValue" class='p my-auto'><?php echo $user->getFname()?></p>

<?php echo ob_get_clean(); ?>