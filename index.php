<?php

$dbHost = getenv('DB_HOST') ?: 'mysql';
$dbName = getenv('DB_NAME') ?: 'phpapp';
$dbUser = getenv('DB_USER') ?: 'phpuser';
$dbPassword = getenv('DB_PASSWORD') ?: 'MySQLUserPass123!';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

echo "<h1>PHP 3-Tier CI/CD Application</h1>";
echo "<h2>CI/CD Version: Build 15</h2>";
echo "<p>Application deployed through Jenkins, Docker, ECR and Kubernetes.</p>";

if ($conn->connect_error) {
    echo "<h2>Database Status: Connection Failed</h2>";
    echo "<p>" . htmlspecialchars($conn->connect_error) . "</p>";
} else {
    echo "<h2>Database Status: Connected Successfully</h2>";
    echo "<p>MySQL database: " . htmlspecialchars($dbName) . "</p>";
    echo "<p>MySQL host: " . htmlspecialchars($dbHost) . "</p>";
}

$conn->close();
?>
