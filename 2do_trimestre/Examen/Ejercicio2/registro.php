<h1>Registro</h1>
<form method="POST">
    Email: <input type="email" name="email">
    <br>
    Contraseña: <input type="password" name="contrasenia">
    <br>
    Repetir Contraseña: <input type="password" name="repe_contrasenia"> <!-- repetir la contraseña -->
    <br>
    Nombre: <input type="text" name="nombre">
    <br>
    Primer apellido: <input type="text" name="apellido1">
    <br>
    Segundo apellido: <input type="text" name="apellido2">
    <br>
    Fecha nacimiento: <input type="date" name="fechanacimiento">
    <br>
    <input type="submit" name="registro" value="Registrarse">
</form>
<a href="login.php">¿Ya estás registrado? Pulsa aquí para loguearte</a><br>
<a href="baja.php">¿Quieres eliminar la información? Pulsa aquí para darte de baja</a><!-- añadir enlace baja-->
<?php
if (isset($_POST["registro"])) {	
    $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	
    $email = $entradas["email"];
    $contrasenia = $entradas["contrasenia"];
    $contraseniarepe = $entradas["repe_contrasenia"]; // guardar repetir la contraseña
    $nombre = $entradas["nombre"];
    $apellido1 = $entradas["apellido1"];
    $apellido2 = $entradas["apellido2"];
    $fechanacimiento = $entradas["fechanacimiento"];
    $fechanacimiento = date("Y-m-d", strtotime($fechanacimiento));

    if($contrasenia == $contraseniarepe) // comparar repetir la contraseña con la contraseña
    {

    $idConexion = mysqli_connect("localhost", "root", "");
    if (!$idConexion) {
        die("Error al conectar con base de datos");
    }

    $seleccionada = mysqli_select_db($idConexion, "login");

    if (!$seleccionada) {
        die("Error " . mysqli_error($idConexion));
    }

    $result = mysqli_query($idConexion, "INSERT INTO usuarios VALUES('$email', '$contrasenia', '$nombre', '$apellido1', '$apellido2', '$fechanacimiento')");

    if (!$result) {
        die("Error " . mysqli_error($idConexion));
    }

    $filasAfectadas = mysqli_affected_rows($idConexion);
    
    if ($filasAfectadas == 0) {
        echo "<br>No se ha podido completar el registro por un error.";
    }
    else {
        echo "<br>¡Registrado correctamente!";
    }
    
    mysqli_close($idConexion);
    } else  // Se ejecuta si las contraseñas no coinciden
    {
        echo "<p style='color:red'>Las contraseñas no coinciden</p>";
    } // mensaje de error en color rojo
}
?>