<?php

$apiKey = "****************************";
$channelID = "*************************";
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
