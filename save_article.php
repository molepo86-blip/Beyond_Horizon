<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    // Choose the file
    $file = "data/" . $type . ".json";

    // Load existing data
    $articles = [];
    if (file_exists($file)) {
        $articles = json_decode(file_get_contents($file), true);
    }

    // Determine new ID
    $newId = count($articles) > 0 ? end($articles)['id'] + 1 : 1;

    // New article data
    $newArticle = [
        "id" => $newId,
        "title" => $title,
        "summary" => $summary,
        "content" => $content,
        "date" => $date
    ];

    // Add and save
    $articles[] = $newArticle;
    file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));

    echo "<p style='font-family:Arial; color:green;'>Article saved successfully! <a href='dashboard.html'>Back</a></p>";
}
?>
