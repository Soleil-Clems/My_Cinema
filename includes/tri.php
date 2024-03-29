<?php
require "db.php";

$sqlgenre = "SELECT * FROM genre";
$reqgenre = $db->prepare($sqlgenre);
$reqgenre->execute();
$rowGenres = $reqgenre->fetchAll(PDO::FETCH_ASSOC);


$sqldistributor = "SELECT * FROM distributor";
$reqdistributor = $db->prepare($sqldistributor);
$reqdistributor->execute();
$rowDistributors = $reqdistributor->fetchAll(PDO::FETCH_ASSOC);

$genre = "Action";
$sql = "SELECT DISTINCT movie.*, genre.name AS 'genre-name'
FROM movie
JOIN movie_genre ON movie.id = movie_genre.id_movie
JOIN genre ON movie_genre.id_genre = genre.id
JOIN movie_schedule ON movie.id = movie_schedule.id_movie
WHERE genre.name = :genre
    AND movie_schedule.date_begin <= NOW()";
$req = $db->prepare($sql);
$req->bindParam('genre', $genre, PDO::PARAM_STR);
$req->execute();
$rows = $req->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["genre"]) && !empty($_GET['genre'])) {
    $genre = filter_input(INPUT_GET, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);
    // $sql = "SELECT * FROM movie
    // JOIN movie_genre ON movie.id = movie_genre.id_movie
    // JOIN genre ON movie_genre.id_genre = genre.id
    // WHERE genre.name = :genre";
    $sql = "SELECT DISTINCT movie.*, genre.name AS 'genre-name'
    FROM movie
    JOIN movie_genre ON movie.id = movie_genre.id_movie
    JOIN genre ON movie_genre.id_genre = genre.id
    JOIN movie_schedule ON movie.id = movie_schedule.id_movie
    WHERE genre.name = :genre
        AND movie_schedule.date_begin <= NOW()";
    $req = $db->prepare($sql);
    $req->bindParam('genre', $genre, PDO::PARAM_STR);
    $req->execute();
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET["distributor"]) && !empty($_GET['distributor'])) {
    $distributor = filter_input(INPUT_GET, 'distributor', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT DISTINCT movie.*
    FROM movie
    JOIN distributor ON movie.id_distributor = distributor.id
    JOIN movie_schedule ON movie.id = movie_schedule.id_movie
    WHERE distributor.name = :distributor
        AND movie_schedule.date_begin <= NOW()";
    $req = $db->prepare($sql);
    $req->bindParam('distributor', $distributor, PDO::PARAM_STR);
    $req->execute();
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET["submitMovie"])) {
    $movie = "%" . filter_input(INPUT_GET, 'movie', FILTER_SANITIZE_SPECIAL_CHARS) . "%";
    $sql = "SELECT DISTINCT movie.*
    FROM movie
    JOIN movie_schedule ON movie.id = movie_schedule.id_movie
    WHERE movie.title LIKE :movie
        AND movie_schedule.date_begin <= NOW()";
    $req = $db->prepare($sql);
    $req->bindParam('movie', $movie, PDO::PARAM_STR);
    $req->execute();
    $rows = $req->fetchAll(PDO::FETCH_ASSOC);
}



if (isset($_GET['id']) && isset($_GET['buypass'])) {
    $userId =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
    $userPass =  filter_input(INPUT_GET, 'buypass', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT user.id AS 'user_id', user.firstname, user.lastname, user.email,
    membership.id AS 'membership_id', subscription.name, 
    CASE 
        WHEN subscription.name IS NOT NULL THEN subscription.name 
        ELSE 'Pas de pass'

	END AS 'pass'
    FROM user 
    LEFT JOIN membership  ON user.id = membership.id_user
    LEFT JOIN subscription ON membership.id_subscription = subscription.id
    WHERE
    user.id = :user";

    $req = $db->prepare($sql);
    $req->bindParam('user', $user, PDO::PARAM_STR);
    $req->execute();
    $userInfos = $req->fetchAll(PDO::FETCH_ASSOC);
    
    
}


if (isset($_GET['userhistory']) && !empty($_GET['userhistory'])) {

    $movieID =  filter_input(INPUT_GET, 'userhistory', FILTER_SANITIZE_SPECIAL_CHARS);
    $usermembID = $_SESSION['user']['id_membership'];

    // $sq = "SELECT id FROM movie_schedule WHERE id_movie = $movieID LIMIT 1";
    $sq = "SELECT id FROM movie_schedule WHERE id_movie = :id_movie ORDER BY date_begin DESC LIMIT 1";
    $rq = $db->prepare($sq);
    $rq->bindParam('id_movie', $movieID, PDO::PARAM_STR);
    $rq->execute();
    $id_sess = $rq->fetch(PDO::FETCH_ASSOC);
    $sessionID =$id_sess['id'] ;
    $sql = "INSERT INTO membership_log (id_membership, id_session) VALUES ($usermembID, $sessionID) ";
    $req = $db->prepare($sql);
    $req->execute();
    
    $sq = "SELECT title FROM `movie` WHERE id = $movieID";
    $rq = $db->query($sq);
    $rq->execute();
    $titre = $rq->fetch(PDO::FETCH_ASSOC);

    array_push( $_SESSION['user']['movie_history'], $titre);


}