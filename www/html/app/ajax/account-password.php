
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("../../../../plugins/config.php");

$user = new user($_SESSION['user']);

ob_start(); ?>

<input name="pass"id="passwordInput" type="text" placeholder="Choose a password" class="form-control"/>
<p id="passwordValue" class="p my-auto">***********</p>                                           

<?php echo ob_get_clean(); ?>