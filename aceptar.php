<?php
session_start();

require 'conn.php';

$idJobApplicant = $_GET["idJob"];

$sql = "UPDATE JobApplicant SET state='2' WHERE idJobApplicant='$idJob'";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if ($result) echo '200';

?>