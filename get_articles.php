<?php
header('Content-Type: application/json');
$categories = ['news','sports'];
$all = [];
foreach($categories as $cat){
    $file = "data/$cat.json";
    if(file_exists($file)){
        $articles = json_decode(file_get_contents($file), true);
        foreach($articles as &$a){
            $a['type'] = $cat;
            $all[] = $a;
        }
    }
}
echo json_encode($all);
?>
