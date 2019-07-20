<?php
session_start();

require 'conn.php';

$idJobApplicant = $_POST["idJob"];

$sql = "UPDATE JobApplicant SET state='2' WHERE idJobApplicant='$idJobApplicant'";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

if ($result) echo '200';

else echo 'Error';

?>