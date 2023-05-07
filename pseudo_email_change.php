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
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Changer le pseudo et l'adresse mail</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="password_change.php">Changer le mot de passe</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">

            <form method="post" action="./controller/emailAndPseudoChange.php">
              <div class="tab-pane fade active show" id="account-general">
                <div class="card-body media align-items-center">
                  <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="d-block ui-w-80">
                  <div class="media-body ml-4">
                    <label class="btn btn-outline-primary">
                      Upload new photo
                      <input type="file" class="account-settings-fileinput">
                    </label> &nbsp;
                    <button type="button" class="btn btn-default md-btn-flat">Reset</button>

                    <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                  </div>
                </div>
                <hr class="border-light m-0">

                <div class="tab-content">
                  <div class="form-group">
                    <label class="form-label">Pseudo</label>
                    <input type="text" class="form-control mb-1" name="newUsername" placeholder="Votre nouveau pseudo">
                  </div>

                  <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="text" class="form-control mb-1" name="newEmail" placeholder="Votre nouvelle adresse mail">
                  </div>

                </div>
                
                
              </div>
              <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>&nbsp;
              <div class="text-right mt-3 text-center pb-3">
            </form>
          </div>
    </div>

    </div>
  </div>