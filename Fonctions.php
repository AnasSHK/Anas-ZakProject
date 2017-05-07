
<?php

require('connectionBD.php');



function debug($variable) {
	echo '<pre>' . print_r($variable, true) . '</pre>';
}

function reconnect_from_cookie(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
        if(!isset($bd)){
            global $bd;
        }
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $bd->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ratonlaveurs');
            if($expected == $remember_token){
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
    }
}

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: connexion.php');
        exit();
    }

}
/*
function payer(){
	logged_only();
	$user_id = $_SESSION['auth']->id;
						$req =bd->prepare("INSERT INTO commandes SET price = ?, idclient=?");
						$req->execute([$panier->total() * 1.196, $user_id]);
						echo('La commande a été effectuée');
	
}
*/



