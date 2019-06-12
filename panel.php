<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$type = $_SESSION["type"];
switch ($type) {
    case '1':
        $idApplicant = $_SESSION["idApplicant"];
        $editar = "editar_aplicante.php";
        $aplicante = "block";
        $empresa = "none";
        break;
    case '2':
        $idPostulator = $_SESSION["idPostulator"];
        $editar = "editar_empresa.php";
        $aplicante = "none";
        $empresa = "block";
        break;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vacantes - ConnectJob</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script>
        function eliminar(idOffer) {  
            var r = confirm("Desea eliminar la vacante");
            if (r == true) {
                var parametros = {
                    "idOffer":idOffer
                    };
                    $.ajax({
                        data:parametros,
                        url:'eliminar_vacante.php',
                        type:'post',
                        success: function (response) {
                            if(response!='200') alert("Ocurrio un error");
                            else window.location.reload();
                        }
                    });
            }
        }

        function postular(idOffer) {  
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
    </script>
</head>

<body>
    <?php
        if ($type=='2') {
            echo '<a href="vacante.php" style="position: fixed; width: 60px; height: 60px; bottom: 40px; right: 110px; background-color: #303f9f; color: white; border-radius: 50px; text-align: center; cursor: pointer;">
            <i class="fa fa-plus" style="margin-top: 25px"></i>
        </a>';
        }
    ?>
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
                <ul class="navbar-content-list">
                    <li><a href="<?php echo $editar ?>">Editar perfil</a></li>
                    <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="body">
        <div class="quest-frec">
            <div class="quest-frec-box">
                <?php
                if ($type==1) {
                    $sql = "SELECT jo.idOffer, jo.title, jo.description, p.company, p.image FROM JobOffers jo JOIN Postulator p ON jo.state='1'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result)>0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $titulo = $row["title"];
                            $descripcion = $row["description"];
                            $company = $row["company"];
                            $image = $row["image"];
                            $idOffer = $row["idOffer"];
                            echo '<div class="quest-frec-box-item-shadow" style="width: 90%">
                        <div class="quest-frec-box-item">
                            <div>
                                <div class="quest-title">
                                    <h4><strong><a href="detalles.php?idoffer='.$idOffer.'">'.$titulo.'</a></strong></h4>
                                    <p>'.$company.'</p>
                                </div>
                                <div class="quest-content">
                                    <p>'.$descripcion.'
                                    </p>
                                </div>
                                <div class="quest-frec-box-item-img">
                                    <img src="data:image/jpeg;base64,'.base64_encode($image).'" width="100" height="100" style="border-radius: 50px">
                                </div>
                                <!--<div style="padding-top: 20px;">
                                    <button id="'.$idOffer.'" class="button-submit" style="display:'.$aplicante.'" href="javascipt:;" onclick="postular('.$idOffer.');return false;">'.$state.'</button>
                                </div>-->
                            </div>
                        </div>
                    </div>';
                    mysqli_close($conn);
                        }
                    }
                } else {
                    $sql = "SELECT jo.idOffer, jo.title, jo.description, p.idPostulator, p.company, p.image FROM JobOffers jo
                    JOIN Postulator p ON jo.idPostulator=p.idPostulator AND p.idPostulator='$idPostulator' 
                    AND jo.state='1'";

                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result)>0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idOffer = $row["idOffer"];
                            $titulo = $row["title"];
                            $descripcion = $row["description"];
                            $idPostulator = $row["idPostulator"];
                            $company = $row["company"];
                            $image = $row["image"];
                            echo '<div class="quest-frec-box-item-shadow" style="width: 90%">
                        <div class="quest-frec-box-item">
                            <div>
                                <div class="quest-title">
                                    <h4><strong><a href="detalles.php?idoffer='.$idOffer.'">'.$titulo.'</a></strong></h4>
                                    <p>'.$company.'</p>
                                </div>
                                <div class="quest-content">
                                    <p>'.$descripcion.'
                                    </p>
                                </div>
                                <div class="quest-frec-box-item-img">
                                    <img src="data:image/jpeg;base64,'.base64_encode($image).'" width="100" height="100" style="border-radius: 50px">
                                </div>
                                <div style="display: flex">
                                <div style="padding-top: 20px;">
                                    <a href="vacante.php?registro='.$idOffer.'"><button class="button-submit" style="display:'.$empresa.'">EDITAR</button></a>
                                </div>
                                <div style="padding-top: 20px; padding-left: 10px">
                                    <button class="button-submit" style="display:'.$empresa.'" href="javascipt:;" onclick="eliminar('.$idOffer.');return false;" >ELIMINAR</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    mysqli_close($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>