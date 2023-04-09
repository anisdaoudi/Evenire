<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Evenire</title>

</head>
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
                            <h2>Créer un compte</h2>
                        </div>
                        <div id="" class='row rounded mt-2 ns-b-azalea'>
    
                        </div>
                        <div>
                            <?php 
                                if(isset($_GET['error']) && $_GET['error'] == 'emailExists' )
                                {
                                    echo '<p class="error">Email déja utilisé </p>';
                                }
                            ?>
                            <form method="POST" action="./controller/signup.php">
                                <div>
                                    <label for="email">Adresse E-mail :</label>
                                    <input id="email" class="form-control" type="email" name="email" required="required">
                                </div>

                                <div>
                                    <label for="username">Pseudo :</label>
                                    <input id="username" class="form-control" type="text" name="username" required="required">
                                </div>
                                <div>
                                    <label for="pasword">Mot de passe :</label>
                                    <input id="pasword" class="form-control" type="password" name="password" required="required">
                                </div>
                                <div>
                                    <label for="password-v">Confirmation :</label>
                                    <input id="password-v" class="form-control" type="password" name="password-v" required="required">
                                </div>
                                <div>
                                    <label for="birth">Date de naissance :</label>
                                    <input id="birth" class="form-control" type="date" name="birth" required="required">
                                </div>
                                <div class="align-self-center">
                                    <div class="form-check d-none">
                                        <input id="" class="form-check-input " type="checkbox" name="newsletter">
                                        <label for="" class="form-check-label">Newsletter</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="" class="form-check-input" type="checkbox" name="cgu" required="required">
                                        <label for="" class="form-check-label">Conditions générales d'utilisation</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="" class="form-check-input" type="checkbox" name="newsletter" required="required">
                                        <label for="" class="form-check-label">Newsletter</label>
                                    </div>
                                </div>
                                <button class="form-control btn btn-outline-info btn-lg rounded-0 Poppins" type="submit">S'inscrire</button>
                            </form>
                        </div>
                        <div class="row">
                            <p>Tu as déja un compte ? <a href="connexion.html" class="text-light">Se connecter</a></p>
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