

<?php
session_start(); 

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
            header("Location: home.php"); 
        } elseif($role === 'admin') {
            header("location: admin_panel.php");
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
          <option value="admin">Administrator</option>
        </select>
      </div>
        
        <input type="submit" value="Login">
    </form>
    <div class="new_user">
      <p class="new">Already a User?</p>
      <p><a class="register" href="signup.html">Sign up</a></p>
    </div>
    
</body>
</html>

