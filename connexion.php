<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Evenire</title>

</head>
<body>
    <?php include 'header.php' ?>


    <section class="banner d-flex justify-content-center align-items-center pt-5 navbar-edit text-light">
        <div>
            <div class="row min-vh-100">
                <div>
                    <div class="container pt-5 pb-3 d-flex flex-column align-items-center justify-content-around">
                        <div class="row pb-3">
                            <img src="assets/images/Logo.jpg" alt="logo evenire" class="logo-auth">
                        </div>
                        <div class="row">
                            <h2>Connexion</h2>
                        </div>
                        <div class='row rounded mt-2 ns-b-azalea ns-text-red'>
                        </div>
                        <div>
                            <form method="POST" action="./controller/login.php">
                                <div>
                                    <label for="email">Adresse E-mail :</label>
                                    <input id="email" class="form-control" type="email" name="email" required="required">
                                </div>
                                <div>
                                    <label for="pasword">Mot de passe :</label>
                                    <input id="pasword" class="form-control" type="password" name="password" required="required">
                                </div>
                                </div>
                                <button class="form-control w-100 w-md-50 mx-auto mt-4 btn btn-outline-info btn-lg rounded-0 Poppins" type="submit">Se connecter</button>
                            </form>
                        </div>
                        <div class="row">
                            <p>Tu n'as pas de compte ? <a href="inscription1.php" class="text-light">S'inscrire</a></p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

<footer>
    <nav class="nav flex-row">
        <a class="nav-link" href="index.html">Accueil</a>
        <a class="nav-link" href="#">Evenements</a>
        <a class="nav-link" href="#">Profil</a>
        <a class="nav-link" href="#">Contact</a>
    </nav>

</footer>
</html>