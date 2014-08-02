<?php
//On demarre les sessions


/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
mysql_connect('localhost', 'le_che_83', '');
mysql_select_db('test');

//Email du webmaster
$mail_webmaster = 'yacyac34@live.fr';

//Adresse du dossier de la top site
$url_root = 'http://localhost:8888';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';
?>