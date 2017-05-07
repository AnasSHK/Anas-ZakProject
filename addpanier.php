<?php
require 'Header.php';
if(isset($_GET['id'])){
	$product = $DB->query('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
	if(empty($product)){
		$json['message'] = "Ce produit n'existe pas";
	}else{
		$panier->add($product[0]->id);
		echo('Le produit a bien été ajouté à votre panier!');
	}
}else{
	$json['message'] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
}

