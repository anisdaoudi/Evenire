<!DOCTYPE html>
<?php
    session_start();
    include '../pdo.php';

    $query = $pdo->prepare("SELECT id_utilisateur,email,date_de_naissance,abonnements,nb_abonnés,certification,pseudo,certification FROM compte ORDER BY id_utilisateur DESC  LIMIT 10");
    $query->execute();
    $usersData = $query->fetchAll();
    
    $query = $pdo->prepare("SELECT * FROM evenement limit 10");
    $query->execute();
    $eventsData = $query->fetchAll();
    
    $query = $pdo->prepare("SELECT count(id_utilisateur) FROM compte");
    $query->execute();
    $numberOfAccounts = $query->fetch();

    $query = $pdo->prepare("SELECT count(qr_code) FROM evenement");
    $query->execute();
    $numberOfEvents = $query->fetch();
    

?>
<head>
    <meta charset="utf-8">
    <title>EVENIRE admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->

            <?php include 'sidebar.php' ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
                <?php include './navbar.php' ?>
            <!-- Navbar End -->
            <!-- Users start -->
            

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre d'utilisateurs</p>
                                <h6 class="mb-0"> <?php echo $numberOfAccounts[0] ?> </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Nombre d'evenements</p>
                                <h6 class="mb-0"><?php echo $numberOfEvents[0] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Nouveaux utilisateurs</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Pseudonyme</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Date de naissance</th>
                                            <th scope="col">Abonnements</th>
                                            <th scope="col">Abonnés</th>
                                            <th scope="col">Droits</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($usersData as $key => $user) {
                                        echo '
                                        <tr>
                                            <th scope=/"row/" >'.$user['id_utilisateur'].'</th>
                                            <td>'.$user['pseudo'].'</td>
                                            <td>'.$user['email'].'</td>
                                            <td>'.$user['date_de_naissance'].'</td>
                                            <td>'.$user['abonnements'].'</td>
                                            <td>'.$user['nb_abonnés'].'</td>
                                            <td>'.isAdmin($user['certification']).'</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Evenements recent</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Lieu</th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($eventsData as $key => $event) {
                                        echo '
                                        <tr>
                                            <td>'.$event['date_event'].'</td>
                                            <td>'.$event['lieu'].'</td>
                                            <td>'.$event['designation'].'</td>
                                            <td>'.$event['description'].'</td>
                                            <td>'.$event['prix'].'€ </td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="../index.php">EVENIRE</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://.phpcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://.phpcodex.com">.php Codex</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</.php>