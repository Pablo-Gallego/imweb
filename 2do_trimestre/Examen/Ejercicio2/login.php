<h1>Login</h1>

<form method="POST">
    Email:<input type="email" name="email">
    <br>
    Contraseña:<input type="password" name="contrasenia">
    <br>
    <input type="submit" name="login" value="Login">
</form>
<a href="registro.php">¿No tienes cuenta? Pulsa aquí para registrarte</a><br>
<a href="baja.php">¿Quieres eliminar la información? Pulsa aquí para darte de baja</a> <!-- añadir enlace baja-->

<?php
if (isset($_POST["login"])) {

    $entradas = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   
    $email = $entradas["email"];
    $contrasenia = $entradas["contrasenia"];

    $idConexion = mysqli_connect("localhost", "root", "");
    if (!$idConexion) {
        die("Error al conectar con base de datos");
    }

    $seleccionada = mysqli_select_db($idConexion, "login");

    if (!$seleccionada) {
        die("Error " . mysqli_error($idConexion));
    }

    $result = mysqli_query($idConexion, "SELECT * FROM usuarios WHERE email='$email' AND contrasenia='$contrasenia'");

    if (!$result) {
        die("Error " . mysqli_error($idConexion));
    }

    $row = mysqli_fetch_array($result);

    if ($row == false) {
        echo "<br>Usuario no existe o la contraseña no es válida.";
    } else {
        echo "<br><h2>Tus datos:</h2>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Nombre: " . $row["nombre"] . "<br>";
        echo "Apellidos: " . $row["apellido1"] . " " . $row["apellido2"] . "<br>";
        echo "Fecha nacimiento: " . $row["fechanacimiento"] . "<br>";
    }

    mysqli_free_result($result);
    mysqli_close($idConexion);
}
?>