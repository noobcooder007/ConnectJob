<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$idApplicant = $_SESSION["idApplicant"];
$idPostulator = $_SESSION["idPostulator"];
$idOffer = $_GET["idoffer"];
$type = $_SESSION["type"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Detalles vacante - ConnectJob</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script>
        function postular(state, idOffer) {
            if (state!=3) {
            alert("No se puede postular dos veces");
            } else {
                var parametros = {
                "idOffer":idOffer
                };
                $.ajax({
                    data:parametros,
                    url:'postularse.php',
                    type:'post',
                    success: function (response) {
                        if(response!='200') alert("Ocurrio un error");
                        else $('#'+idOffer+'').html("POSTULADO");
                }
            });
            }
        }

        function aceptar(idJobApplicant) {
                var parametros = {
                "idJob":idJobApplicant
                };
                $.ajax({
                    data:parametros,
                    url:'aceptar.php',
                    type:'post',
                    success: function (response) {
                        if(response!='200') alert("Ocurrio un error");
                        else $('#'+idJobApplicant+'').html("ACEPTADO");
                }
            });
        }    
    </script>
</head>

<body>
    <div class="index-menu">
        <nav class="navbar">
            <div class="navbar-content">
                <span>
                    <div class="navbar-content-home">
                        <a href="panel.php">
                            <span>ConnectJob</span>
                        </a>
                    </div>
                </span>
            </div>
        </nav>
    </div>
    <div class="body">
        <div class="quest-frec">
            <div class="quest-frec-box">
                <div class="quest-frec-box-item-shadow">
                    <?php
                        if ($type==1) {
                            $sql = "SELECT ja.idJobApplicant, ja.state, jo.idOffer, jo.title, jo.description, jo.salary, jo.place, jo.publicate, p.company, p.image FROM JobOffers jo 
                            JOIN Postulator p JOIN JobApplicant ja ON ja.idApplicant='$idApplicant' AND jo.state='1' AND ja.state='1' AND jo.idOffer = ja.idOffer AND jo.idOffer='$idOffer'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $titulo = $row["title"];
                                $descripcion = $row["description"];
                                $company = $row["company"];
                                $salario = $row["salary"];
                                $lugar = $row["place"];
                                $fecha = $row["publicate"];
                                $image = $row["image"];
                                $state = $row["state"];
                            }
                            if ($state=='1') {
                                $num = 1;
                                $state = "POSTULADO";
                            } elseif ($state=='2') {
                                $state = "ACEPTADO";
                            }
                        } else {
                            $sql = "SELECT ja.idJobApplicant, ja.state, jo.idOffer, jo.title, jo.description, jo.salary, jo.place, jo.publicate, p.company, p.image FROM JobOffers jo 
                            JOIN Postulator p JOIN JobApplicant ja ON ja.idApplicant='$idApplicant' AND jo.state='1' AND ja.state='2' AND jo.idOffer = ja.idOffer AND jo.idOffer='$idOffer'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $titulo = $row["title"];
                                $descripcion = $row["description"];
                                $company = $row["company"];
                                $salario = $row["salary"];
                                $lugar = $row["place"];
                                $fecha = $row["publicate"];
                                $image = $row["image"];
                                $state = $row["state"];
                            }
                            if ($state=='1') {
                                $state = "POSTULADO";
                            } elseif ($state=='2') {
                                $num = 2;
                                $state = "ACEPTADO";
                            }
                        }
                        else {
                        
                            $sql = "SELECT jo.idOffer, jo.title, jo.description, jo.salary, jo.place, jo.publicate, p.company, p.image FROM JobOffers jo JOIN Postulator p JOIN JobApplicant ja ON ja.idApplicant='$idApplicant' AND jo.state='1' AND jo.idOffer='$idOffer'";
                            $result = mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $titulo = $row["title"];
                                $descripcion = $row["description"];
                                $company = $row["company"];
                                $salario = $row["salary"];
                                $lugar = $row["place"];
                                $fecha = $row["publicate"];
                                $image = $row["image"];
                                $state = "POSTULARME";
                                $num = 3;
                            }
                        }
                        }
                    }
                        
                    
                    ?>
                        <div class="quest-frec-box-item">
                            <div style="display: flex">
                                <div>
                                    <div class="quest-title">
                                        <h2><?php echo $company ?></h2>
                                    </div>
                                    <div class="quest-content">
                                        <label><?php echo $titulo ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Descripción: <?php echo $descripcion ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Salario: <?php echo $salario ?></label>
                                    </div>
                                    <div class="quest-content" style="display: block">
                                        <label>Lugar: <?php echo $lugar ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Publicado el <?php echo $fecha ?></label>
                                    </div>
                                    <div style="display: flex">
                                        <div>
                                            <?php echo '<button id="'.$idOffer.'" class="button-submit" href="javascript:;" onclick="postular('.$num.','.$idOffer.');return false;">'.$state.'</button>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 40px;">
                                    <div style="padding: 8px;">
                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'" width="250" height="250" style="border-radius: 125px">'; ?>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php
                        } else {
                            $sql = "SELECT jo.idOffer, jo.title, jo.description, jo.salary, jo.place, jo.publicate, p.company, p.image FROM JobOffers jo JOIN Postulator p JOIN JobApplicant ja ON jo.idPostulator='$idPostulator' AND jo.state='1' AND jo.idOffer='$idOffer'";
                            $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $titulo = $row["title"];
                                $descripcion = $row["description"];
                                $company = $row["company"];
                                $salario = $row["salary"];
                                $lugar = $row["place"];
                                $fecha = $row["publicate"];
                                $image = $row["image"];
                            }
                        }
                    
                    ?>
                        <div class="quest-frec-box-item">
                            <div style="display: flex">
                                <div>
                                    <div class="quest-title">
                                        <h2><?php echo $company ?></h2>
                                    </div>
                                    <div class="quest-content">
                                        <label><?php echo $titulo ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Descripción: <?php echo $descripcion ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Salario: <?php echo $salario ?></label>
                                    </div>
                                    <div class="quest-content" style="display: block">
                                        <label>Lugar: <?php echo $lugar ?></label>
                                    </div>
                                    <div class="quest-content">
                                        <label>Publicado el <?php echo $fecha ?></label>
                                    </div>
                                </div>
                                <div style="margin-left: 40px;">
                                    <div style="padding: 8px;">
                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'" width="250" height="250" style="border-radius: 125px">'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php
                        }

                        $sql = "SELECT jo.idOffer, ja.idJobApplicant, ja.state, a.name, a.lastname, a.image FROM JobOffers jo JOIN Applicant a JOIN JobApplicant ja ON jo.idPostulator='1' AND jo.state='1' AND jo.idOffer='$idOffer' AND jo.idPostulator = '$idPostulator' AND a.idApplicant = ja.idJobApplicant AND jo.idOffer=ja.idOffer";

                        $result = mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        if (mysqli_num_rows($result)>0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idJobApplicant = $row["idJobApplicant"];
                                $name = $row["name"]." ".$row["lastname"];
                                $image = $row["image"];
                                $state = $row["state"];
                                $state = ($state=='2') ? $state = "ACEPTADO" : $state = "ACEPTAR";
                                echo '<div class="quest-frec-box-item-shadow" style="width: 100%">
                        <div class="quest-frec-box-item">
                            <div style="display: flex">
                                <div class="quest-frec-box-item-img">
                                    <img src="data:image/jpeg;base64,'.base64_encode($image).'" width="50" height="50" style="border-radius: 25px">
                                </div>
                                <div class="quest-title">
                                    <h4><strong>'.$name.'</strong></h4>
                                </div>
                                <div style="padding-top: 20px; padding-left: 220px">
                                    <button id="'.$idJobApplicant.'" class="button-submit" style="display:'.$empresa.'" href="javascipt:;" onclick="aceptar('.$idJobApplicant.');return false;" >'.$state.'</button>
                                </div>
                            </div>
                        </div>';
                            }
                        }
                        ?>
            </div>
        </div>
    </div>
</body>

</html>