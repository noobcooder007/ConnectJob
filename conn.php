<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bolsaD";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . $conn->connection_error);
}
?>