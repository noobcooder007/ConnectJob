<?php
session_start();
session_unset();
session_destroy();
session_start();

require 'conn.php';

$email = $_POST["correo"];
$password = $_POST["contraseña"];
$msg;

$sql = "SELECT * FROM Users WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $idUser = $row["idUser"];
        $correo = $row["email"];
        $contraseña = $row["password"];
        $type = $row["type"];
    }
}

if (($correo==$email)&&($contraseña==$password)) {
    $msg = "200";
    $_SESSION["type"]=$type;
    switch ($type) {
        case '1':
            $sql = "SELECT idApplicant FROM Applicant WHERE idUser='$idUser'";

            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idApplicant = $row["idApplicant"];
                }
            }
            $_SESSION["idApplicant"]=$idApplicant;
            break;
        case '2':
            $sql = "SELECT idPostulator FROM Postulator WHERE idUser='$idUser'";

            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idPostulator = $row["idPostulator"];
                }
            }
            $_SESSION["idPostulator"]=$idPostulator;
            break;
    }
} else {
    $msg = "Correo o contraseña incorrectos";
}

echo $msg;

mysqli_close($conn);
?>