<?php
function hola() {
    $idConexion = mysqli_connect("localhost", "root", "");
    if (!$idConexion) {
        die("Error al conectar");
    }
    $seleccionada = mysqli_select_db($idConexion, "login"); 
    if (!$seleccionada) {
        die("Error al buscar");
    } 
    return $idConexion;
} 
?>