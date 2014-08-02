<?php
include('config.php');
?>
<?php
include ('menu1.php');
?>



<ul class="thumb">
				<li><a href="selection_coq.php"><img src="zoomer/lecoqsportif.jpg" alt="le coq sportif" /></a></li>
				<li><a href="selection_coq.php"><img src="zoomer/lecoqsportif1.jpg" alt="le coq sportif" /></a></li>
				<li><a href="selection_NIKE.php"><img src="zoomer/nike.jpg" alt="Nike" /></a></li>
				<li><a href="selection_NIKE.php"><img src="zoomer/nike1.jpg" alt="Nike" /></a></li>
				<li><a href="selection_adidas.php"><img src="zoomer/adidas.jpg" alt="adidas" /></a></li>
				<li><a href="selection_adidas.php"><img src="zoomer/adidas1.jpg" alt="adidas" /></a></li>
				<li><a href="selection_reebok.php"><img src="zoomer/reebok.jpg" alt="reebok" /></a></li>
				<li><a href="selection_reebok.php.php"><img src="zoomer/reebok1.jpg" alt="reebok" /></a></li>
				<li><a href="selection_puma.php"><img src="zoomer/puma.jpg" alt="Puma" /></a></li>
				<li><a href="selection_puma.php"><img src="zoomer/puma1.jpg" alt="puma" /></a></li>
                <li><a href="selection_kappa.php"><img src="zoomer/kappa.jpg" alt="kappa" /></a></li>
				<li><a href="selection_kappa.php"><img src="zoomer/kappa1.jpg" alt="kappa" /></a></li>		
		
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="zoomer/zoomer.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
 	$('ul.thumb li').Zoomer({speedView:100,speedRemove:300,altAnim:true,speedTitle:300,debug:false});
});
</script>

<?php
include ('menu2.php');
?>