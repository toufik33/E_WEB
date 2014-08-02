


<?php 
 
include "config.php"; 
?>
<?php 

session_start();
if (isset($_SESSION["manager"])) {
    header("location: index.php"); 
    exit();
}
?>
<?php
include "menu_admin1.php";
?>
			<?php 

if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); 
    
    include "config.php"; 
    $sql = mysql_query("SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1"); // query the person
    
    $existCount = mysql_num_rows($sql); 
    if ($existCount == 1) { 
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: index.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>
<div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Connexion pour gerer le magasin</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php">
        Pseudo:<br />
          <input name="username" type="text" id="username" size="40" />
        <br /><br />
        mot de passe:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
       
         <input type="submit" name="button" id="button" value="Connexion" />
       
      </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  <br />
  </div>
<?php
include "menu_admin2.php";
?>