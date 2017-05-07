<?php


require 'db.class.php';
require 'panier.class.php';
$DB = new DB();
$panier = new panier($DB);
require('menu.php');



?>