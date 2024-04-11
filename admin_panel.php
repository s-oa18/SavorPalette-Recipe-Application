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
    <title>SavorPalette - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        h3 {
            color: #555;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
