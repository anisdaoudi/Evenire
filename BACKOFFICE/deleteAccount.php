<?php
include '../pdo.php';
$userId = $_GET['id'];


$query = $pdo->prepare('DELETE FROM compte WHERE id_utilisateur = ?');
$query->execute([$userId]);

header('location:./users.php');