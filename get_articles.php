<?php
header('Content-Type: application/json');

// Replace this with a database connection if you have one
$articles = [
    [
        "slug" => "breaking-news-1",
        "title" => "Breaking News 1",
        "content" => "This is the content of breaking news 1.",
        "author" => "Editor John",
        "category" => "news",
        "cover_image" => "assets/images/news1.jpg",
        "published_at" => "2025-10-08 08:00:00"
    ],
    [
        "slug" => "sports-highlight-1",
        "title" => "Sports Highlight 1",
        "content" => "This is the content of sports highlight 1.",
        "author" => "Editor Mike",
        "category" => "sports",
        "cover_image" => "assets/images/sports1.jpg",
        "published_at" => "2025-10-08 09:00:00"
    ]
];

$category = isset($_GET['category']) ? $_GET['category'] : null;

if($category){
    $filtered = array_filter($articles, fn($a) => $a['category'] === $category);
    echo json_encode(array_values($filtered));
} else {
    echo json_encode($articles);
}
?>
