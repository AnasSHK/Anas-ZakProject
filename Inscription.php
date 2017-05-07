




<?php 
require_once 'Fonctions.php';
session_start();
if(!empty($_POST)){
	$errors = array();
    require_once 'ConnectionBD.php';
	
	if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
		$errors['username']= "Pseudo non valide";
	} else {
		$req = $bd->prepare('SELECT id FROM users WHERE username = ?');
		$req->execute([$_POST['username']]);
		$user = $req->fetch();
		if($user){
			$errors['username'] = 'ce pseudo est déjà utilisé';
		}
	}
	
	if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email']= "email non valide";
	}else {
		$req = $bd->prepare('SELECT id FROM users WHERE email = ?');
		$req->execute([$_POST['email']]);
		$user = $req->fetch();
		if($user){
			$errors['email'] = 'cet email est déjà utilisé';
		}
	}
	
	if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
		$errors['password']= "mot de passe vide ou non correspondants";
	}
	
	if(empty($errors)){
		$req = $bd->prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$req->execute([$_POST['username'], $password, $_POST['email']]);
		header('Location: Connexion.php');
		$_SESSION['flash']['success'] = 'Votre compte a bien été crée';
	}
}
?>

<?php
require('menu.php');
?>

<h2>S'inscrire</h2>

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
		<label for="">Pseudo</label>
		<input type="text" name="username" class="form-control" />
	</div>

	<div class="form group">
		<label for="">Email</label>
		<input type="text" name="email" class="form-control" />
	</div>
	
	<div class="form group">
		<label for="">Mot de passe</label>
		<input type="password" name="password" class="form-control" />
	</div>
	
	<div class="form group">
		<label for="">Confirmer Mot de passe</label>
		<input type="password" name="password_confirm" class="form-control"/>
	</div>
	
	<button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
<?php require 'footer.php'; ?>