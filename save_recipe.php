<?php
session_start();

// Include the database connection file
$mysqli = require 'database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    exit("User is not logged in.");
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if recipe ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];

    // Check if the recipe is already saved by the user
    $check_saved_sql = "SELECT * FROM saved_recipes WHERE user_id = ? AND recipe_id = ?";
    $check_saved_stmt = $mysqli->prepare($check_saved_sql);
    $check_saved_stmt->bind_param("ii", $user_id, $recipe_id);
    $check_saved_stmt->execute();
    $check_saved_result = $check_saved_stmt->get_result();

    if ($check_saved_result->num_rows > 0) {
        // Recipe is already saved, return an error
        http_response_code(400); // Bad Request
        echo "Recipe is already saved.";
        exit();
    } else {
        // Recipe is not saved, insert it into saved_recipes table
        $insert_saved_sql = "INSERT INTO saved_recipes (user_id, recipe_id) VALUES (?, ?)";
        $insert_saved_stmt = $mysqli->prepare($insert_saved_sql);
        $insert_saved_stmt->bind_param("ii", $user_id, $recipe_id);

        if ($insert_saved_stmt->execute()) {
            // Recipe saved successfully
            header("Location: saved_recipes.php"); // Redirect to saved recipes page
            exit();
        } else {
            // Error saving recipe
            http_response_code(500); // Internal Server Error
            echo "An error occurred while saving the recipe.";
            exit();
        }
    }
} else {
    // Invalid request
    http_response_code(400); // Bad Request
    exit("Invalid request.");
}
?>
