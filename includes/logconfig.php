<?php
@session_start();
require "db.php";

if (isset($_POST["login"])) {
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        $mail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $psw = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT user.id AS 'id',  membership.id AS 'id_membership',user.email, user.firstname, user.lastname, user.city, user.country, job.name AS 'job', job.description AS 'job_description', job.salary, job.executive AS 'role', subscription.name AS 'pass', subscription.description AS 'pass_description' FROM user LEFT JOIN employee ON employee.id_user = user.id LEFT JOIN job ON job.id = employee.id_job LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription WHERE user.email = :email";
        $req = $db->prepare($sql);
        $req->bindParam('email', $mail, PDO::PARAM_STR);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if ($row) {


            $memberId = $row['id_membership'];
            $sqlHistory = "SELECT movie.title FROM membership_log JOIN movie_schedule ON membership_log.id_session = movie_schedule.id JOIN movie ON movie_schedule.id_movie = movie.id WHERE membership_log.id_membership = :membership_id ORDER BY movie_schedule.date_begin DESC";
            $reqhis = $db->prepare($sqlHistory);
            $reqhis->bindParam('membership_id', $memberId, PDO::PARAM_INT);
            $reqhis->execute();
            $moviehis = $reqhis->fetchAll(PDO::FETCH_ASSOC);

            if (password_verify($psw, '$argon2id$v=19$m=16,t=2,p=1$dVlGVUFCcndCYXBVY1h0SA$Q+m4pN4kA7nkQ6GZPJ4dWA')) {

                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['user'] = [
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
                    header("Location: profil.php");
                } else {
                    $msg = "Entrez une adresse mail valide";
                }
            } else {
                $msg = 'Adresse mail ou mot de passe incorrect';
            }
        } else {
            $msg =  'Adresse mail ou mot de passe incorrect';
        }
    } else {
        $msg = "Veuillez remplir tous les champs";
    }
}
