<?php

$server = "mysql:host=localhost;dbname=cinema";
$user = 'root';
$psw = 'root';

try {
    $db = new PDO($server, $user, $psw);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET NAMES utf8");

} catch (PDOException $e) {
    die("Erreur de connexion " . $e->getMessage());
}
