<?php
session_start();
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

// Initialize variables
$allRecipes = [];
$searchTerm = '';
$category = '';
$location = '';

// Check if search parameters are present in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $location = isset($_GET['location']) ? $_GET['location'] : '';

    // Construct the search query based on search term, category, and location
    $sql = "SELECT r.recipe_id, r.title, r.image_url, u.username 
            FROM recipes r 
            JOIN users u ON r.user_id = u.user_id 
            WHERE r.title LIKE '%$searchTerm%'";

    if (!empty($category)) {
        $sql .= " AND r.category = '$category'";
    }

    if (!empty($location)) {
        $sql .= " AND r.location = '$location'";
    }

    // Execute the search query
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $allRecipes[] = $row;
    }
} else {
    // If no search parameters are present, get all recipes
    $allRecipes = getAllRecipes($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SavorPalette - Browse Recipes</title>
    <style>
        
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
        h2 {
    text-align: center;
    color: #f53132;
    margin-top: 20px; 
}


p {
    text-align: center;
    margin-bottom: 20px; 
}


form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; 
}

form input[type="text"],
form select {
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form button {
    padding: 10px 20px;
    background-color: rgb(234, 179, 5);
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}
    </style>
</head>
<body>
    <h2>Browse Recipes</h2>
    <p><a href="logout.php">Logout</a></p>
    
    
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
                <a style="color:black;" href="view_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>">View</a>
                <form action="save_recipe.php" method="post">
                <input type="hidden" name="recipe_id" value="<?= $recipe['recipe_id'] ?>">
                <button type="submit">Bookmark</button>
            </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
