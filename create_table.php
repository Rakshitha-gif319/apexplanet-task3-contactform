<?php
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL only (not to contact_db yet)
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create database
$sql = "CREATE DATABASE IF NOT EXISTS contact_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists. ✅ <br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the new DB
$conn->select_db("contact_db");

// Create table
$tableSql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($tableSql) === TRUE) {
    echo "Table created successfully ✅";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
