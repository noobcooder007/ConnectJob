<?php
session_start();

require 'conn.php';

$idApplicant = $_SESSION["idApplicant"];
$idOffer = $_POST["idOffer"];

$sql = "SELECT * FROM JobApplicant WHERE idOffer=$idOffer AND idApplicant=$idApplicant";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
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
    
    if ($result) {
        echo "200";
    }
} else {
    echo "201";
}

mysqli_close($conn);
?>