<!DOCTYPE html>
<html>
<head>
    <title>Ciudades</title>
</head>
<body align="center">
<?php
error_reporting(0)
?>
   <h1 style="text-decoration: underline;">Registro</h1>
   <form method='POST' action='registro.php'>
       Email: <input type='text' name='email'> <br><br>
       Contraseña: <input type='password' name='contrasenia'> <br><br>
       Nombre: <input type='text' name='nombre'> <br><br>
       Apellido 1: <input type='text' name='apellido1'> <br><br>
       Apellido 2: <input type='text' name='apellido2'> <br><br>
       Fecha nacimiento: <input type='date' name='fechanacimiento'> <br><br>
       <input type='submit' name='Registrar' value='Registrarme'>
       </form>
       <br>
       <a href="login.php">¿Ya estás registrado? Pulsa aquí para loguearte</a>
<?php
    if (isset($_POST["Registrar"])) 
    {
        $email = $_POST["email"];
        $contrasenia = $_POST["contrasenia"];
        $nombre = $_POST["nombre"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $fechanacimiento = $_POST["fechanacimiento"];

        $datos = array("email" => $email, "contrasenia" => $contrasenia, "nombre" => $nombre,
        "apellido1" => $apellido1, "apellido2" => $apellido2, "fechanacimiento" => $fechanacimiento);

        $idConexion = mysqli_connect( "localhost", "root" , "" );
        if (!$idConexion) 
        {
             die('No se puede conectar' );
        }

        $seleccionada = mysqli_select_db($idConexion,"login");

        if (!$seleccionada) 
        {
            die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
        }

        $result = mysqli_query($idConexion, "INSERT INTO usuarios VALUES ('$email', '$contrasenia', '$nombre', '$apellido1', '$apellido2', '$fechanacimiento');");
        mysqli_close($idConexion);
    } else 
    {
        echo "<br><br>No se hizo nada";
    }
   mysqli_close($idConexion);
?>
</body>
</html>