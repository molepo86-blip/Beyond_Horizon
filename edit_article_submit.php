<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $type = $_POST['type'];
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    $file = "data/$type.json";
    if(!file_exists($file)) die("File not found.");

    $articles = json_decode(file_get_contents($file), true);
    foreach($articles as &$a){
        if($a['id']==$id){
            $a['title'] = $title;
            $a['summary'] = $summary;
            $a['content'] = $content;
            $a['date'] = $date;
            break;
        }
    }
    file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));
    header("Location: dashboard.html");
    exit;
}
?>
