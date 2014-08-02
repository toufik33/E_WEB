<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Exécuter une requête de sélection pour obtenir letest mes 6 articles
// Connectez-vous à la base de données MySQL 
include "config.php"; 
$dynamicList = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
$productCount = mysql_num_rows($sql); // compter le nombre de sortie
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="1" cellspacing="1" cellpadding="6">
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="77" height="102" border="1" /></a></td>
          <td width="83%" valign="top">' . $product_name . '<br />
            ' . $price . '&euro;<br />
            <a href="product.php?id=' . $id . '">View Product Details</a></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" type="text/css" href="zoomer/zoomer.css" media="screen" />
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>Connection</title>
    </head>
    
    <!--[if IE 6 ]><body class="ie6 old_ie"><![endif]-->
    <!--[if IE 7 ]><body class="ie7 old_ie"><![endif]-->
    <!--[if IE 8 ]><body class="ie8"><![endif]-->
    <!--[if IE 9 ]><body class="ie9"><![endif]-->
    <!--[if !IE]><!--><body><!--<![endif]-->
        <div id="bloc_page">
            <header>
                <div id="titre_principal">
                    <img src="images/zozor_logo.png" alt="Logo de Zozor" id="logo" />
                    <h1>home</h1>
                    <h2>Baskets</h2>
                </div>
                
                <nav>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Homme</a></li>
                        <li><a href="#">Femme</a></li>
                        <li><a href="#">Enfant</a></li>
						<li><a href="#">Promos</a></li>
						<li><a href="/espace membres/index.php">Membres</a></li>
                    </ul>
                </nav>
            </header>
            
            <div id="banniere_image">
                <div id="banniere_description">
				<?php
// Enregistrons les informations de date dans des variables

$jour = date('d');
$mois = date('m');
$annee = date('Y');

// Maintenant on peut afficher ce qu'on a recueilli
echo 'Bonjour  Nous sommes le ' . $jour . '/' . $mois . '/' . $annee;
?>
                    <center><marquee scrolldelay="60" scrollamount="3" width="400" direction"left" behavior="alternate" bgcolor="#FF0000">Bienvenue sur Chaussures home</marquee></center>
                    <a href="#" class="bouton_rouge">j'aime <img src="images/flecheblanchedroite.png" alt="" /></a>
                </div>
            </div>
            
            <section>
			<article>
    <td width="35%" valign="top"><h3>Catalogue</h3>
      <p><center><?php echo $dynamicList; ?></center></br>
        </p>
     </article>
            <aside>
                    <h1>À propos de nous</h1>
                    <img src="images/bulle.png" alt="" id="fleche_bulle" />
                    <p id="photo_zozor"><img src="images/zozor_classe.png" alt="Photo de Zozor" /></p>
                    <p>Laisse-moi le temps de me présenter : je m'appelle Zozor, je suis né un 23 novembre 2005.</p>
                    <p>Bien maigre, n'est-ce pas ? C'est pourquoi, aujourd'hui, j'ai décidé d'écrire ma biographie (ou zBiographie, comme vous voulez !) afin que les zéros sachent qui je suis réellement.</p>
                    <p><img src="images/facebook.png" alt="Facebook" /><img src="images/twitter.png" alt="Twitter" /><img src="images/vimeo.png" alt="Vimeo" /><img src="images/flickr.png" alt="Flickr" /><img src="images/rss.png" alt="RSS" /></p>
                </aside>    
            </section>
            
            <footer>
                <div id="tweet">
                    <h1>Mon dernier tweet</h1>
                    <p>Hii haaaaaan !</p>
                    <p>hola</p>
                </div>
                <div id="mes_photos">
                    <h1>Mes photos</h1>
                    <p><img src="images/photo1.jpg" alt="Photographie" /><img src="images/photo2.jpg" alt="Photographie" /><img src="images/photo3.jpg" alt="Photographie" /><img src="images/photo4.jpg" alt="Photographie" /></p>
                </div>
                <div id="mes_amis">
                    <h1>contact</h1>
                    <ul>
                        <li><a href="mailto:khellafzirem910@hotmail.com">E-mail</a></li> 
                        
                        <li><a href="#">Facebook</a></li>
                        
                    </ul>
                   
					<ul>
                        <li><a href="#">Administration</a></li>
					</ul>	
					
                </div>
            </footer>
        </div>
    </body>
</html>

    