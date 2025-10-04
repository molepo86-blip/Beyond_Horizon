// server.js
const express = require("express");
const fs = require("fs");
const path = require("path");
const bodyParser = require("body-parser");

const app = express();
const PORT = 3000;

// Middleware
app.use(bodyParser.json());
app.use(express.static(path.join(__dirname, "public"))); // serve HTML, CSS, JS

const articlesFile = path.join(__dirname, "data", "articles.json");

// Get all articles
app.get("/api/articles", (req, res) => {
  fs.readFile(articlesFile, "utf8", (err, data) => {
    if (err) return res.status(500).json({ error: "Failed to read articles" });
    res.json(JSON.parse(data));
  });
});

// Add a new article
app.post("/api/articles", (req, res) => {
  const newArticle = req.body;
  fs.readFile(articlesFile, "utf8", (err, data) => {
    if (err) return res.status(500).json({ error: "Failed to read articles" });

    const articles = JSON.parse(data);
    articles.unshift(newArticle); // add new one at the top

    fs.writeFile(articlesFile, JSON.stringify(articles, null, 2), err => {
      if (err) return res.status(500).json({ error: "Failed to save article" });
      res.json({ success: true, message: "Article added successfully" });
    });
  });
});

app.listen(PORT, () => {
  console.log(`🚀 Server running on http://localhost:${PORT}`);
});
