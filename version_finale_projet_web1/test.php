<html>

<body>

<?php

//=========================================

// includes du fichier fonctions

//=========================================

require 'fonctions.php';

//=========================================

// information pour la connection à le DB

//=========================================

$host = 'localhost';

$user = 'root';

$pass = '';

$db = 'test';



//=========================================

// initialisation des variables 

//=========================================

// on va afficher 5 résultats par page.

$nombre = 5;  

// si limite n'existe pas on l'initialise à zéro

if (!$limite) $limite = 0; 

// on cherche le nom de la page.    

$path_parts = pathinfo($_SERVER['PHP_SELF']);

$page = $path_parts["basename"];



//=========================================    

// connection à la DB

//=========================================

$link = mysql_connect ($host,$user,$pass) or die ('Erreur : '.mysql_error() );

mysql_select_db($db) or die ('Erreur :'.mysql_error());



//=========================================    

// requête SQL qui compte le nombre total 

// d'enregistrements dans la table.

//=========================================

$select = 'SELECT count(id) FROM vaches';

$result = mysql_query($select,$link)  or die ('Erreur : '.mysql_error() );

$row = mysql_fetch_row($result);

$total = $row[0];

    

//=========================================

// vérifier la validité de notre variable 

// $limite;

//=========================================

$verifLimite= verifLimite($limite,$total,$nombre);

// si la limite passée n'est pas valide on la remet à zéro

if(!$verifLimite)  {

    $limite = 0;

}

//=========================================

// requête SQL qui ne prend que le nombre 

// d'enregistrement necessaire à l'affichage.

//=========================================

$select = 'select prenom,surnom FROM vaches ORDER BY prenom ASC limit '.$limite.','.$nombre;

$result = mysql_query($select,$link)  or die ('Erreur : '.mysql_error() );

    

//=========================================    

// si on a récupéré un resultat on l'affiche.

//=========================================

if($total) {

    // début du tableau

    echo '<table bgcolor="#FFFFFF">'."\n";

        // première ligne on affiche les titres prénom et surnom dans 2 colonnes

        echo '<tr>';

        echo '<td bgcolor="#669999"><b><u>Prénom</u></b></td>';

        echo '<td bgcolor="#669999"><b><u>Surnom</u></b></td>';

        echo '</tr>'."\n";

    // lecture et affichage des résultats sur 2 colonnes    

    while($row = mysql_fetch_array($result)) {

        echo '<tr>';

        echo '<td bgcolor="#CCCCCC">'.$row['prenom'].'</td>';

        echo '<td bgcolor="#CCCCCC">'.$row['surnom'].'</td>';

        echo '</tr>'."\n";

    }

    echo '</table>'."\n";

}

else echo 'Pas d\'enregistrements dans cette table...';

mysql_free_result($result);



//=========================================    

// si le nombre d'enregistrement à afficher 

// est plus grand que $nombre 

//=========================================

if($total > $nombre) {

    // affichage des liens vers les pages

    affichePages($nombre,$page,$total);

    // affichage des boutons

    displayNextPreviousButtons($limite,$total,$nombre,$page);

}

?>

</body>

</html>
