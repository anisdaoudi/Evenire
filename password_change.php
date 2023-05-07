<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Evenire - Profil</title>

</head>
<body>
    <?php include 'header.php' ?>
    
<div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      Account settings
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action" data-toggle="list" href="profile.php">Infos</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="pseudo_email_change.php">Changer le pseudo et l'adresse mail</a>
            <a class="list-group-item list-group-item-action active" data-toggle="list">Changer le mot de passe</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <form action="./controller/passwordReset.php" method="post">

              <div class="form-group">
                


                <label class="form-label">Ancien mot de passe</label>
                <input type="password" class="form-control" name="oldPassword" placeholder="********">
                <?php 
                    if(isset($_GET['error']) && $_GET['error'] == 'wrongPwd')
                    {
                        echo '<p class="error"> Mot de passe erroné </p>';
                    }
                ?>


                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="newPassword" placeholder="********">


                <label class="form-label">Retaper le nouveu mot de passe</label>
                <input type="password" class="form-control" name="passwordConfirm" placeholder="********">


                <?php 
                    if(isset($_GET['error'])){
                      if($_GET['error'] == 'confirmError' || $_GET['error'] == 'emptyfield'){
                        echo '<p class="error"> Entrez et confirmez votre mot de passe </p>';
                      }
                    }
                ?>


              </div>
              <div class="text-right mt-3 text-center pb-3">
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>&nbsp;
              </div>
            </form>              
          </div>
        </div>
    </div>



  </div>