<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$idApplicant = $_SESSION["idApplicant"];
$idOffer = $_GET["idoffer"];
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>