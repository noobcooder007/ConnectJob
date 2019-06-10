<?php
session_start();

require 'conn.php';
$idPostulator = $_SESSION["idPostulator"];
$ban;

$sql = "SELECT * FROM Postulator WHERE idPostulator = '$idPostulator'";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result)>0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $webPage = ($row["webPage"]==$_POST["webPage"]) ? $row["webPage"] : $_POST["webPage"];
                                            $city = ($row["city"]==$_POST["city"]) ? $row["city"] : $_POST["city"];
                                            $state = ($row["state"]==$_POST["state"]) ? $row["state"] : $_POST["state"];
                                            $telephone = ($row["telepone"]==$_POST["tel"]) ? $row["telephone"] : $_POST["tel"];
                                            $ban = ($_FILES['file-input']['name']=="") ? $ban = false : true;
                                            $img = addslashes(file_get_contents($_FILES['file-input']['tmp_name']));
                                        }
                                    }
                                    if ($ban) $sql = "UPDATE Postulator SET webPage='$webPage', city='$city', state='$state', telephone='$telephone', image='$img' WHERE idPostulator='$idPostulator'";
                                    else $sql = "UPDATE Postulator SET webPage='$webPage', city='$city', state='$state', telephone='$telephone' WHERE idPostulator='$idPostulator'";
                                    if ($conn->query($sql)===TRUE) {
                                        header("Location: panel.php");
                                    }
?>