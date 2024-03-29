<?php
@session_start();
$title = "Dashboard";
include "../includes/header.php";
include "../includes/search.php";
if (!isset($_GET['user'])) {
    $_GET['user'] = '';
}
?>


<section class="dashboard-section">
    <div class="dashboard-container">
        <div class="dashboard-left">
            <a href="stat.php" class="dashboard no-bg"><i class="fa-solid fa-chart-line"></i></a>
        </div>
        <div class="dashboard-center">
            <div class="filter">

                <form action="" method="get">
                    <input type="text" name="user" placeholder="rechercher un user">
                    <?php
                        if (isset($_GET['filter']) && !empty($_GET['filter'])) {?>
                            <select name="filter" hidden id="">
                                <option value="<?= $_GET['filter'] ?>"selected></option>
                            </select>
                        <?}?>
                    
                    <input type="submit" name="submitUser">
                </form>
                <form action="" method="get">
                    <select name="filter" id="" onchange="this.form.submit()">
                        <option>Filter</option>
                        <option value="ALL">All</option>
                        <option value="employee">Employee</option>
                        <option value="VIP">VIP</option>
                        <option value="GOLD">GOLD</option>
                        <option value="Classic">Classic</option>
                        <option value="Pass Day">Pass day</option>
                        <option value="no_pass">No pass</option>


                    </select>

                </form>
            </div>
            <div class="center-top">
                <?php foreach ($rowUsers as $row) { ?>
                    <a href="profil.php?searchid=<?= $row['id'] ?>">
                        <div class="mini-card">
                            <div class="mini-head">
                                <div class="mini-img">
                                    <img src="../assets/<?= rand(1, 10); ?>.jpg" alt="Profil">
                                </div>
                            </div>
                            <div class="mini-body">
                                <p><?= $row['id']; ?></p>
                                <p><?= $row['firstname'] . ' ' . $row['lastname']; ?></p>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <div class="pagination">
                <?php if ($nb_pages > 1) : ?>

                    <?php if ($page > 1) :
                        if (isset($_GET['filter'])) {
                    ?>
                            <a href="?user=<?= $_GET['user'] ?>&page=<?= $page - 1 ?>&filter=<?= $_GET['filter'] ?>">Précédent</a>
                        <?php } else {
                            $_GET['filter'] = '';
                        ?>
                            <a href="?user=<?= $_GET['user'] ?>&page=<?= $page - 1 ?>&filter=<?= $_GET['filter'] ?>">Précédent</a>
                        <?php } ?>
                    <?php endif; ?>

                    <?php
                    $max_links = 5;
                    $start = max(1, $page - floor($max_links / 2));
                    $end = min($start + $max_links - 1, $nb_pages);

                    for ($i = $start; $i <= $end; $i++) :
                        if (isset($_GET['filter'])) {
                    ?>
                            <a href="?user=<?= $_GET['user'] ?>&page=<?= $i ?>&filter=<?= $_GET['filter'] ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                                <?= $i ?>
                            <?php  } else {
                            $_GET['filter'] = '';
                            ?>

                                <a href="?user=<?= $_GET['user'] ?>&page=<?= $i ?>&filter=<?= $_GET['filter'] ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                                    <?= $i ?>
                                <?php  } ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($page < $nb_pages) :
                                if (isset($_GET['filter'])) { ?>
                                    <a href="?user=<?= $_GET['user'] ?>&page=<?= $page + 1 ?>&filter=<?= $_GET['filter'] ?>">Suivant</a>
                                <?php  } else { ?>
                                    <a href="?user=<?= $_GET['user'] ?>&page=<?= $page + 1 ?>">Suivant</a>
                                <?php  } ?>
                            <?php endif; ?>

                        <?php endif; ?>
            </div>

        </div>
        <div class="dashboard-right">
            <div class="program-container">
                <h2>Schedule a film session</h2><br>
                <div class="form-container">
                    <form action="" method="get">
                        <input type="text" required name="movie" placeholder="Enter your movie">
                        <button type="submit" name="searchProgramMovie">Search</button>

                    </form><br>
                    <form action="" method="get">
                        <select name="scheduleMovie" required id="scheduleSelect">

                            <?php foreach ($rowMovie as $row) { ?>
                                <option value="<?= $row['id']; ?>"><?= $row['title']; ?></option>
                            <?php } ?>
                        </select>
                        <select name="room" required id="roomSelect">

                            <?php foreach ($roomInfo as $row) { ?>
                                <option value="<?= $row['id']; ?>"><?= $row['salle']; ?></option>
                            <?php } ?>
                        </select><br><br>
                        <input type="datetime-local" name="hours" id=""><br><br>
                        <button type="submit" name="programMovie">Add</button>
                        <div>

                        </div><br><br>
                    </form>
                    <div class="error"><?php if (isset($msg)) {
                                            echo $msg;
                                        } ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../includes/footer.php"
?>