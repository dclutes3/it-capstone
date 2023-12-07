<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$user = new user($_SESSION['user']);

ob_start(); ?>

<input name="email" id="emailInput" type="text" value="<?php echo $user->getEmail()?>" class="form-control" style="width: 100%;"/>
<p id="emailValue" class='p my-auto'><?php echo $user->getEmail()?></p>

<?php echo ob_get_clean(); ?>