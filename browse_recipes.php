<?php
// Include the database connection file
$mysqli = require 'database.php';

// Function to fetch all recipes from the database
function getAllRecipes($mysqli) {
    $recipes = [];
    $sql = "SELECT r.recipe_id, r.title, r.image_url, u.username FROM recipes r JOIN users u ON r.user_id = u.user_id";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
    return $recipes;
}

// Get all recipes
$allRecipes = getAllRecipes($mysqli);

// Handle search functionality
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Perform search query and update $allRecipes accordingly
    // Example: $allRecipes = performSearch($mysqli, $searchTerm);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SavorPalette - Browse Recipes</title>
    <style>
        /* Add your CSS styles here */
        .recipe-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
        }
        .recipe-card {
            border: 1px solid #ccc;
            padding: 10px;
        }
        .recipe-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Browse Recipes</h2>
    
    <!-- Search form -->
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search recipes by keyword">
        <select name="category">
            <option value="">Select category</option>
            <!-- Add options for categories -->
            <option value="Appetizers">Appetizers</option>
            <option value="Main dish">Main dish</option>
            <option value="Desserts">Desserts</option>
        </select>
        <select name="location">
            <option value="">Select location</option>
            <!-- Add options for locations -->
            <option value="Asia">Asia</option>
            <option value="Europe">Europe</option>
            <option value="North America">North America</option>
            <option value="Africa">Africa</option>
        </select>
        <button type="submit">Search</button>
    </form>
    
    <!-- Display recipes -->
    <div class="recipe-container">
        <?php foreach ($allRecipes as $recipe): ?>
            <div class="recipe-card">
                <img src="<?= $recipe['image_url'] ?>" alt="<?= $recipe['title'] ?>">
                <h3><?= $recipe['title'] ?></h3>
                <p>By: <?= $recipe['username'] ?></p>
                <a href="view_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>">View</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
