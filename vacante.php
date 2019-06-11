<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$idOffer = $_GET["registro"];

if ($idOffer>0) {
    $editar = "Editar";
    $post = "actualizar_vacante.php?registro=$idOffer";
    $button = "ACTUALIZAR";
}
else {
    $editar = "Añadir";
    $post = "añadir_vacante.php";
    $button = "AGREGAR";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo $editar ?> vacante - ConnectJob</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script>
        function volverPanel() {
            window.location.replace("panel.php");
        }
    </script>
</head>

<body>
    <div class="index-menu">
        <nav class="navbar">
            <div class="navbar-content">
                <span>
                    <div class="navbar-content-home">
                        <a>
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
                <form method="POST" action="<?php echo $post ?>">
                        <div class="quest-frec-box-item-shadow" style="margin-left: 16%">
                                <div class="quest-frec-box-item">
                                <?php
                                    $sql = "SELECT * FROM JobOffers WHERE idOffer = '$idOffer'";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result)>0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $titulo = $row["title"];
                                            $desc = $row["description"];
                                            $salario = $row["salary"];
                                            $lugar = $row["place"];
                                        }
                                    }
                                    ?>
                                        <div>
                                            <div class="quest-title">
                                                <h2><?php echo $editar ?> vacante</h2>
                                            </div>
                                            <div class="quest-content">
                                                <label>Titulo</label>
                                                <input id="sign-input" type="text" placeholder="Cargo o puesto" name="titulo" value="<?php echo $titulo ?>" required>
                                            </div>
                                            <div class="quest-content">
                                                <label>Descripcion</label>
                                                <input id="sign-input" type="text" placeholder="Breve descripción acerca de la vacante" name="desc" value="<?php echo $desc ?>" required>
                                            </div>
                                            <div class="quest-content">
                                                <label>Salario</label>
                                                <input id="sign-input" type="number" min="0" name="salario" value="<?php echo $salario ?>" required>
                                            </div>
                                            <div class="quest-content" style="display: block">
                                                <label>Lugar</label>
                                                <input id="sign-input" type="text" placeholder="Lugar de la vacante" name="lugar" value="<?php echo $lugar ?>" required>
                                            </div>
                                            <div style="display: flex">
                                                <div>
                                                    <button class="button-submit" onclick="volverPanel()">CANCELAR</button>
                                                </div>
                                                <div style="padding-left: 10px;">
                                                    <button class="button-submit"><?php echo $button ?></button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>