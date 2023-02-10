<h1>Baja</h1>
<form method="POST">
    Email: <input type="email" name="email">
    <br>
    Contraseña: <input type="password" name="contrasenia">
    <br>
    Nombre: <input type="text" name="nombre"><!-- campos para la eliminación-->
    <br>
    <input type="submit" name="baja" value="Darse de baja">
</form>
<a href="login.php">¿Ya estás registrado? Pulsa aquí para loguearte</a><br> <!-- añadir enlace a login-->
<a href="registro.php">¿Aun no estás registrado? Pulsa aquí para registrarte</a><!-- añadir enlace a registrarse-->

<?php
if (isset($_POST["baja"])) {	
    $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // Sanear las entradas
    $email = $entradas["email"];
    $contrasenia = $entradas["contrasenia"];
    $nombre = $entradas["nombre"]; // Entradas saneadas

    $idConexion = mysqli_connect("localhost", "root", "");
    if (!$idConexion) {
        die("Error al conectar con base de datos");
    }

    $seleccionada = mysqli_select_db($idConexion, "login");

    if (!$seleccionada) {
        die("Error " . mysqli_error($idConexion));
    }

    $result = mysqli_query($idConexion, "DELETE FROM usuarios WHERE nombre = '$nombre' and contrasenia = '$contrasenia' and email = '$email'");
    // Realizar la query que realizara la eliminación de datos al darse ciertas condiciones

    if (!$result) {
        die("Error " . mysqli_error($idConexion));
    }

    $filasAfectadas = mysqli_affected_rows($idConexion);
    
    if ($filasAfectadas != 0) {
        echo "<br>El usuario con el email ". $email ." se ha dado de baja correctamente"; // mostrar el email si se ha borrado todo
    }
    else {
        echo "<br>El usuario no existe o la contraseña es incorrecta."; // mensaje de fallo
    }
    
    mysqli_close($idConexion);
}
?>