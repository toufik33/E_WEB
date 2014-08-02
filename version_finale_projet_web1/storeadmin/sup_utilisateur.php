<?php 
session_start();
include "config.php";
include"menu_admin1.php";

if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
<?php
if (isset($_POST['utilisateur'])) {
$utilisateur = $_POST['utilisateur'];
mysql_query(" DELETE FROM users where username = '$utilisateur'");
header("location: users.php"); 
    exit();

//echo $utilisateur;
}
?>