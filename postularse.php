<?php
session_start();

require 'conn.php';

$idApplicant = $_SESSION["idApplicant"];
$idOffer = $_POST["idOffer"];

$sql = "SELECT idJobApplicant FROM JobApplicant";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["idJobApplicant"];
    }
} else {
    $id = 0;
}

$id++;

$sql = "INSERT INTO JobApplicant (idJobApplicant, idOffer, idApplicant, state, datePostulate) 
    VALUES ('$id', '$idOffer', '$idApplicant', '1', CURDATE())";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if ($result) {
    echo "200";
}
?>