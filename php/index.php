<?php
@session_start();
$title = "Accueil";
include "../includes/header.php";
include "../includes/test.php";

?>
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
    <?php if (!is_null($_SESSION['user']['pass'])) { ?>
        <section class="print-movie-section">

            <div class="searchMovie">

                <form action="" method="get" id="formGender">
                    <select name="genre" id="selectGender" onchange="this.form.submit()">
                        <?php
                        if (isset($_GET['genre'])) {
                            $gen = $_GET['genre'];
                            echo "<option>$gen</option>";
                        } else {
                            echo "<option>Genre</option>";
                        }
                        foreach ($rowGenres as $row) { ?>
                            <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                        <?php } ?>
                    </select>

                </form>

                <form action="" method="get">
                    <select name="distributor" id="distributorSelect" onchange="this.form.submit()">
                        <?php
                        if (isset($_GET['distributor'])) {
                            $dist = $_GET['distributor'];
                            echo "<option>$dist</option>";
                        } else {
                            echo "<option>Distributor</option>";
                        }
                        foreach ($rowDistributors as $row) { ?>
                            <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>

            <div class="banner">
                <div class="banner-container">
                    <iframe allow="fullscreen" frameBorder="0" height="200" src="https://giphy.com/embed/6QRvtQiWvS5qXzaYab/video" width="480"></iframe>
                </div>
            </div>

            <div>

            </div>
        </section>

        <section class="carousel-section">
            <?php
            if (count($rows) > 0) {
                $rowCount = count($rows);
                $itemsPerPage = 8;

                foreach ($views as $key => $view) {
                    if ($key % $itemsPerPage === 0) {
                        if ($key > 0) {
                            echo '</div></div>';
                        }
                        echo '<div class="movie-print"><i class="fa-solid fa-circle-chevron-right arrow-right"></i><i class="fa-solid fa-circle-chevron-left arrow-left"></i><div class="carousel"> ';
                    }
            ?>
                    <a href="movie.php?userhistory=<?= $rows[$key]['id']; ?>&youtube=<?= $view->id->videoId; ?>" class="container-img">
                        <img src="<?= $view->snippet->thumbnails->medium->url; ?>" alt="">
                        <div class="div">
                            <p><?= $rows[$key]['title']; ?></p>
                            <p class="hide">Release: <?= $rows[$key]['release_date']; ?></p>
                            <p class="hide">By: <?= $rows[$key]['director']; ?></p>
                            <p class="hide">Duration: <?= $rows[$key]['duration']; ?>min</p>

                            <?php if (isset($rows[$key]['genre-name'])) { ?>
                                <p class="hide">Genre: <?= $rows[$key]['genre-name']; ?></p>
                            <?php } ?>
                        </div><br><br>
                    </a>
            <?php
                }

                echo '</div>';
            } else {
                echo "<div class='error'>Movie Not found</div>";
            }
            ?>
        </section>

    <?php } else {
        header("Location: profil.php");
    } ?>
<?php } else {
    header("Location: welcome.php");
} ?>
<?php
include "../includes/footer.php"
?>