<?php

$apiKey = "AIzaSyCK0H7DfhOqi5ELnuK9uM_ikde4rXvLPfM";
$channelID = "UCj4lFy4F5PqXD7d41mCKVYw";
$order = array_rand(['videoCount', 'title','viewCount', 'date'],1);
$url = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelID&part=snippet,id&maxResults=$num&order=$order";
$response = file_get_contents($url);
if ($response === false) {
    die('Erreur lors de la requête vers l\'API YouTube Data.');
}

$data = json_decode($response);

if (isset($data->items)) {
    $views = $data->items;

} else {
    echo "Aucune vidéo trouvée.";
}
?>
