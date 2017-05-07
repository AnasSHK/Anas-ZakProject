<?php
require 'Header.php';

 ?>
<link rel="stylesheet" href="menu.css">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="projetweb.css"/>
   <link href="Paper.css" rel="stylesheet">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="menu.js"></script>
   <script src="js/jquery-3.2.1.js"></script>   
   <script src="js/bootstrap.min.js "></script>  
   
   
<div class="checkout">
	<div class="title">
		<div class="wrap">
		<h2 class="first">Votre Panier</h2>
		</div>
	</div>
	<form method="post" action="panier.php">
	<div class="table">
		<div class="wrap">
			
			<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th class="text-center">Prix H.T.</th>
                        <th class="text-center">Prix T.T.C</th>
                        <th> </th>
                    </tr>
                </thead>

			<?php
			$ids = array_keys($_SESSION['panier']);
			if(empty($ids)){
				$products = array();
			}else{
				$products = $DB->query('SELECT * FROM products WHERE id IN ('.implode(',',$ids).')');
			}
			foreach($products as $product):
			?>
			<tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?= $product->name; ?></a></h4>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="text" name="panier[quantity][<?= $product->id; ?>]" class="form-control" id="exampleInputEmail1" value="<?= $_SESSION['panier'][$product->id]; ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?= number_format($product->price,2,',',' '); ?> €</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?= number_format($product->price * 1.196,2,',',' '); ?> €</strong></td>
                        <td class="col-sm-1 col-md-1">
                        <span class="action">
					<a href="panier.php?delPanier=<?= $product->id; ?>" class="del"><img src="img/del.png">Remove</a></span>
                        </td>
                    </tr>
			<?php endforeach; ?>
			<tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Total</h5></td>
                        <td class="text-right"><h5><strong><?= number_format($panier->total() * 1.196,2,',',' '); ?> € </strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Recalculer
                        </button></td>
                        <td>
						<form action=""  method="post">
                        <button type="submit" name="commande" class="btn btn-success"> 
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button>
						</form>
						</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
		</div>
	</div>
	</form>
</div>
<?php
require('footer.php');
?>