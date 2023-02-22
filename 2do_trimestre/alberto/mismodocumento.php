<?php
function hola()
{
    global $idConexion;
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
<form method="POST">
    Nombre<input type="text" name="letra"><br>
    Contraseña<input type="password" name="contrasenia"><br>
    <input type="submit" name="Enviar" value="Enviar">
</form>
<?php
if (isset($_POST['Enviar'])) {


    mysqli_free_result($resultado);
    mysqli_close($idConexion);
}
?>