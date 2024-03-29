<?php
@session_start();
include "tri.php";
$num = count($rows);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cinema - <?= $title ?? "Découvrez le meilleur du cinéma"; ?></title>
    <meta name="description" content="Explorez My Cinema pour une expérience cinématographique exceptionnelle. Retrouvez les derniers films, horaires de projection et bien plus encore.">
    <meta name="keywords" content="My Cinema, films, horaires, cinéma">
    <meta name="author" content="My Cinema">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="../assets/fav.png" type="image/x-icon">

    
    <meta property="og:title" content="My Cinema - Découvrez le meilleur du cinéma">
    <meta property="og:description" content="Explorez My Cinema pour une expérience cinématographique exceptionnelle. Retrouvez les derniers films, horaires de projection et bien plus encore.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="URL_de_votre_site">
    <meta property="og:image" content="URL_de_l'image_à_afficher_sur_les_réseaux_sociaux">


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="My Cinema - Découvrez le meilleur du cinéma">
    <meta name="twitter:description" content="Explorez My Cinema pour une expérience cinématographique exceptionnelle. Retrouvez les derniers films, horaires de projection et bien plus encore.">
    <meta name="twitter:image" content="URL_de_l'image_à_afficher_sur_Twitter">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/profil.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <?php if ($title == 'Accueil' || $title == 'Schedule') { ?>
        <style>
            body {
                background: rgba(31, 31, 31, 1);
            }
            header{
                background: none;
            }
        </style>
    <?php } ?>
    <?php if ($title == 'Movie') { ?>
        <style>

            header{
                display: none;
            }
        </style>
    <?php } ?>
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <img src="../assets/bg.png" alt="logo Netflix">
        </a>
        <nav>
            <ul>
                <?php if (isset($_SESSION["user"])) { ?>
                    <li><a class="planning" href="../php/planning.php">Schedule</a></li>

                    <li>
                        <form action="" method="get">
                            <input type="text" name="movie" placeholder="Enter your movie">
                            <button type="submit" name="submitMovie"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        <?php if ($_SESSION["user"]['role'] == 1) { ?>
                    <li><a href="dashboard.php" class="no-bg dashboard"><i class="fa-solid fa-sitemap"></i> Dashboard</a></li>
                <?php } ?>
                <li><a class="profil-icon" href="profil.php"><i class="fa-solid fa-user"></i></a></li>
                </li>
            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
            <?php } ?>
            </ul>
        </nav>
    </header>

    <main>