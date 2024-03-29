<?php
require "db.php";
$sub = [
    1 => "VIP",
    2 => "GOLD",
    3 => "Classic",
    4 => "Pass Day"
];
$sqlu = "SELECT * FROM user";
$query = $db->query($sqlu);
$totalUser = $query->fetchAll(PDO::FETCH_ASSOC);
$nb_users = count($totalUser);
if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}
@$page = $_GET['page'];
$nb = 9;
$nb_pages = ceil($nb_users / $nb);
$begin = ($page - 1) * $nb;


$sql = "SELECT * FROM user LIMIT $begin, $nb";
$req = $db->prepare($sql);
$req->execute();
$rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM job";
$req = $db->prepare($sql);
$req->execute();
$rowJob = $req->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET["submitUser"]) || isset($_GET['page']) ||  $_GET['filter']) {
    if (!isset($_GET['user'])) {
        $user = "";
        $parts = [''];
    } else {

        $user =  filter_input(INPUT_GET, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
        $parts = explode(" ", $user);
    }
    if (isset($_GET['filter']) && !empty($_GET['filter'])) {


        $filtre =  filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_SPECIAL_CHARS);
        if (in_array($filtre, $sub)) {
            if (count($parts) < 2) {
                $user = "%" . $parts[0] . "%";
                $sql = "SELECT * FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
                WHERE subscription.name ='$filtre' AND (firstname LIKE :user OR lastname LIKE :user)";

                $req = $db->prepare($sql);
                $req->bindParam('user', $user, PDO::PARAM_STR);
                $req->execute();
                $rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
                $nb_users = count($rowUsersCount);

                if (!isset($_GET['page'])) {
                    $_GET['page'] = 1;
                }

                @$page = $_GET['page'];
                $nb = 9;
                $nb_pages = ceil($nb_users / $nb);

                $begin = ($page - 1) * $nb;

                $sql = "SELECT user.id, user.firstname, user.lastname FROM user LEFT JOIN membership ON user.id = membership.id_user LEFT JOIN subscription ON membership.id_subscription = subscription.id 
                WHERE subscription.name ='$filtre' AND (firstname LIKE :user OR lastname LIKE :user) LIMIT $begin, $nb";

                $req = $db->prepare($sql);
                $req->bindParam('user', $user, PDO::PARAM_STR);
                $req->execute();
                $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $usera = "%" . $parts[0] . "%";
                $userb = "%" . $parts[1] . "%";

                $sql = "SELECT * FROM user
                WHERE (firstname LIKE :usera
                AND lastname LIKE :userb) OR (firstname LIKE :userb AND lastname LIKE :usera)";
                $req = $db->prepare($sql);
                $req->bindParam('usera', $usera, PDO::PARAM_STR);
                $req->bindParam('userb', $userb, PDO::PARAM_STR);

                $req->execute();
                $rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);

                $nb_users = count($rowUsersCount);
                if (!isset($_GET['page'])) {
                    $_GET['page'] = 1;
                }
                @$page = $_GET['page'];
                $nb = 9;
                $nb_pages = ceil($nb_users / $nb);

                $begin = ($page - 1) * $nb;


                $sql = "SELECT * FROM user
                WHERE (firstname LIKE :usera
                AND lastname LIKE :userb) OR (firstname LIKE :userb AND lastname LIKE :usera)  LIMIT $begin, $nb";
                $req = $db->prepare($sql);
                $req->bindParam('usera', $usera, PDO::PARAM_STR);
                $req->bindParam('userb', $userb, PDO::PARAM_STR);

                $req->execute();
                $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        if ($filtre == 'ALL') {
            $sqlu = "SELECT * FROM user";
            $query = $db->query($sqlu);
            $totalUser = $query->fetchAll(PDO::FETCH_ASSOC);
            $nb_users = count($totalUser);
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            @$page = $_GET['page'];
            $nb = 9;
            $nb_pages = ceil($nb_users / $nb);
            $begin = ($page - 1) * $nb;


            $sql = "SELECT * FROM user LIMIT $begin, $nb";
            $req = $db->prepare($sql);
            $req->execute();
            $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($filtre == 'employee') {
            $sqlu = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription  WHERE job.name IS NOT NULL";
            $query = $db->query($sqlu);
            $totalUser = $query->fetchAll(PDO::FETCH_ASSOC);
            $nb_users = count($totalUser);
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            @$page = $_GET['page'];
            $nb = 9;
            $nb_pages = ceil($nb_users / $nb);
            $begin = ($page - 1) * $nb;


            $sql = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription  WHERE job.name IS NOT NULL LIMIT $begin, $nb";
            $req = $db->prepare($sql);
            $req->execute();
            $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($filtre == 'no_pass') {
            $sqlu = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription  WHERE subscription.name IS NULL";
            $query = $db->query($sqlu);
            $totalUser = $query->fetchAll(PDO::FETCH_ASSOC);
            $nb_users = count($totalUser);
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            @$page = $_GET['page'];
            $nb = 9;
            $nb_pages = ceil($nb_users / $nb);
            $begin = ($page - 1) * $nb;


            $sql = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription  WHERE subscription.name IS NULL LIMIT $begin, $nb";
            $req = $db->prepare($sql);
            $req->execute();
            $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {

        if (count($parts) < 2) {
            $user = "%" . $parts[0] . "%";
            $sql = "SELECT * FROM user
        WHERE firstname LIKE :user
        OR lastname LIKE :user";

            $req = $db->prepare($sql);
            $req->bindParam('user', $user, PDO::PARAM_STR);
            $req->execute();
            $rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);
            $nb_users = count($rowUsersCount);

            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }

            @$page = $_GET['page'];
            $nb = 9;
            $nb_pages = ceil($nb_users / $nb);

            $begin = ($page - 1) * $nb;

            $sql = "SELECT * FROM user
        WHERE firstname LIKE :user
        OR lastname LIKE :user LIMIT $begin, $nb";

            $req = $db->prepare($sql);
            $req->bindParam('user', $user, PDO::PARAM_STR);
            $req->execute();
            $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $usera = "%" . $parts[0] . "%";
            $userb = "%" . $parts[1] . "%";

            $sql = "SELECT * FROM user
            WHERE (firstname LIKE :usera
            AND lastname LIKE :userb) OR (firstname LIKE :userb AND lastname LIKE :usera)";
            $req = $db->prepare($sql);
            $req->bindParam('usera', $usera, PDO::PARAM_STR);
            $req->bindParam('userb', $userb, PDO::PARAM_STR);

            $req->execute();
            $rowUsersCount = $req->fetchAll(PDO::FETCH_ASSOC);

            $nb_users = count($rowUsersCount);
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            @$page = $_GET['page'];
            $nb = 9;
            $nb_pages = ceil($nb_users / $nb);

            $begin = ($page - 1) * $nb;


            $sql = "SELECT * FROM user
            WHERE (firstname LIKE :usera
            AND lastname LIKE :userb) OR (firstname LIKE :userb AND lastname LIKE :usera)  LIMIT $begin, $nb";
            $req = $db->prepare($sql);
            $req->bindParam('usera', $usera, PDO::PARAM_STR);
            $req->bindParam('userb', $userb, PDO::PARAM_STR);

            $req->execute();
            $rowUsers = $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}


if (isset($_GET['searchid'])) {
    $user =  filter_input(INPUT_GET, 'searchid', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT user.id AS 'id', membership.id AS 'id_membership', user.email, user.firstname, user.lastname, user.city, user.country, job.salary, job.name AS 'job', job.description AS 'job_description', job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription WHERE user.id = :user";

    $req = $db->prepare($sql);
    $req->bindParam('user', $user, PDO::PARAM_STR);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $memberId = $row['id_membership'];
    $sqlHistory = "SELECT movie.title FROM membership_log JOIN movie_schedule ON membership_log.id_session = movie_schedule.id JOIN movie ON movie_schedule.id_movie = movie.id WHERE membership_log.id_membership = :membership_id ORDER BY movie_schedule.date_begin DESC";
    $reqhis = $db->prepare($sqlHistory);
    $reqhis->bindParam('membership_id', $memberId, PDO::PARAM_INT);
    $reqhis->execute();
    $moviehis = $reqhis->fetchAll(PDO::FETCH_ASSOC);

    $userInfos = [
        "id" => $row['id'],
        "id_membership" => $row['id_membership'],
        "firstname" => $row['firstname'],
        "lastname" => $row['lastname'],
        "email" => $row['email'],
        "city" => $row['city'],
        "country" => $row['country'],
        "job" => $row['job'],
        "salary" => $row['salary'],
        "job_description" => $row['job_description'],
        "role" => $row['role'],
        "pass" => $row['pass'],
        "pass_description" => $row['pass_description'],
        "movie_history" => $moviehis
    ];
}

if (isset($_POST['changepass'])) {
    if (!isset($userInfos)) {
        $userID = $_SESSION['user']['id'];
    }

    $userID =  filter_input(INPUT_POST, 'useridpass', FILTER_SANITIZE_SPECIAL_CHARS);
    $userPASS =  filter_input(INPUT_POST, 'addPass', FILTER_SANITIZE_SPECIAL_CHARS);
    $actualpass =  filter_input(INPUT_POST, 'actualpass', FILTER_SANITIZE_SPECIAL_CHARS);
    $today = date("Y-m-d H:i:s");


    if (!empty($actualpass)) {
        if ($userPASS == 0) {
            $key = array_search($actualpass, $sub);

            $sql = "DELETE FROM membership WHERE id_user = $userID AND id_subscription = $key";
            if (!isset($userInfos)) {
                $_SESSION['user']["pass"] = NULL;
            } else {
                $userInfos["pass"] = NULL;
            }
        } else {

            $sql = "UPDATE membership SET id_subscription = $userPASS WHERE id_user =  $userID ";
            if (!isset($userInfos)) {
                $_SESSION['user']["pass"] =  $sub[$userPASS];
            } else {
                $userInfos["pass"] = $sub[$userPASS];
            }
        }
    } else {

        $sql = "INSERT INTO membership(id_user, id_subscription, date_begin) VALUES($userID, $userPASS,NOW())";
        if (!isset($userInfos)) {
            $_SESSION['user']["pass"] =  $sub[$userPASS];
        } else {
            $userInfos["pass"] = $sub[$userPASS];
        }
    }
    $req = $db->prepare($sql);
    $req->execute();
}

if (isset($_POST['job'])) {
    if (!isset($userInfos)) {
        $userID = $_SESSION['user']['id'];
    }

    $userID =  filter_input(INPUT_POST, 'searchid', FILTER_SANITIZE_SPECIAL_CHARS);
    $jobID =  filter_input(INPUT_POST, 'job', FILTER_SANITIZE_SPECIAL_CHARS);

    $today = date("Y-m-d H:i:s");
    $sqljob = "SELECT job.name, job.description FROM job WHERE id = $jobID";
    $reqjob = $db->prepare($sqljob);
    $reqjob->execute();
    $jobname = $reqjob->fetch(PDO::FETCH_ASSOC);

    $sql = "UPDATE employee SET id_job = $jobID WHERE id_user =  $userID ";
    $req = $db->prepare($sql);
    $req->execute();
    if (!isset($userInfos)) {
        $_SESSION['user']["job"] =  $jobname['name'];
        $_SESSION['user']["job_description"] =  $jobname['description'];
    } else {
        $userInfos["job"] = $jobname['name'];
        $userInfos["job_description"] = $jobname['description'];
    }
}

$sqlroom = "SELECT id, name AS 'salle' FROM room";
$reqroom = $db->query($sqlroom);
$reqroom->execute();
$roomInfo = $reqroom->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET["searchProgramMovie"])) {
    $movie = "%" . filter_input(INPUT_GET, 'movie', FILTER_SANITIZE_SPECIAL_CHARS) . "%";
    $sql = "SELECT * FROM movie
    WHERE title LIKE :movie";
    $req = $db->prepare($sql);
    $req->bindParam('movie', $movie, PDO::PARAM_STR);
    $req->execute();
    $rowMovie = $req->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['programMovie'])) {
    if (isset($_GET['scheduleMovie'], $_GET['hours'], $_GET['room']) && !empty($_GET['scheduleMovie']) && !empty($_GET['hours']) && !empty($_GET['room'])) {

        $movieID =  filter_input(INPUT_GET, 'scheduleMovie', FILTER_SANITIZE_SPECIAL_CHARS);
        $roomID =  filter_input(INPUT_GET, 'room', FILTER_SANITIZE_SPECIAL_CHARS);
        $hours =  filter_input(INPUT_GET, 'hours', FILTER_SANITIZE_SPECIAL_CHARS);
        $hours = str_replace('T', " ", $hours);

        $sql = "INSERT INTO movie_schedule (id_movie, id_room, date_begin) VALUES(:id_movie, :id_room, :date_begin) ";
        $req = $db->prepare($sql);
        $req->bindParam('id_movie', $movieID, PDO::PARAM_STR);
        $req->bindParam('id_room', $roomID, PDO::PARAM_STR);
        $req->bindParam('date_begin', $hours, PDO::PARAM_STR);
        $req->execute();
    } else {
        $msg = "Remplir correctement les champs";
    }
}

$sqlplanning = "SELECT *, room.name AS 'room' FROM movie_schedule JOIN movie ON movie_schedule.id_movie = movie.id JOIN room ON movie_schedule.id_room = room.id WHERE date_begin >= NOW()";
$req = $db->query($sqlplanning);
$req->execute();
$rowplanning = $req->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['check-date'])) {
    if (isset($_GET['date-begin'], $_GET['date-end']) && !empty($_GET["date-begin"]) && !empty($_GET['date-end'])) {
        $begin =  filter_input(INPUT_GET, 'date-begin', FILTER_SANITIZE_SPECIAL_CHARS);
        $end =  filter_input(INPUT_GET, 'date-end', FILTER_SANITIZE_SPECIAL_CHARS);
        $begin = str_replace('T', " ", $begin) . ":00";
        $end = str_replace('T', " ", $end) . ":00";
        $sqlplanning = "SELECT *, room.name AS 'room' FROM movie_schedule JOIN movie ON movie_schedule.id_movie = movie.id JOIN room ON movie_schedule.id_room = room.id WHERE date_begin >= :date_begin AND date_begin < :date_end";
        $req = $db->prepare($sqlplanning);
        $req->bindParam('date_begin', $begin, PDO::PARAM_STR);
        $req->bindParam('date_end', $end, PDO::PARAM_STR);
        $req->execute();
        $rowplanning = $req->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $msg = "Date is required";
    }
}
