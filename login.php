<?php
session_start(); // Start or resume the session

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";

    $email = $_POST["email"];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($email));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user && password_verify($password, $user['password_hash']) && $user['role'] === $role) {
        // Authentication successful
        $_SESSION['user_id'] = $user['user_id']; 
        $_SESSION['role'] = $role; 

        if ($role === 'recipe_seeker') {
            header("Location: browse_recipes.php"); // Redirect to browse recipe page
        } elseif ($role === 'cook_chef') {
            header("Location: home.php"); // Redirect to Cook/Chef dashboard
        }
        exit();
    } else {
        // Authentication failed
        $is_invalid = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" ></script>
    <script src="/js/validation.js" defer></script>
</head>
<body>
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <div>
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </div>
        
        <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        </div>

        <div>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
          <option value="recipe_seeker">Recipe Seeker</option>
          <option value="cook_chef">Cook or Chef</option>
        </select>
      </div>
        
        <input type="submit" value="Login">
    </form>
    
</body>
</html>
