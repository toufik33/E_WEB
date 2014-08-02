<?php

include("generateur-rss/data_bd.php");
mysql_connect("$db_server","$db_name","$db_user_pass");
mysql_select_db("$db_user_login");


//entete du flux
$query2 = mysql_query("SELECT * FROM  RSS ");

$identete ="";
$titreentete ="";
$descriptionentete = "";
$urlentete = "";
$titreimage ="";
$urlimage ="";
$urldusite ="";
$dateentete="";

while($affiche2 = mysql_fetch_array($query2))
{
$id = $affiche2['id'];

$identete="$id";


$titre = $affiche2['titre'];

$titreentete="$titre";


$description = $affiche2['description'];

$descriptionentete="$description";


$url = $affiche2['url'];

$urlentete="$url";

//requette pour l'image de l'entete

$titre_image = $affiche2['titre_image'];

$titreimage="$titre_image";


$url_image = $affiche2['url_image'];

$urlimage="$url_image";

$url_site = $affiche2['url_site'];

$urldusite="$url_site";

$date = $affiche2['date'];

$dateentete="$date";
	 
//entete du flux rss	
$xml .= '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0">';
$xml .= '<channel><title><![CDATA[ '.$titreentete.' ]]></title><link>'.$urlentete.'</link>';
$xml .= '<description><![CDATA[ '.$descriptionentete.' ]]></description><language>fr</language>';

if($urlimage != '' and $titreimage != '' and $urldusite != ''){
$xml .= '<image><title>'.$titreimage.'</title><url>'.$urlimage.'</url><link>'.$urldusite.'</link></image>';
}
else
{
$xml .= '';
}
//entete du flux xml
$sitemap .='<?xml version="1.0" encoding="UTF-8"?>';
$sitemap .='<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';
$sitemap .=' <url>';
$sitemap .='<loc>'.$urlentete.'</loc>';
//si la date n'a pas été rentré on affiche rien
if($date == '0000-00-00'){
$sitemap .='';
}
else
{
$sitemap .='<lastmod>'.$dateentete.'</lastmod>';
}

$sitemap .='</url>';

}



//flux rss
$query1 = mysql_query("SELECT * FROM  NEWSRSS ORDER BY id DESC");

$idrss ="";
$titrerss ="";
$descriptionrss = "";
$urlrss = "";
$imagerss = "";
$daterss ="";
$rssdate ="";

while($affiche1 = mysql_fetch_array($query1))
{
$id = $affiche1['id'];

$idrss="$id ";


$titre = $affiche1['titre'];

$titrerss="$titre";


$description = $affiche1['description'];

$descriptionrss="$description";


$url = $affiche1['url'];

$urlrss="$url";

$image = $affiche1['image'];

$imagerss="$image";

$date = $affiche1['date'];

$daterss="$date";

$rss_date = $affiche1['rss_date'];

$rssdate="$rss_date";


	$xml .= '<item>';
	$xml .= '<title><![CDATA[ '.$titrerss.' ]]></title>';
	$xml .= '<link>'.$urlrss.'</link>';
if($imagerss != ''){
	$xml .= '<description><![CDATA[ '.$descriptionrss.'<br/><img src="'.$imagerss.'"> ]]></description>';
}
else
{
	$xml .= '<description><![CDATA[ '.$descriptionrss.']]></description>';
}
//format de la date  pour le flux rss
		$xml .= '<pubDate>'.$rss_date.' GMT</pubDate>';
	$xml .= '</item>';

//corp du flux xml
$sitemap .='<url>';
$sitemap .='<loc>'.$urlrss.'</loc>';
//si la date n'a pas été rentré on affiche rien
if($date == '0000-00-00'){
$sitemap .='';
}
else
{
$sitemap .='<lastmod>'.$daterss.'</lastmod>';
}

$sitemap .='</url>';

}
mysql_close();

/*Merci de laisser en place cette partie qui me sert de "contribution" en échange du travail effectué sur ce code*/
$date_date = date("D, j M Y H:i:s");
	$xml .= '<item>';
	$xml .= "<title>Creer un site</title>";
	$xml .= "<link>http://creer-un-site.fr</link>";
	$xml .= "<description><![CDATA[Ce site a pour but d'essayer d'aider les personnes qui n'y connaisse rien a creer un site ou page perso sans connaissances particulieres et sans rien payer.<br/>Vous souhaitez creer un site web mais vous ne savez pas trop comment vous y prendre!! Ce site est loin d'etre exhaustif mais il se veut simple pour les debutants.<br/>
<a href=\"http://creer-un-site.fr\"><img style=\"border: 0px solid ; width: 222px; height: 77px;\" alt=\"Creer un site\" src=\"http://creer-un-site.fr/images-flux-rss/question.gif\"></a>]]></description>";
        $xml .= '<pubDate>'.$date_date.' GMT</pubDate>';
	$xml .= '</item>';

//fin du flux rss
$xml .="</channel></rss>";

//fin du flux xml
$sitemap .='</urlset>';

// Ecriture du flux rss dans un fichier xml 
 $fp = fopen("rss.xml", 'w+');
 fputs($fp, $xml);
 


// Ecriture du sitemap dans un fichier xml 
 $fp = fopen("sitemap.xml", 'w+');
 fputs($fp, $sitemap);
fclose($fp); 




?>
<script type="text/javascript">
window.setTimeout("location=('rss.xml');",3)
</script> 
<a href="rss.xml">Voir le flux</a>