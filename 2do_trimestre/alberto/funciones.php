<?php

function conectarSeleccionarBaseDatos() {
    $idConexion = mysqli_connect("localhost", "root", "");
    if (!$idConexion) {
        die("Ha habido un error al conectarse.");
    }
    $seleccionada = mysqli_select_db($idConexion, "login");
    if (!$seleccionada) {
        die("Ha ocurrido un error: " . mysqli_error($idConexion));
    }

    return $idConexion;
}
