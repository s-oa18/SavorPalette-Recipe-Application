<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("location: index.html"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Savor Palette Recipes</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/templatecolourss.css" />
  </head>
  <body>
    <header class="header-container">
      <img
        class="logo"
        style="background-color: "
        src="assets/images/Untitled design copy.png"
        alt=""
      />

      <nav class="nav-items">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="browse_recipes.php">Browse Recipes</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li><a href="manage_recipes.php">Manage Recipes</a></li>
        </ul>
      </nav>

      <div class="register">
      <p><a href="logout.php">Logout</a></p>
      </div>
    </header>

    <main>
      <section class="hero">
        <div class="hero-text">
          <h2>Welcome to SavorPalette: Your Culinary Adventure begins here!</h2>
          <button class="hero-signup-link">Sign Up Today</button>
          <img
            style="width: 30px"
            src="assets/images/arrow.svg"
            alt=""
            srcset=""
          />
        </div>
      </section>
      <section class="recipe-start">
        <h2>Recipes</h2>
        <div class="search">
          <input type="text" />
          <button>Search</button>
        </div>
        <div class="sort">
          <button>Sort by category</button>
          <button>sort by location</button>
        </div>
      </section>
      <section class="recipe-display">
        <aside class="aside-left"></aside>
        <aside class="aside-right"></aside>
      </section>

      <section class="subscribe-section">
        <h3>Be the first to know about new trending recipes & more</h3>
        <form action="POST">
          <input type="email" name="" id="" placeholder="email" />
          <input type="button" value="Subscribe" />
        </form>
      </section>
    </main>

    <footer class="header-container">
      <div>
        <img src="assets/images/Untitled design copy.png" alt="" />
      </div>
      <nav class="nav-items">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Browse Recipes</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <p>(c) SavorPalette, Inc. 2024. We love our users!</p>
    </footer>
  </body>
</html>
