<?php
if(!isset($_GET['type']) || !isset($_GET['id'])){
    die("Invalid request.");
}

$type = $_GET['type'];
$id = intval($_GET['id']);
$file = "data/$type.json";

if(!file_exists($file)) die("File not found.");

$articles = json_decode(file_get_contents($file), true);
$article = null;
foreach($articles as $a){ if($a['id']==$id){ $article=$a; break; } }
if(!$article) die("Article not found.");

if($_SERVER['REQUEST_METHOD']=='POST'){
    // Update article
    foreach($articles as &$a){
        if($a['id']==$id){
            $a['title'] = $_POST['title'];
            $a['summary'] = $_POST['summary'];
            $a['content'] = $_POST['content'];
            $a['date'] = $_POST['date'];
            break;
        }
    }
    file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));
    echo "<p>Article updated successfully! <a href='dashboard.html'>Back</a></p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Article</title>
</head>
<body>
<h2>Edit Article</h2>
<form method="POST">
<label>Title</label>
<input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
<br>
<label>Summary</label>
<textarea name="summary" required><?= htmlspecialchars($article['summary']) ?></textarea>
<br>
<label>Content</label>
<textarea name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
<br>
<label>Date</label>
<input type="date" name="date" value="<?= $article['date'] ?>" required>
<br>
<button type="submit">Save Changes</button>
</form>
</body>
</html>
