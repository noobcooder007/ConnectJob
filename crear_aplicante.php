<?php
session_start();

require 'conn.php';

$table = "Users";
$id;
$email = $_POST['correo'];
$name = $_POST['nombre'];
$lastname = $_POST['apellido'];
$password = $_POST['contraseña1'];

$sql = "SELECT email FROM $table WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

$msg;

if ((mysqli_num_rows($result) > 0) || (mysqli_num_rows($result) != null)) {
    sleep(5);
    $msg = 'Correo en uso';
} else {
    $sql = "SELECT idUser FROM $table";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row["idUser"];
        }
    } else {
        $id = 0;
    }

    $id++;

    $sql = "INSERT INTO Users (idUser, email, password, type, stateAccount)
    VALUES ('$id', '$email', '$password', '1', '1')";

    if ($conn->query($sql)===TRUE) {
        $idApplicant;
        $table = "Applicant";
        $sql = "SELECT idApplicant FROM $table";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idApplicant = $row["idApplicant"];
            }
        } else {
            $idApplicant = 0;
        }

        $idApplicant++;
        $sql = "INSERT INTO Applicant (idApplicant, idUser, name, lastname, city, state, telephone, genre, image, dateSignUp)
            VALUES ('$idApplicant', '$id', '$name', '$lastname', '', '', '', '', '', CURDATE())";
        if($conn->query($sql)===TRUE) {
            $msg = '200';
            $_SESSION["idApplicant"]=$idApplicant;
            $_SESSION["idUser"]=$id;
        } else {
            $msg = "Ocurrio un error";
        }
    }
}

mysqli_close($conn);

echo $msg;
?>