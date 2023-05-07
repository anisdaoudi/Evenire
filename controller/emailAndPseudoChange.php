<?php
    session_start();
    include "../pdo.php";
    include "../functions.php";
    

    $userId = $_SESSION['userId'];

    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];

    if(empty($newEmail))
    {
        $newEmail = $_SESSION['userEmail'];
    }

    if (empty($newUsername)) {
        $newUsername = $_SESSION['username'];
    }
    $query = $pdo->prepare('UPDATE compte SET email=? , pseudo=? WHERE id_utilisateur = ?');
    $query->execute([$newEmail,$newUsername,$userId]);

    reloadSessionAfterUpdate($pdo);

    header('location:../profile.php')
?>