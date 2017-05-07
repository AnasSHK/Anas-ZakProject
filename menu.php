<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['auth'])) {
	$user_type = $_SESSION['auth']->type;
}
?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="menu.css">
   <link rel="stylesheet" href="projetweb.css"/>
   <link href="Paper.css" rel="stylesheet">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="menu.js"></script>
   <title>e-Shopping</title>
</head>
<body style ="margin:40;">

<center><h1>Bienvenue sur e-Shopping</h1></center>

<center>
	<div id='cssmenu'>
		<ul>
		
			<!--<li class='active has-sub' ><a href='accueil.php'>Home</a></li>-->
			<li><a href='Produits.php'>Les Produits</a></li>
			<li ><a href='Panier.php'>Mon Panier</a></li>
			<?php if (isset($_SESSION['auth'])): ?>
				<li><a href='account.php'>Mon compte</a></li>
				<?php if ($user_type=='admin'): ?>
					<li><a href='Administration.php'>Administration</a></li>
				<?php endif ?>
				<li><a href='Deconnexion.php'>Déconnexion</a></li>
				
			<?php else: ?>
				<li><a href='Connexion.php'>Connexion</a></li>
				<li><a href='Inscription.php'>S'inscrire</a></li>
			<?php endif ?>
		</ul>
	</div>
</center>

<div class="container"> 
	<?php if( isset( $_SESSION['flash'] ) ) { 
		foreach($_SESSION['flash'] as $type => $message) { 
			echo "<br /><div class=\"alert alert-$type\"> $message </div>";
		} 
		unset($_SESSION['flash']); } ?> 
</div>