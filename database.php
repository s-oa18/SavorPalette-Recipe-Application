<?php

$servername = getenv('DB_HOST') ?: 'db';
$username   = getenv('DB_USER') ?: 'root';
$password   = getenv('DB_PASSWORD') ?: 'root';
$dbname     = getenv('DB_NAME') ?: 'recipe_login_db';

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>