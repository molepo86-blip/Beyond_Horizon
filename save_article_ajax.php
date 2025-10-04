<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $type = $_POST['type'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    $file = "data/$type.json";
    $articles = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $newId = count($articles)>0 ? end($articles)['id']+1 : 1;

    $articles[] = ["id"=>$newId,"title"=>$title,"summary"=>$summary,"content"=>$content,"date"=>$date];
    file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));
}
?>
