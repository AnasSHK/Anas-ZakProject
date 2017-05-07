<?php
require 'menu.php';
?>

    <h2>Bonjour <?= $_SESSION['auth']->username; ?></h2>

	<ul class="nav nav-pills nav-stacked">
	  <li class="active"><a href="ModifCompte.php">Modifier mes informations</a></li>
	  <li><a href="Commandes.php">Mes Commandes</a></li>
	</ul>


<?php require 'footer.php'; ?>