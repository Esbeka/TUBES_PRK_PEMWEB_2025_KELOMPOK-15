<?php
/**
 * DATABASE CONFIGURATION
 * Tanggung Jawab: ELISA (Database Engineer)
 * 
 * Deskripsi: Koneksi database MySQL
 */

// Database credentials
$host = 'localhost';
$dbname = 'kelasonline';
$username = 'root';
$password = ''; // Sesuaikan dengan password MySQL Anda

// Create connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// TODO: Create this database and tables using schema.sql
?>
