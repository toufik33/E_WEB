<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" type="text/css" href="zoomer/zoomer.css" media="screen" />
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <title>ADMIN</title>
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
                        <li><a href="/users.php">Membres</a></li>
					    <li><a href="/inventory_list.php">inventaire</a></li>
                        
                        <li><a href="/inventory_commande.php">Commande</a></li>
						
						<li><a href="/stat.php">Statistique</a></li>
						<li><a href="/dispo.php">Stock</a></li>
						
						<?php
						
						if (isset($_SESSION["manager"])){
						echo'<li><a href="log_out_admin.php">Deconenxion</a></li>';
						}
						else 
						if (!isset($_SESSION["manager"])){
						echo '<a href="index.php">Conenxion</a></li>';
						}
						?>
						
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
                    <a href="http://localhost:8888/version_finale_projet_web/storeadmin/index.php" class="bouton_rouge"> Accueil<img src="images/flecheblanchedroite.png" alt="" /></a>
                </div>
            </div>
            
            <section>
			<article>