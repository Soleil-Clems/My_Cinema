<?php
require "db.php";

$sqlu = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription  WHERE subscription.name IS NULL";
$query = $db->query($sqlu);
$totalUser = $query->fetchAll(PDO::FETCH_ASSOC);
$no_pass = count($totalUser);


$sql = "SELECT * FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
WHERE subscription.name ='VIP'";
$req = $db->query($sql);
$req->execute();
$rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_vip = count($rowUsersCount);


$sql = "SELECT * FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
WHERE subscription.name ='GOLD'";
$req = $db->query($sql);
$req->execute();
$rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_gold = count($rowUsersCount);


$sql = "SELECT * FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
WHERE subscription.name ='Classic'";
$req = $db->query($sql);
$req->execute();
$rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_classic = count($rowUsersCount);


$sql = "SELECT * FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
WHERE subscription.name ='Pass Day'";
$req = $db->query($sql);
$req->execute();
$rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_day = count($rowUsersCount);


$sql = "SELECT DATE_FORMAT(movie_schedule.date_begin, '%Y-%m') AS mois_programmation, COUNT(movie.id) AS nombre_films_programmes FROM movie JOIN movie_schedule ON movie.id = movie_schedule.id_movie GROUP BY mois_programmation ORDER BY mois_programmation";
$req = $db->query($sql);
$req->execute();
$rowmovieCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_mois =$rowmovieCount;

$sql = "SELECT room.name AS nom_salle, COUNT(movie.id) AS nombre_films_programmes FROM room LEFT JOIN movie_schedule ON room.id = movie_schedule.id_room LEFT JOIN movie ON movie_schedule.id_movie = movie.id GROUP BY room.id ORDER BY room.name";
$req = $db->query($sql);
$req->execute();
$rowroomCount = $req->fetchAll(PDO::FETCH_ASSOC);
$nb_room = $rowroomCount;

$datas = json_encode(array(
    "vip" => $nb_vip,
    "gold" => $nb_gold,
    "classic" => $nb_classic,
    "no_pass" => $no_pass,
    "day" => $nb_day,
    "mois" => $nb_mois,
    "rooms" => $nb_room,
));