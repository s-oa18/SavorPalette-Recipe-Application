<?php
// Include the database connection file
$mysqli = require 'database.php';

// Check if user is logged in (replace this with your actual authentication logic)
// Example: Assume you have stored the user_id in a session variable named 'user_id'
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $servings = $_POST['servings'];
    $cooking_time = $_POST['cooking_time'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    
    // File upload handling
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        exit();
    }
    
    // Allow only certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit();
    }
    
    // Move uploaded file to target directory
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }
    
    // Prepare SQL statement to insert recipe into database
    $sql = "INSERT INTO recipes (user_id, title, description, ingredients, directions, servings, cooking_time, category, location, image_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issssiisss", $user_id, $title, $description, $ingredients, $directions, $servings, $cooking_time, $category, $location, $target_file);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Recipe added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement and database connection
    $stmt->close();
    $mysqli->close();
}
?>
