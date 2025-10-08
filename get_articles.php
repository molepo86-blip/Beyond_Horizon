<?php
header('Content-Type: application/json');

// Example: Replace this with your database connection if needed
$articles = [
    [
        "slug" => "south-africa-springboks-victory",
        "category" => "sports",
        "title" => "Springboks Secure Victory Against Rival Team",
        "content" => "The Springboks have triumphed in an exhilarating match...",
        "author" => "James Molepo",
        "published_at" => "2025-10-07 14:30:00",
        "cover_image" => "assets/images/springboks.jpg"
    ],
    [
        "slug" => "latest-tech-updates",
        "category" => "news",
        "title" => "Latest Tech Updates in South Africa",
        "content" => "Technology is evolving fast in South Africa with new developments...",
        "author" => "Jane Doe",
        "published_at" => "2025-10-07 12:00:00",
        "cover_image" => "assets/images/tech-news.jpg"
    ]
];

// Get category from query string
$category = isset($_GET['category']) ? $_GET['category'] : '';

if($category) {
    $filtered = array_filter($articles, function($a) use ($category) {
        return $a['category'] === $category;
    });
    echo json_encode(array_values($filtered));
} else {
    echo json_encode($articles);
}
?>
