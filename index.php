
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Evenire</title>

</head>
<body>
    <?php include './header.php' ?>

    <section class="banner d-flex justify-content-center align-items-center pt-5 ">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <h1 class="text-uppercase py-3 poppins banner-description">
                        Bienvenu sur EVENIRE
                    </h1>
                    <p>
                        <button class="btn btn-outline-info btn-lg rounded-0 Poppins">Liste des evenements</button>
                    </p>  
                </div>
            </div>
        </div>
    </section>

    <section class="available poppins py-5">
        <div class="container">
            <div class="row">
                <div class="card mb-3 border-0 rounded-0">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="assets/images/concerts.jpg" class="img-fluid rounded-start" alt="Concerts">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Concerts</h5>
                                <p class="card-text">Assistez à des concerts inoubliables avec notre programmation musicale variée ! Pop, classique, hip-hop, musiques du monde et rock sont au rendez-vous. Découvrez les plus grands artistes du moment, des stars internationales aux musiciens locaux, et vivez des soirées mémorables dans une ambiance conviviale. Réservez dès maintenant !.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-5 border-0 rounded-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Spectacles</h5>
                                <p class="card-text">Envie de rire et de passer une soirée légère ? Venez découvrir notre sélection de spectacles de comédie ! Des humoristes de renom et des talents émergents vous feront vivre des moments hilarants avec des sketches déjantés, des imitations savoureuses et des jeux de mots improbables. Rire garanti !</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="assets/images/spectacles.jpg" class="img-fluid rounded-start" alt="Spectacles">
                        </div>
                    </div>
                </div>
                <div class="card mb-3 border-0 rounded-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                                        aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/images/theatre.jpg" class="d-block w-100" alt="Theatre">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/images/spectacles.jpg" class="d-block w-100" alt="Spectacle">
                                    </div>
                                    <div class="carousel-item active">
                                        <img src="assets/images/theatre.jpg" class="d-block w-100" alt="Theatre">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Theatre</h5>
                                <p class="card-text">Découvrez notre saison théâtrale ! Nous avons sélectionné pour vous des spectacles de qualité qui sauront vous faire rire, pleurer, réfléchir et vous émouvoir. Du théâtre classique aux créations contemporaines, nos artistes talentueux vous offriront des moments de théâtre intenses et inoubliables. Réservez dès maintenant vos places !.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

<footer class="footer">
    <nav class="footer-nav">
        <a class="nav-link" href="#">Accueil</a>
        <a class="nav-link" href="#">Evenements</a>
        <a class="nav-link" href="profile.php">Profil</a>
    </nav>
</footer>
</html>