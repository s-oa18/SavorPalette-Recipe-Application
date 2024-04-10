<?php
session_start();

$mysqli = require 'database.php';

// Retrieve system information
$recipe_count_sql = "SELECT COUNT(*) AS recipe_count FROM recipes";
$recipe_count_result = $mysqli->query($recipe_count_sql);
$recipe_count = $recipe_count_result->fetch_assoc()['recipe_count'];

// Number of Chefs
$chef_count_sql = "SELECT COUNT(*) AS chef_count FROM users WHERE role = 'cook_chef'";
$chef_count_result = $mysqli->query($chef_count_sql);
$chef_count = $chef_count_result->fetch_assoc()['chef_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
</head>
<body>
    <h2>Welcome to the Admin Panel</h2>
    <p><a href="logout.php">Logout</a></p>

    <h3>System Information:</h3>
    <p>Number of Recipes: <?php echo $recipe_count; ?></p>
    <p>Number of Chefs: <?php echo $chef_count; ?></p>

    <h3>All Recipes:</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieving all recipes
            $all_recipes_sql = "SELECT recipe_id, title, user_id FROM recipes";
            $all_recipes_result = $mysqli->query($all_recipes_sql);

            // Loop through each recipe and display them in a table
            while ($row = $all_recipes_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['title'] . "</td>";
                //get the author's username
                $author_sql = "SELECT username FROM users WHERE user_id = " . $row['user_id'];
                $author_result = $mysqli->query($author_sql);
                $author_username = $author_result->fetch_assoc()['username'];
                echo "<td>" . $author_username . "</td>";
                echo "<td><a href='edit_recipe.php?recipe_id=" . $row['recipe_id'] . "'>Edit</a> | <a href='delete_recipe.php?recipe_id=" . $row['recipe_id'] . "' onclick=\"return confirm('Are you sure you want to delete this recipe?')\">Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
