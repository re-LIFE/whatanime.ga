<?php
ini_set("display_errors", 0);

$thumbdir = 'clip/';
$uuid = uniqid();
$start = floatval($_GET['t']) - 0.9;
$duration = 3;
$season = rawurldecode($_GET['season']);
$anime = rawurldecode($_GET['anime']);
$file = rawurldecode($_GET['file']);
$filepath = str_replace('`', '\`', '/mnt/data/anime_new/'.$season.'/'.$anime.'/'.$file);
$thumbpath = $thumbdir.$uuid.'.mp4';

if(file_exists($filepath)){
    exec("ffmpeg -y -ss ".$start." -i \"$filepath\" -to ".$duration." -vf scale=640:-1 -c:v libx264 -preset fast ".$thumbpath);
}

header('Content-type: video/mp4');
readfile($thumbpath);
unlink($thumbpath);
?>