<?php
require('../pdo.php');


$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$birthdate = $_POST['birth'];
$username = $_POST['username'];

// Vérifier si l'e-mail existe
$query = $pdo->prepare( "select * from compte where email = ?;");
$query->execute([$email]);

$emailArray = $query->fetchAll();

if(count($emailArray) > 0){
    header("location:../inscription1.php?error=emailExists");  
    exit();
} 

// Hasher le mot de passe 
$password = hash('sha256',$password);

// Insertion des données
$query = $pdo->prepare( "INSERT INTO compte (abonnements,nb_abonnés,date_de_naissance,mdp,certification,email,pseudo)
                         VALUES (0,0,?,?,0,?,?)");
$query->execute([$birthdate,$password,$email,$username]);

header("location:../connexion.php");  