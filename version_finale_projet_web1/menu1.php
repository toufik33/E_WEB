

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" type="text/css" href="zoomer/zoomer.css" media="screen" />
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>Chaussures home </title>
		

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
                    <h1>home</h1></BR>
                    <h1>Baskets</h1>
                </div>
                
                <nav>
                    <ul>
					
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="selection_H.php">Homme</a></li>
                        <li><a href="selection_F.php">Femme</a></li>
                        <li><a href="selection_E.php">Enfant</a></li>
						
						<li><a href="/affiche_product.php">Catalogue</a></li>
						<?php
						if(isset($_SESSION['username'])){
						echo '<div class="cadre"><a title="'.$username.'" href="/espace membres/index_membres.php"></div>';
						echo " <FONT COLOR='brown' > $username</font>";}
						//echo " $userid ";
						else 
						echo "<a href='/espace membres/index_membres.php'title='Enregistrer votre commande'> <img src='/images/login.jpg' alt='Membres' /></a>";
						?>
						</li>
						<li><a href="/cart.php"><img src="/images/panier.jpg" alt="Panier" /></a>
						
						
						<?php
error_reporting(E_ALL ^ E_NOTICE);

						 
						if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) >= 0){
						echo "Mon panier:",(count($_SESSION["cart_array"]));}
						
						
						?></li>
                  
                </nav>
            </header>
            
            <div id="banniere_image">
                <div id="banniere_description">
				<?php
// Enregistrons les informations de date dans des variables

$jour = date('d');
$mois = date('m');
$annee = date('Y');
if(isset($_SESSION['username'])){
// Maintenant on peut afficher ce qu'on a recueilli
echo 'Bonjour&nbsp;<font color= red >'.$username. '</font>&nbsp;Nous sommes le ' . $jour . '/' . $mois . '/' . $annee;
}
else 
{echo 'Bonjour Nous sommes le ' . $jour . '/' . $mois . '/' . $annee;}
?>

                    <center><marquee scrolldelay="60" scrollamount="3" width="400" direction"left" behavior="alternate" bgcolor="#FF0000">Bienvenue sur Baskets home</marquee></center>
                    <a href="/index.php" class="bouton_rouge">Baskets Home <img src="images/flecheblanchedroite.png" alt="" /></a>
					<form method="post" action="/moteur.php">
<p><input size="20" name="requete" value="" type="text"/>
<input value="Rechercher"name="submit" type="submit"/></p>
</form>
</br>

                </div>
            </div>
            
            <section>
			<article></br>