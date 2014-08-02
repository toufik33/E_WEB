<?php 

include "config.php"; 
?>
<?php 

session_start();
if (isset($_SESSION["manager"])) 
{ unset($_SESSION['manager']);}

    header("location: index.php"); 
    exit();

?>