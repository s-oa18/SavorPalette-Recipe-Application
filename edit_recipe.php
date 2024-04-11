<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';

$is_invalid = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
$recipe_id = $_POST['recipe_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$ingredients = $_POST['ingredients'];
$directions = $_POST['directions'];
$servings = $_POST['servings'];
$cooking_time = $_POST['cooking_time'];
$category = $_POST['category']; 
$location = $_POST['location'];


    // Check if a new image file is uploaded
    if ($_FILES["image"]["size"] > 0) {
        
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit();
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }

        // Update the image URL in the database
        $image_url = $target_file;
        $update_image_sql = "UPDATE recipes SET image_url = ? WHERE recipe_id = ?";
        $update_image_stmt = $mysqli->prepare($update_image_sql);
        $update_image_stmt->bind_param("si", $image_url, $recipe_id);
        if (!$update_image_stmt->execute()) {
            echo "Error updating image URL: " . $update_image_stmt->error;
            exit();
        }
    }

   // Prepare SQL statement to update recipe in database
$update_recipe_sql = "UPDATE recipes 
SET title = ?, description = ?, ingredients = ?, directions = ?, servings = ?, cooking_time = ?, category = ?, location = ?
WHERE recipe_id = ?";

// Prepare and bind parameters
$stmt = $mysqli->prepare($update_recipe_sql);
$stmt->bind_param("ssssiiisi", $title, $description, $ingredients, $directions, $servings, $cooking_time, $category, $location, $recipe_id);



if ($stmt->execute()) {
   
    $_SESSION['success_message'] = "Recipe updated successfully.";
   
    header("Location: manage_recipes.php");
    exit();
} else {
    // Set error message in session
    $_SESSION['error_message'] = "Error updating recipe: " . $stmt->error;
   
    header("Location: manage_recipes.php");
    exit(); 
}

    $stmt->close();
    $mysqli->close();
} else {
    // Retrieve recipe details from database
    if (isset($_GET['recipe_id'])) {
        $recipe_id = $_GET['recipe_id'];
        $select_recipe_sql = "SELECT * FROM recipes WHERE recipe_id = ?";
        $select_recipe_stmt = $mysqli->prepare($select_recipe_sql);
        $select_recipe_stmt->bind_param("i", $recipe_id);
        $select_recipe_stmt->execute();
        $result = $select_recipe_stmt->get_result();
        $recipe = $result->fetch_assoc();
        $select_recipe_stmt->close();
    } else {
        echo "Recipe ID not provided.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #f53132;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #f53132;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Edit Recipe</h2>

    <?php
    // Display success message if it exists
    if (isset($_SESSION['success_message'])) {
        echo "<p>{$_SESSION['success_message']}</p>";
        // Remove the success message from session to prevent it from displaying again
        unset($_SESSION['success_message']);
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $recipe['title']; ?>" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required><?php echo $recipe['description']; ?></textarea><br>

        <label for="ingredients">Ingredients:</label><br>
        <textarea id="ingredients" name="ingredients" rows="4" required><?php echo $recipe['ingredients']; ?></textarea><br>

        <label for="directions">Directions:</label><br>
        <textarea id="directions" name="directions" rows="4" required><?php echo $recipe['directions']; ?></textarea><br>

        <label for="servings">Servings:</label><br>
        <input type="number" id="servings" name="servings" value="<?php echo $recipe['servings']; ?>" required><br>

        <label for="cooking_time">Cooking Time (minutes):</label><br>
        <input type="number" id="cooking_time" name="cooking_time" value="<?php echo $recipe['cooking_time']; ?>" required><br>

        <label for="category">Category:</label><br>
        <select id="category" name="category" required>
            <option value="Appetizers" <?php if ($recipe['category'] == 'Appetizers') echo 'selected'; ?>>Appetizers</option>
            <option value="Main dish" <?php if ($recipe['category'] == 'Main dish') echo 'selected'; ?>>Main dish</option>
            <option value="Desserts" <?php if ($recipe['category'] == 'Desserts') echo 'selected'; ?>>Desserts</option>
        </select><br>


        <label for="location">Location:</label><br>
        <select id="location" name="location" required>
            <option value="Asia" <?php if ($recipe['location'] == 'Asia') echo 'selected'; ?>>Asia</option>
            <option value="Europe" <?php if ($recipe['location'] == 'Europe') echo 'selected'; ?>>Europe</option>
            <option value="North America" <?php if ($recipe['location'] == 'North America') echo 'selected'; ?>>North America</option>
            <option value="Africa" <?php if ($recipe['location'] == 'Africa') echo 'selected'; ?>>Africa</option>
        </select><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <input type="submit" value="Save">
    </form>
</body>
</html>



