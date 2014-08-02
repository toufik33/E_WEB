<?php
include('config.php');
include('menu_admin1.php')

?>

<?php

$editer_commande = $_POST['editer_commande'];
$user= $_POST['user'];
$date=$_POST['date'];

echo $editer_commande;
echo $user;


mysql_query ("UPDATE transactions SET etat_commande = '$editer_commande' WHERE (username = '$user' and date_ajout_commande ='$date')");

header("location: inventory_commande.php"); 
    exit();


?>

<?php

include ('menu_admin1.php');

?>