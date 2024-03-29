<?php
@session_start();
$title = "Movie";
include "../includes/header.php";

?>

<section class="iframe-section">

    <div class="frame">
    <iframe width="1520" height="549" src="https://www.youtube.com/embed/<?=$_GET['youtube']?>" title="Marvel&#39;s Spider-Man 2 - Dépassez vos limites. Ensemble. - VF I PS5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
</section>