<?php
session_cache_expire(30);
session_start();

require 'conn.php';

$idApplicant = $_SESSION["idApplicant"];
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
</head>

<body>
    <a href="#" style="position: fixed; width: 60px; height: 60px; bottom: 40px; right: 110px; background-color: #303f9f; color: white; border-radius: 50px; text-align: center; cursor: pointer;">
        <i class="fa fa-plus" style="margin-top: 25px"></i>
    </a>
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
                <?php

                ?>
                <ul class="navbar-content-list">
                    <li><a href="editar_aplicante.php">Editar perfil</a></li>
                    <li><a href="index.html">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="body">
        <div class="quest-frec">
            <div class="quest-frec-box">
                <div class="quest-frec-box-item-shadow">
                    <div class="quest-frec-box-item">
                        <div>
                            <div class="quest-title">
                                <h4><strong><a href="#">Ingeniero en sistemas computacionales</a></strong></h4>
                                <p>ConnectJob</p>
                            </div>
                            <div class="quest-content">
                                <p>Ocupamos un ingeniero en sistemas computacionales o carrera afin para apoyo en el
                                    area de mesa de
                                    ayuda, esta vacante se encuentra disponible en la ciudad de Guadalajara, con
                                    oportunidad para residencias.
                                </p>
                            </div>
                            <div class="quest-frec-box-item-img">
                                <img src="assets/images/icon.png" width="100" height="100">
                            </div>
                            <div style="padding-top: 20px;">
                                <button class="button-submit">POSTULARME</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="quest-frec-box-item-shadow">
                    <div class="quest-frec-box-item">
                        <div>
                            <div class="quest-title">
                                <h4><strong><a href="#">Ingeniero en sistemas computacionales</a></strong></h4>
                                <p>ConnectJob</p>
                            </div>
                            <div class="quest-content">
                                <p>Ocupamos un ingeniero en sistemas computacionales o carrera afin para apoyo en el
                                    area de mesa de
                                    ayuda, esta vacante se encuentra disponible en la ciudad de Guadalajara, con
                                    oportunidad para residencias.
                                </p>
                            </div>
                            <div class="quest-frec-box-item-img">
                                <img src="assets/images/icon.png" width="100" height="100">
                            </div>
                            <div style="padding-top: 20px;">
                                <button class="button-submit">POSTULARME</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>