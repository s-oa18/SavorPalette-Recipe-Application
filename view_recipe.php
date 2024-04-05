<?php
// Include the database connection file
$mysqli = require 'database.php';

// Function to get recipe details by recipe ID
function getRecipeDetails($mysqli, $recipe_id) {
    $sql = "SELECT r.*, u.username FROM recipes r JOIN users u ON r.user_id = u.user_id WHERE r.recipe_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();
    $stmt->close();
    return $recipe;
}

// Check if recipe_id is provided in the URL
if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];
    // Get recipe details
    $recipe = getRecipeDetails($mysqli, $recipe_id);
    if (!$recipe) {
        echo "Recipe not found.";
        exit();
    }
} else {
    echo "Recipe ID is missing.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe</title>
    <style>
        /* Add your CSS styles here */
        .recipe-details {
            max-width: 600px;
            margin: 0 auto;
        }
        .recipe-details img {
            max-width: 100%;
            height: auto;
        }
        .recipe-details h2 {
            margin-bottom: 10px;
        }
        .recipe-details p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="recipe-details">
        <h2><?= $recipe['title'] ?></h2>
        <img src="<?= $recipe['image_url'] ?>" alt="<?= $recipe['title'] ?>">
        <p>Description: <?= $recipe['description'] ?></p>
        <p>Ingredients: <?= $recipe['ingredients'] ?></p>
        <p>Directions: <?= $recipe['directions'] ?></p>
        <p>Servings: <?= $recipe['servings'] ?></p>
        <p>Cooking Time: <?= $recipe['cooking_time'] ?> minutes</p>
        <p>Category: <?= $recipe['category'] ?></p>
        <p>Location: <?= $recipe['location'] ?></p>
        <p>By: <?= $recipe['username'] ?></p>
        <!-- Add buttons for edit, update, and delete if needed -->
    </div>
</body>
</html>
