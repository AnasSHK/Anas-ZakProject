<?php
session_start();
require 'menu.php';
?>

    <h2>Bonjour <?= $_SESSION['auth']->username; ?></h2>

	<ul class="nav nav-pills nav-stacked">
	  <li class="active"><a href="AjoutAdmin.php">Ajouter des administrateurs</a></li>
	  <li><a href="AjoutArticle.php">Ajouter un article</a></li>
	  <li><a href="AdminCommandes.php">Gérer les commandes</a></li>
	</ul>


<?php require 'footer.php'; ?>