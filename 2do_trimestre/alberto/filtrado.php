<form method="POST">
    Filtrar por nombre:
    <input type="text" name="letra">
    <br>
    <input type="submit" name="filtrar" value="Filtrar">
</form>
<?php
require("funciones.php");
if (isset($_POST['filtrar'])) {
    $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $letra = $entradas["letra"];

    $idConexion = conectarSeleccionarBaseDatos();

    $resultado = mysqli_query($idConexion, "SELECT * FROM usuarios WHERE nombre LIKE '$letra%'");

    if (!$resultado) {
        die("Ha ocurrido un error: " . mysqli_error($idConexion));
    }

    $numFilas = mysqli_num_rows($resultado);

    if ($numFilas == 0) {
        echo "No hay ningún nombre que empiece por $letra.";
    } else {
        $array = mysqli_fetch_array($resultado);

        echo "<table border=1>";
        echo "<tr>"
            . "<th>Nombre</th>"
            . "<th>Primer apellido</th>"
            . "<th>Segundo apellido</th>"
            . "<th>Fecha de nacimiento</th>"
            . "<th>Email</th>"
            . "</tr>";

        if ($array != 0) {
            $nombre = $array['nombre'];
            $apellido1 = $array['apellido1'];
            $apellido2 = $array['apellido2'];
            $fechanacimiento = $array['fechanacimiento'];
            $email = $array['email'];

            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>$apellido1</td>";
            echo "<td>$apellido2</td>";
            echo "<td>$fechanacimiento</td>";
            echo "<td>$email</td>";
            echo "</tr>";
            $array = mysqli_fetch_array($resultado);
        }
        echo "</table>";
    }

    mysqli_free_result($resultado);
    mysqli_close($idConexion);
}
?>