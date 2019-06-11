<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$idPostulator = $_SESSION["idPostulator"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Editar perfil - ConnectJob</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css">
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <script src='assets/js/jquery-3.4.1.min.js'></script>
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
                <div class="quest-frec-box-item-shadow">
                    <form method="POST" action="guardar_empresa.php" enctype="multipart/form-data">
                        <div class="quest-frec-box-item">
                            <div style="display: flex">
                                <div>
                                    <?php
                                    $sql = "SELECT * FROM Postulator WHERE idPostulator = '$idPostulator'";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $company = $row["company"];
                                            $webPage = $row["webPage"];
                                            $city = $row["city"];
                                            $state = $row["state"];
                                            $telephone = $row["telephone"];
                                            $date = $row["dateSignUp"];
                                            $img = $row["image"];
                                        }
                                    }
                                    ?>
                                    <div class="quest-title">

                                        <h2><?php echo $company; ?></h2>

                                    </div>
                                    <div class="quest-title">

                                        <label>Página web</label>
                                        <input id="sign-input" type="text" name="webPage" placeholder="Página web"
                                            value="<?php echo $webPage ?>" required>

                                    </div>
                                    <div class="quest-content">
                                        <label>Ciudad</label>

                                        <input id="sign-input" type="text" name="city" placeholder="Ciudad"
                                            value="<?php echo $city; ?>" require>

                                    </div>
                                    <div class="quest-content">
                                        <label>Estado</label>

                                        <input id="sign-input" type="text" name="state" placeholder="Estado"
                                            value="<?php echo $state; ?>" require>

                                    </div>
                                    <div class="quest-content">
                                        <label>Introduce un numero de telefono o celular</label>

                                        <input id="sign-input" type="tel" name="tel" placeholder="XXX-XXX-XXXX"
                                            maxlength="12" value="<?php echo $telephone; ?>" require>

                                    </div>
                                    <div class="quest-content">

                                        <label>Miembro desde <?php echo $date; ?></label>

                                    </div>
                                    <div style="display: flex">
                                        <div>
                                            <button onclick="function () {
                                                window.location(" panel.php"); }"
                                                class="button-submit">CANCELAR</button>
                                        </div>
                                        <div style="padding-left: 10px;">
                                            <input type="submit" class="button-submit" value="GUARDAR">
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 40px;">
                                    <div style="padding: 8px;">
                                        <?php echo '<img for="file-input" id="imgSalida" width="250" height="250" style="border-radius: 125px" src="data:image/jpeg;base64,' . base64_encode($img) . '">'; ?>
                                    </div>
                                    <div class="quest-content">
                                        <input type="file" accept="image/jpeg" name="file-input" id="file-input"
                                            require />
                                        <script>
                                        function readFile(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                reader.onload = function(e) {
                                                    var filePreview = document.getElementById('imgSalida');
                                                    filePreview.src = e.target.result;
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                        var fileUpload = document.getElementById('file-input');
                                        fileUpload.onchange = function(e) {
                                            readFile(e.srcElement);
                                        }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
mysqli_close($conn);
?>