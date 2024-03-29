<?php
@session_start();
$title = "Schedule";
include "../includes/header.php";
include "../includes/search.php";
?>
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
    <?php if (!is_null($_SESSION['user']['pass'])) { ?>
        <section class="section-planning">
            <div class="date-selection">
                <form action="" method="get">
                    <input class="fade" type="datetime-local" require name="date-begin" id="">
                    <input class="fade" type="datetime-local" require name="date-end" id="">
                    <input type="submit" value="Search" name="check-date">
                </form>
                <div class="error">
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
                </div>
            </div>
            <div class="display-planning">

                <?php
                foreach ($rowplanning as $key => $row) { ?>

                    <div class="card-movie">
                        <div class="card-img">
                            <img class="all-img" src="../assets/movie<?=rand(1,23);?>.jpg" alt="">
                        </div>
                        <div class="card-description">
                            <div class="text-info">
                                <div class="plane">
                                    <p><span class="desc">Room</span> : <?= $row['room'] ?> </p>
                                    <p><span class="desc">Title</span> : <?= $row['title'] ?></p>
                                </div>
                                <div class="plane">
                                    <p><span class="desc">Available</span> : <?= $row['date_begin'] ?></p>
                                    <p><span class="desc">Duration</span> : <?= $row['duration'] ?>min</p>
                                </div>
                                <div class="plane">
                                    <p><span class="desc">Release</span> : <?= $row['release_date'] ?></p>
                                    <p><span class="desc">Director</span> : <?= $row['director'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


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