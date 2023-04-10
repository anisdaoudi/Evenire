<?php
session_start(); 
?>

<div>
    <nav class="navbar-edit navbar navbar-expand-lg position-fixed w-100 navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bolder mx-4 py-3" href="#">Evenire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item pe-4">
                        <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="#">Reservation</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="#">Favoris</a>
                    </li>
                    <li class="nav-item dropdown pe-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Evenements
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item pe-4" href="#">Concerts</a></li>
                            <li><a class="dropdown-item pe-4" href="#">Spectacle</a></li>
                            <li><a class="dropdown-item pe-4" href="#">Theatre</a></li>
                        </ul>
                    </li>
                    <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                </ul>
                <form class="d-flex" role="search">
                <?php
                    if(isset($_SESSION['userEmail'])){
                        echo '<a href="./backoffice/index.php">Bienvenue '. $_SESSION['username'] ."</a>";
                        echo '<a href ="./controller/logout.php"class="btn btn-outline-success btn-order">se deconnecter</a>';

                    }else{
                        echo '<a href ="connexion.php"class="btn btn-outline-success btn-order">Connexion</a>';
                        echo '<a href="inscription1.php" class="btn btn-outline-success btn-order">Inscription</a>';
                    }
                ?>
                    
                    
                </form>
            </div>
        </div>
    </nav>
</div>