<?php
include "../includes/logconfig.php";
include "../includes/search.php";
$title = "Profil";
include "../includes/header.php";
?>
<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if (isset($_GET['searchid'])) {
        $user = $userInfos;
    } else {

        $user = $_SESSION['user'];
    }

?>


    <section id="section-profil">
        <div class="hystory-container">

            <div class="history">
                <h2>Historical</h2>
                <div class="allmovies">
                    <?php
                    $total = count($user['movie_history']) - 1;
                    for ($total; 0 < $total; $total--) {
                        $titre = $user['movie_history'][$total]['title'];
                        echo "<p>$total - $titre  </p><br>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="profil-card">
            <div class="head-card">
                <div class="head-profil">
                    <div class="profil-img">
                        <img src="../assets/<?= rand(1, 10); ?>.jpg" alt="">
                    </div>

                    <div class="info-perso">
                        <h2 id="username"><?= $user['firstname'] . ' ' . $user['lastname'] ?></h2>
                        <p><?= $user['job'] ?></p>
                    </div>

                </div>
                <div class="show-pass">
                    <span><i class="fa-solid fa-circle-check"></i>

                        <?php
                        if (is_null($user['pass'])) {
                            echo "No Pass";
                        } else {
                            echo $user['pass'];
                        } ?>
                    </span>
                </div>
            </div>
            <div class="body-card">
                <div class="basic-info">
                    <div class="info-title">E-mail :</div>
                    <div class="info-description"><i class="fa-solid fa-at"></i> <?= $user['email'] ?></div>
                </div>
                <div class="basic-info">
                    <div class="info-title">About :</div>
                    <div class="info-description"><i class="fa-solid fa-address-card"></i> <?php if (is_null($user['job_description'])) {
                                                                                                echo "No Job";
                                                                                            } else {
                                                                                                echo $user['job_description']; ?>
                            <?php if ((isset($_GET['searchid']) && $_SESSION['user']['role'] == 1)) {  ?>
                                <form action="" method="post">
                                    <select name="job" id="" onchange="this.form.submit()">
                                        <option>Job list</option>
                                        <?php
                                                                                                    foreach ($rowJob as $key => $value) {  ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php }
                                                                                                } ?>

                                    </select>
                                    <select name="searchid" hidden id="">
                                        <option value="<?= $_GET['searchid'] ?>" selected></option>
                                    </select>
                                </form>
                            <?php } ?>
                    </div>

                </div>
                <?php
                if (!is_null($user['job_description'])) { ?>
                    <div class="basic-info">
                        <div class="info-title">Salary :</div>
                        <div class="info-description"><i class="fa-solid fa-dollar-sign"></i><?= $user['salary'] ?> </div>
                    </div>

                <?php } ?>
                <div class="basic-info">
                    <div class="info-title">Subscription :</div>
                    <div class="info-description"><i class="fa-solid fa-ticket"></i> <?php if (is_null($user['pass_description'])) {
                                                                                            echo "No Pass";
                                                                                        } else {
                                                                                            echo $user['pass_description'];
                                                                                        } ?>

                    </div>
                </div>
                <div class="basic-info">
                    <div class="info-title">Country :</div>
                    <div class="info-description"><i class="fa-solid fa-earth-africa"></i> <?= $user['country'] ?></div>
                </div>
                <div class="basic-info">
                    <div class="info-title">City :</div>
                    <div class="info-description"><i class="fa-solid fa-location-dot"></i> <?= $user['city'] ?></div>
                </div>
                <?php if ((isset($_GET['searchid']) && $_SESSION['user']['role'] == 1) || $_SESSION['user']['role'] == 1) {  ?>
                    <div class="basic-info">
                        <div class="info-title">
                            <form action="" method="POST">
                                <input type="text" name="useridpass" value="<?= $user['id'] ?>" hidden>
                                <input type="text" name="actualpass" value="<?= $user['pass'] ?>" hidden>
                                <select name="addPass" id="">
                                    <option value="4"><a href="#">Pass Day</a></option>
                                    <option value="3">Classic</option>
                                    <option value="2">GOLD</option>
                                    <option value="1">VIP</option>
                                    <?php if (isset($_GET['searchid']) && !is_null($user['pass'])) {  ?>
                                        <option value="0">Remove</option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="info-description">
                            <input type='submit' name='changepass' value="<?php if (is_null($user['pass'])) {
                                                                                echo " Add pass";
                                                                            } else {
                                                                                echo "Modify pass";
                                                                            } ?>" class="same-btn" id="profile-btn">
                        </div>
                    </div>
                    </form>
                <?php } ?>
            </div>
            <?php if (!isset($_GET['searchid'])) {  ?>
                <div class="footer-card"><a href="logout.php" class="same-btn">Logout</a></div>
            <?php } ?>
        </div>

    </section>
<?php } else {
    header("Location: login.php");
} ?>

<?php
include "../includes/footer.php";
?>