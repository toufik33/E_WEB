
<?php
include('config.php');
include ('menu1.php');
?>
<?php
if(isset($_POST['submit']))
{
//On nettoie un peut la requête
$requete = trim(stripcslashes(htmlspecialchars($_POST['requete'])));
 
//On se connecte à la base de données

 
mysql_connect("localhost","root","");
mysql_select_db("test") or die('Impossible de s&eacute;lectionner une base de donn&eacute;e. Assurez vous d\'avoir correctement remplit les donn&eacute;es du fichier connexion_bd.php.');
 
$query = mysql_query("SELECT id,product_name,price,details,	category  FROM products WHERE product_name
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR product_name
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR details
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR category
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' GROUP BY product_name") 
or die (mysql_error()); 
 
//On utilise la fonction mysql_num_rows pour compter les résultats
$nb_resultats = mysql_num_rows($query); 
//Si le nombre de résultats est différent de 0, on continue
if($nb_resultats != 0) 
{
//On affiche le nombre de résultats 
echo 'Il existe <b>'.$nb_resultats.'</b>'; 
if($nb_resultats > 1) 
// on vérifie le nombre de résultats pour orthographier correctement. 
{ 
echo ' r&eacute;sultats'; 
} 
else 
{ 
echo ' r&eacute;sultat'; 
} 
echo ' pour votre recherche "<b>'.$requete.'</b>" trouv&eacute; :<br/>';
//On attribue un chiffre pour chaque enregistrement trouvé
$i = "1";
//On boucle pour afficher la liste des enregistrements trouvés
while($donnees = mysql_fetch_array($query)) 
{
echo '<div class="cadre"><big><big>'.$i.'-<a title="'.$donnees['product_name'].'" href="product.php?id='.$donnees['id'].'">'.$donnees['product_name'].'</a></big></big><br/></div>';
$i++;
}
//on ferme if($nb_resultats > 1)
}
//Si il n'y a rien
else {
echo '<p>Nous n\'avons trouv&eacute; aucun r&eacute;sultats pour votre recherche "<b>
'.$requete.'</b>" !</p>';
}
//On ferme if(isset($_POST['requete'])
}
//On ferme mysql
mysql_close(); 
?>
    <?php
include ('menu2.php');
?>

    

    