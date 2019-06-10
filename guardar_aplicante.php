<?php
session_start();

require 'conn.php';
$idApplicant = $_SESSION["idApplicant"];
$ban;

$sql = "SELECT * FROM Applicant WHERE idApplicant = '$idApplicant'";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result)>0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $city = ($row["city"]==$_POST["city"]) ? $row["city"] : $_POST["city"];
                                            $state = ($row["state"]==$_POST["state"]) ? $row["state"] : $_POST["state"];
                                            $telephone = ($row["telepone"]==$_POST["tel"]) ? $row["telephone"] : $_POST["tel"];
                                            $genre = ($row["genre"]==$_POST["genre"]) ? $row["genre"] : $_POST["genre"];
                                            $ban = ($_FILES['file-input']['name']=="") ? $ban = false : true;
                                            $img = addslashes(file_get_contents($_FILES['file-input']['tmp_name']));
                                        }
                                    }
                                    if ($genre=='Masculino') $genre=0;
                                    elseif ($genre=='Femenino') $genre=1;
                                    if ($ban) $sql = "UPDATE Applicant SET city='$city', state='$state', telephone='$telephone', genre='$genre', image='$img' WHERE idApplicant='$idApplicant'";
                                    else $sql = "UPDATE Applicant SET city='$city', state='$state', telephone='$telephone', genre='$genre' WHERE idApplicant='$idApplicant'";
                                    if ($conn->query($sql)===TRUE) {
                                        header("Location: panel.php");
                                    }
?>