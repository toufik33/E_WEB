<?php
include('../config.php');
?>
<?php
include ('../menu1.php');
?>
<aside>
              <?php
//On verifie que le formulaire a ete envoye
if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['adresse'], $_POST['avatar']) and $_POST['username']!='')
{
        //On enleve lechappement si get_magic_quotes_gpc est active
        if(get_magic_quotes_gpc())
        {
                $_POST['username'] = stripslashes($_POST['username']);
                $_POST['password'] = stripslashes($_POST['password']);
                $_POST['passverif'] = stripslashes($_POST['passverif']);
                $_POST['email'] = stripslashes($_POST['email']);
				$_post['adresse']=stripslashes($_POST['adresse']);
                $_POST['avatar'] = stripslashes($_POST['avatar']);
        }
        //On verifie si le mot de passe et celui de la verification sont identiques
        if($_POST['password']==$_POST['passverif'])
        {
                //On verifie si le mot de passe a 6 caracteres ou plus
                if(strlen($_POST['password'])>=6)
                {
                        //On verifie si lemail est valide
                        if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
                        {
                                //On echape les variables pour pouvoir les mettre dans une requette SQL
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = mysql_real_escape_string($_POST['password']);
                                $email = mysql_real_escape_string($_POST['email']);
								$adresse=mysql_real_escape_string($_POST['adresse']);
                                $avatar = mysql_real_escape_string($_POST['avatar']);
                                //On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
                                $dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
                                if($dn==0)
                                {
                                        //On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
                                        $dn2 = mysql_num_rows(mysql_query('select id from users'));
                                        $id = $dn2+1;
                                        //On enregistre les informations dans la base de donnee
                                        if(mysql_query('insert into users(id, username, password, email, adresse, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'","'.$adresse.'","'.$avatar.'", NOW())'))
                                        {
                                                //Si ca a fonctionne, on naffiche pas le formulaire
                                                $form = false;
?>
<div class="message">Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.<br />
<a href="connexion.php">Se connecter</a></div>
<?php
                                        }
                                        else
                                        {
                                                //Sinon on dit quil y a eu une erreur
                                                $form = true;
                                                $message = 'Une erreur est survenue lors de l\'inscription.';
                                        }
                                }
                                else
                                {
                                        //Sinon, on dit que le pseudo voulu est deja pris
                                        $form = true;
                                        $message = 'Un autre utilisateur utilise d&eacute;j&agrave; le nom d\'utilisateur que vous d&eacute;sirez utiliser.';
                                }
                        }
                        else
                        {
                                //Sinon, on dit que lemail nest pas valide
                                $form = true;
                                $message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
                        }
                }
                else
                {
                        //Sinon, on dit que le mot de passe nest pas assez long
                        $form = true;
                        $message = 'Le mot de passe que vous avez entr&eacute; contien moins de 6 caract&egrave;res.';
                }
        }
        else
        {
                //Sinon, on dit que les mots de passes ne sont pas identiques
                $form = true;
                $message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
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
    <form action="sign_up.php" method="post">
        Veuillez remplir ce formulaire pour vous inscrire:<br />
        <div class="center">
            <label for="username">Nom d'utilisateur</label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="password">Mot de passe<span class="small">(6 caract&egrave;res min.)</span></label><input type="password" name="password" /><br />
            <label for="passverif">Mot de passe<span class="small">(v&eacute;rification)</span></label><input type="password" name="passverif" /><br />
            <label for="email">Email</label></br><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
			<label for "adresse"> Adresse</label></br><input type="text" name="adresse" value="<?php if(isset($_POST['adresse'])){echo htmlentities($_POST['adresse'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <label for="avatar">Image perso<span class="small">(facultatif)</span></label><input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <input type="submit" value="Envoyer" />
                </div>
    </form>
</div>
<?php
}
?>  
</aside>

      <?php
include ('../menu2.php');
?>            