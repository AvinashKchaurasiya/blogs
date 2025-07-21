<?php
// Base URL
define('BASE_URL', 'http://localhost/avinash_personal/blogs/');
define('ADMIN_BASE_URL', 'http://localhost/avinash_personal/blogs/admin/');
define('COMP_URI', '/blogs/admin');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'blogs');
define('DB_USER', 'root');
define('DB_PASS', '');

// MySQLi Connection (if you want auto-connect)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
