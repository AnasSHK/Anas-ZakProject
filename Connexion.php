<?php
session_start();
require_once('Fonctions.php');
reconnect_from_cookie();
if(isset($_SESSION['auth'])){
    header('Location: account.php');
    exit();
}
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
	require('ConnectionBD.php');
    $req = $bd->prepare('SELECT * FROM users WHERE (username = :username OR email = :username)');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
	$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
	if($_POST['remember']){
    $remember_token = str_random(250);
    $bd->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
    setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
}
        header('Location: account.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }
}
?>

<?php require('menu.php'); ?>

    <h2>Se connecter</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="">Mot de passe</label>
            <input type="password" name="password" class="form-control"/>
        </div>



        <button type="submit" class="btn btn-primary">Se connecter</button>

    </form>

<?php require 'footer.php'; ?>