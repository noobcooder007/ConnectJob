<?php
session_start();

require 'conn.php';

$table = "Users";
$id;
$email = $_POST['correo'];
$company = $_POST['empresa'];
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
    VALUES ('$id', '$email', '$password', '2', '1')";

    if ($conn->query($sql)===TRUE) {
        $idPostulator;
        $table = "Postulator";
        $sql = "SELECT idPostulator FROM $table";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idPostulator = $row["idPostulator"];
            }
        } else {
            $idPostulator = 0;
        }

        $idPostulator++;
        $sql = "INSERT INTO Postulator (idPostulator, idUser, company, webPage, city, state, telephone, image, dateSignUp)
            VALUES ('$idPostulator', '$id', '$company', '', '', '', '', '', CURDATE())";
        if($conn->query($sql)===TRUE) {
            $msg = '200';
            $_SESSION["idPostulator"]=$idPostulator;
            $_SESSION["idUser"]=$id;
            $_SESSION["type"]=2;
            //mail($email, 'Creación de cuenta en ConnectJob', 'Bienvenido a la comunidad de ConnectJob', 'From: support@connectjob.com.mx');
        } else {
            $msg = "Ocurrio un error";
        }
    }
}

mysqli_close($conn);

echo $msg;
?>