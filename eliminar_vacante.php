<?php
session_start();

require 'conn.php';

$idOffer = $_POST["idOffer"];

$sql = "UPDATE JobOffers SET state='0' WHERE idOffer='$idOffer'";

$result = mysqli_query($conn, $sql);

if ($result) echo '200';

?>