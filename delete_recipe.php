<?php
session_start();

// Include the database connection file
include 'database.php';

// Check if user is logged in
// Add your authentication logic here if needed

// Check if recipe_id is provided
if (!isset($_GET['recipe_id'])) {
    $_SESSION['error_message'] = "Recipe ID is not provided.";
    header("Location: manage_recipes.php");
    exit();
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Get recipe_id from GET parameters
$recipe_id = $_GET['recipe_id'];

// Prepare SQL statement to delete recipe from database
$sql = "DELETE FROM recipes WHERE recipe_id = ? AND user_id = ?";

// Prepare and bind parameters
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $recipe_id, $user_id);

// Execute the SQL statement
if ($stmt->execute()) {
    // Set success message in session
    $_SESSION['success_message'] = "Recipe deleted successfully.";
} else {
    $_SESSION['error_message'] = "Error deleting recipe: " . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$mysqli->close();

// Redirect back to manage recipes page
header("Location: manage_recipes.php");
exit();
?>
