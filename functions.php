<?php
function reloadSessionAfterUpdate($pdo){
    $query = $pdo->prepare('select * from compte where id_utilisateur = ?');
    $query->execute([$_SESSION['userId']]);
    $data = $query->fetch();
    
    $_SESSION['userId'] = $data["id_utilisateur"];
    $_SESSION["userEmail"] = $data['email'];
    $_SESSION["username"] = $data['pseudo'];
    $_SESSION["lastname"] = $data['nom'];
    $_SESSION["firstname"] = $data['prenom'];
    $_SESSION['isAdmin'] = $data['certification'];
    $_SESSION['birthdate'] = $data['date_de_naissance'];

}
