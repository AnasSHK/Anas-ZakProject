




<?php 
require_once 'Fonctions.php';
session_start();
if(!empty($_POST)){
	$errors = array();
    require_once 'ConnectionBD.php';
	
	if(empty($_POST['nom'])) {
		$errors['nom']= "Veuillez entrer le nom de l'article";
	} else {
		$req = $bd->prepare('SELECT id FROM products WHERE name = ?');
		$req->execute([$_POST['nom']]);
		$article = $req->fetch();
		if($article){
			$errors['nom'] = 'Ce produit existe déjà';
		}
	}
	
	if(empty($_POST['prix']) ) {
		$errors['prix']= "Entrez un prix";
	}
	
	if(empty($errors)){
		$req = $bd->prepare("INSERT INTO products SET name = ?, price = ?, categorie = ?, description = ?");
		$req->execute([$_POST['nom'],  $_POST['prix'], $_POST['categorie'], $_POST['description']]);
		header('Location: Administration.php');
		$_SESSION['flash']['success'] = 'Un nouvel article a été ajouté';
	}
}
?>

<?php
require('menu.php');
?>

<h2>Ajouter un article</h2>

<?php if(!empty($errors)): ?>
	<div class="alert alert-danger">
		<p>Vous n'avez pas correctement rempli le formulaire</p>
		<ul>
		<?php foreach($errors as $error): ?>
			<li><?=$error; ?></li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

<form action="" method="POST" >

	<div class="form group" >
		<label for="">Nom de l'article</label>
		<input type="text" name="nom" class="form-control" />
	</div>

	<div class="form group">
		<label for="">Prix</label>
		<input type="number" step="0.01" name = "prix" class="form-control" />
	</div>
	
	<div class="form group" >
		<label for="">Catégorie</label>
		<input type="text" name="categorie" class="form-control" />
	</div>
	
	<div class="form group" >
		<label for="">Description</label>
		<input type="text" name="description" class="form-control" />
	</div>
	
	<button type="submit" class="btn btn-primary">Ajouter l'article</button>
</form>
<?php require 'footer.php'; ?>