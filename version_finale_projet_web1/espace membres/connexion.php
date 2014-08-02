 <?php
include('../config.php');
?>

<?php
include ('../menu1.php');
?>
<aside>
                <?php
//Si lutilisateur est connecte, on le deconecte
if(isset($_SESSION['username']))
{
        //On le deconecte en supprimant simplement les sessions username et userid
        unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message">Vous avez bien &eacute;t&eacute; d&eacute;connect&eacute;.<br />
<a href="<?php echo $url_home; ?>">Accueil</a></div>
<?php
}
else
{
        $ousername = '';
        //On verifie si le formulaire a ete envoye
        if(isset($_POST['username'], $_POST['password']))
        {
                //On echappe les variables pour pouvoir les mettre dans des requetes SQL
                if(get_magic_quotes_gpc())
                {
                        $ousername = stripslashes($_POST['username']);
                        $username = mysql_real_escape_string(stripslashes($_POST['username']));
                        $password = stripslashes($_POST['password']);
                }
                else
                {
                        $username = mysql_real_escape_string($_POST['username']);
                        $password = $_POST['password'];
                }
                //On recupere le mot de passe de lutilisateur
                $req = mysql_query('select password,id from users where username="'.$username.'"');
				
				//rajouter par moi :
				//$_SESSION['username'] = $username;
				
				
                $dn = mysql_fetch_array($req);
                //On le compare a celui quil a entre et on verifie si le membre existe
                if($dn['password']==$password and mysql_num_rows($req)>0)
                {
                        //Si le mot de passe es bon, on ne vas pas afficher le formulaire
                        $form = false;
                        //On enregistre son pseudo dans la session username et son identifiant dans la session userid
                        $_SESSION['username'] = $_POST['username'];
                        $_SESSION['userid'] = $dn['id'];
						
						$_session['username']=$username;
?>
<div class="message"><h1>Vous avez bien &eacute;t&eacute; connect&eacute;. Vous pouvez acc&eacute;der &agrave; votre espace membre</h1<.<br />
<a href="<?php echo $url_home; ?>">Accueil</a></div>
<?php
                }
                else
                {
                        //Sinon, on indique que la combinaison nest pas bonne
                        $form = true;
                        $message = ' La combinaison que vous avez entr&eacute; n\'est pas bonne';
                }
        }
        else
        {
                $form = true;
        }
        if($form)
        {
                //On affiche un message sil y a lieu
        if(isset($message))
        {
                echo '<div class="message">'.$message.'</div>';
        }
        //On affiche le formulaire
?>

<div class="content">
    <form action="connexion.php" method="post">
        Veuillez entrer vos identifiants pour vous connecter:<br />
        <div class="center">
            <label for="username">Nom d'utilisateur</label></br><input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <label for="password">Mot de passe</label></br><input type="password" name="password" id="password" /><br />
            <input type="submit" value="Connection" />
                </div>
    </form>
</div>
<?php
        }
}
?>
</aside>
     <?php
include ('../menu2.php');
?>     
 