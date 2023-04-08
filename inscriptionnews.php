<?php

// Connexion à la base de données


// Récupération de l'adresse e-mail depuis le formulaire

$email = $_POST['email'];

// Vérification si l'adresse e-mail n'est pas déjà inscrite

$stmt = $pdo->prepare('SELECT * FROM newsletter_subscribers WHERE email = ?');
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
  die('Vous êtes déjà inscrit à notre newsletter.');
}

// Insertion de l'adresse e-mail dans la base de données

$stmt = $pdo->prepare('INSERT INTO newsletter_subscribers (email) VALUES (?)');
$stmt->execute([$email]);

// Confirmation de l'inscription

echo 'Merci de vous être abonné à notre newsletter ! Vous ne serez pas déçu.';
?>