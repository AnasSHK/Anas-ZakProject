<?php

require 'Header.php';
?>
<script>
	$(document).ready(function() {
		$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
		$('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
	});
</script>
<link rel="stylesheet" href="menu.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="projetweb.css"/>
   <link href="Paper.css" rel="stylesheet">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="menu.js"></script>
   <script src="js/jquery-3.2.1.js"></script>   
   <script src="js/bootstrap.min.js "></script>  
<br> <br>
<div class="home">
	<div class="row">
		<div class="wrap">
		
		<form action=href="Produits.php">
		<input type="text" name="recherche" value="" />
		<input type="submit" value="Rechercher" /> <br> <br> <br>
		</form>
		
			<?php 
			if(isset($_GET['recherche'])){
				$products = $DB->query('SELECT * FROM products where categorie="ordinateur"');
			}
			else{
				$products = $DB->query('SELECT * FROM products'); 
				}
			?>
			<div class="container">
				<div class="well well-sm">
					<strong>Trier en :&nbsp;</strong>
					<div class="btn-group">
						<a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
						</span>Liste</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span>Grille</a>
					</div>
				</div>
			<?php foreach ( $products as $product ): ?>
				<div id="products" class="row list-group">
					<div class="item  col-xs-4 col-lg-4">
						<div class="thumbnail">
							<img class="group list-group-image" src="img/<?= $product->id; ?>.jpg" alt="" />
							<div class="caption">
								<h4 class="group inner list-group-item-heading">
									<?= $product->name; ?></h4>
								<p class="group inner list-group-item-text">
									<?= $product->description; ?></p>
								<div class="row">
									<div class="col-xs-12 col-md-6">
										<p class="lead">
											<?= number_format($product->price,2,',',' '); ?> €</p>
									</div>
									<div class="col-xs-12 col-md-6">
										<a class="btn btn-success" href="addpanier.php?id=<?= $product->id; ?>">Ajouter au panier</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			</div>
			
		</div>
	</div>
</div>
<?php
require('footer.php');
?>