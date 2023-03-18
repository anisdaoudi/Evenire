<?php

function writeLogLine($success, $email){
    $log = fopen('log.txt', 'a+');

    $line = date('Y/m/d - H:i:s') . ' - Tentative de connexion' . ($success?'réussie':'échouée') . 'de : ' . $email . "\n";

    fputs($log, $line);

    fclose($log);
}

if(isset($_POST['email']) && !empty($_POST['email'])){
    setcookie('email', $_POST['email'], time() + (24 * 3600));
}


if(!isset($_POST['email'])
    || !isset($_POST['pwd'])
    || empty($_POST['email'])
    || empty($_POST['pwd']))
    {
        $msg = 'Vous devez remplir les 2 champs.';
        header('location: connexion.php?message=' . $msg);
        exit();
    }


if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $msg = 'Email invalide.';
    header('location: connexion.php?message=' . $msg);
    exit();
}


try{
    $bdd = new PDO('mysql:host=localhost;dbname=evenire', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){
    die('Erreur PDO:' . $e->getMessage());
}

$q = 'SELECT id FROM users WHERE email = :email AND password = :password';
$req = $bdd->prepare($q);
$req->execute([
                'email' => $_POST['email'],
                'password' => hash('sha256', $_POST['pwd'])
                ])

$result = $req->fetch();
if(!$result){

    
    writeLogLine(false, $_POST['email']);
    
    $msg = 'Identifiants incorrects.';
    header('location: connexion.php?message=' . $msg);
    exit();
}


session_start();
$_SESSION['email'] = $_POST['email'];

writeLogLine(true, $_POST['email']);

header('location: index.php');
exit();

?>