<?php
@session_start();
$title = "Statistiques";
include "../includes/header.php";
?>

<section class="chart">
    <div>
        <canvas id="myChart1"></canvas>
    </div>
    <div>
        <canvas id="myChart2"></canvas>
    </div>
    <div>
        <canvas id="myChart3"></canvas>
    </div>
</section>

<?php
include "../includes/footer.php";
?>