<?php
require '../pdo.php';



$email = $_POST['email'];
$password = $_POST['password'];

$hashed_pwd = hash('sha256',$password);

$query = $pdo->prepare("SELECT * FROM compte where email =? and mdp=?");
$query->execute([$email,$hashed_pwd]);

$data = $query->fetchAll();

if(count($data) == 0){
    die("Ce compte n'existe pas");
}else{
    header("location:../index.php");  
}

echo ("<pre>");
var_dump($data);
echo ("</pre>");