<?php
session_start();
$mysqli = require 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Fetch saved recipes from the database
$select_saved_recipes_sql = "SELECT sr.id, r.recipe_id, r.title, r.image_url, u.username 
                            FROM saved_recipes sr 
                            JOIN recipes r ON sr.recipe_id = r.recipe_id 
                            JOIN users u ON r.user_id = u.user_id 
                            WHERE sr.user_id = ?";
$select_saved_recipes_stmt = $mysqli->prepare($select_saved_recipes_sql);
$select_saved_recipes_stmt->bind_param("i", $user_id);
$select_saved_recipes_stmt->execute();
$result = $select_saved_recipes_stmt->get_result();


$saved_recipes = [];
while ($row = $result->fetch_assoc()) {
    $saved_recipes[] = $row;
}

// Close the prepared statement
$select_saved_recipes_stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_recipe_id'])) {
    $remove_recipe_id = $_POST['remove_recipe_id'];

    $delete_saved_recipe_sql = "DELETE FROM saved_recipes WHERE id = ? AND user_id = ?";
    $delete_saved_recipe_stmt = $mysqli->prepare($delete_saved_recipe_sql);
    $delete_saved_recipe_stmt->bind_param("ii", $remove_recipe_id, $user_id);

    if ($delete_saved_recipe_stmt->execute()) {

        header("Location: saved_recipes.php");
        exit();
    } else {
        echo "An error occurred while removing the recipe.";
    }

    $delete_saved_recipe_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Recipes</title>
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
    <h2>Saved Recipes</h2>

    <!-- Display saved recipes -->
    <div class="recipe-container">
        <?php foreach ($saved_recipes as $recipe): ?>
            <div class="recipe-card">
                <img src="<?= $recipe['image_url'] ?>" alt="<?= $recipe['title'] ?>">
                <h3><?= $recipe['title'] ?></h3>
                <p>By: <?= $recipe['username'] ?></p>
                <a href="view_recipe.php?recipe_id=<?= $recipe['recipe_id'] ?>">View</a>
                <form action="" method="POST">
                    <input type="hidden" name="remove_recipe_id" value="<?= $recipe['id'] ?>">
                    <button type="submit">Remove</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    
</body>
</html>
