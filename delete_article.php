<?php
if(!isset($_GET['type']) || !isset($_GET['id'])){
    die("Invalid request.");
}

$type = $_GET['type'];
$id = intval($_GET['id']);
$file = "data/$type.json";

if(!file_exists($file)) die("File not found.");

$articles = json_decode(file_get_contents($file), true);
$articles = array_filter($articles, fn($a)=>$a['id']!=$id);

file_put_contents($file, json_encode(array_values($articles), JSON_PRETTY_PRINT));
header("Location: dashboard.html");
exit;
?>
