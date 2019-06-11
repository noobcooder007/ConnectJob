<?php
session_start();

require 'conn.php';

$idPostulator = $_SESSION["idPostulator"];
$titulo = $_POST["titulo"];
$desc = $_POST["desc"];
$salario = $_POST["salario"];
$lugar = $_POST["lugar"];

$sql = "SELECT idOffer FROM JobOffers";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["idOffer"];
    }
} else {
    $id = 0;
}

$id++;

$sql = "INSERT INTO JobOffers (idOffer, idPostulator, title, description, salary, place, publicate, state) 
    VALUES ('$id', '$idPostulator', '$titulo', '$desc', '$salario', '$lugar', CURDATE(), '1')";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if ($result) {
    header("Location: panel.php");
}
?>