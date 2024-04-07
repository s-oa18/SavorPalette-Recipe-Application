<?php
// Include the database connection file
$mysqli = require 'database.php';

// Check if user is logged in (replace this with your actual authentication logic)
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Function to fetch user's recipes from the database
function getUserRecipes($mysqli, $user_id, $searchTerm = null) {
    $recipes = [];
    $sql = "SELECT recipe_id, title, image_url FROM recipes WHERE user_id = ?";
    if ($searchTerm !== null) {
        $sql .= " AND (title LIKE ?)";
    }
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $user_id);
    if ($searchTerm !== null) {
        $search = "%{$searchTerm}%";
        $stmt->bind_param("is", $user_id, $search);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
    $stmt->close();
    return $recipes;
}

// Handle search functionality
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Get user's recipes with search term
    $userRecipes = getUserRecipes($mysqli, $user_id, $searchTerm);
} else {
    // Get user's recipes without search term (display all recipes)
    $userRecipes = getUserRecipes($mysqli, $user_id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SavorPalette - Manage Recipes</title>
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
    <h2>Manage Recipes</h2>
    <p><a href="home.php">Home</a></p>
    <p><a href="manage_recipes.php">View All Recipes</a></p>

    <!-- Search form -->
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search your recipes">
        <button type="submit">Search</button>
    </form>

    <h2><a href="add_recipe.html">Add Recipe</a></h2>

    <!-- Display user's recipes -->
    <div class="recipe-container">
        <?php foreach ($userRecipes as $recipe): ?>
            <div class="recipe-card">
                <img src="<?= $recipe['image_url'] ?>" alt="<?= $recipe['title'] ?>">
                <h3><?= $recipe['title'] ?></h3>
                <a href="view_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>">View</a>
                <a href="edit_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>">Edit</a>
                <a href="delete_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>" onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
