<?php
session_start();

include 'database.php';

$is_invalid = false;

// Check if success message exists in session
if (isset($_SESSION['success_message'])) {
    echo "<p>{$_SESSION['success_message']}</p>";
    unset($_SESSION['success_message']); // Remove success message from session
}

// Check if error message exists in session
if (isset($_SESSION['error_message'])) {
    echo "<p>{$_SESSION['error_message']}</p>";
    unset($_SESSION['error_message']); // Remove error message from session
}

// fetch user's recipes from the database
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

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Initialize variables
$userRecipes = [];

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
            color: #f53132;
            text-align: center;
            margin-top: 20px;
        }
        
        p {
            text-align: center;
            margin-bottom: 20px;
        }
        
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
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
    
    <h2>Manage Recipes</h2>
    <p><a href="home.php">Home</a></p>

    <h2><a href="add_recipe.html">Add Recipe</a></h2>

    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search your recipes">
        <button type="submit">Search</button>
    </form>

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
