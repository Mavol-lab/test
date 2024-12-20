<?php

$host = 'localhost';
$port = '3306';
$dbname = 'test';
$username = 'user';
$password = 'password';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("DB connection error: " . $e->getMessage());
}
