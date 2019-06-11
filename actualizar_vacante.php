<?php
session_start();

require 'conn.php';

$idOffer = $_GET["registro"];
$titulo = $_POST["titulo"];
$desc = $_POST["desc"];
$salario = $_POST["salario"];
$lugar = $_POST["lugar"];

$sql = "UPDATE JobOffers SET title='$titulo', description='$desc', salary='$salario', place='$lugar' WHERE idOffer='$idOffer'";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if ($result) header("Location: panel.php");

?>