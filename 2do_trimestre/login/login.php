<!DOCTYPE html>
<html>
<head>
    <title>Consulta</title>
</head>
<body align="center">
<?php
error_reporting(0)
?>
   <h1 style="text-decoration: underline;">Login</h1>
   <form method='POST' action='login.php'>
       Email: <input type='text' name='email'> <br><br>
       Contraseña: <input type='password' name='contrasenia'> <br><br>
       <input type='submit' name='Consultar' value='Consultar'>
       </form>
       <br>
       <a href="registro.php">¿No tienes cuenta? Pulsa aquí para registrarte</a>
<?php
if (isset($_POST["Consultar"])) 
{
    $email = $_POST["email"];
    $contrasenia = $_POST["contrasenia"];
    $datos = array("email" => $email, "contrasenia" => $contrasenia); // Esto lo pongo por si alguien se copia que se sepa

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
    
    $consulta = "SELECT * FROM usuarios WHERE email = '$email' AND contrasenia = '$contrasenia'";
    $resultado = mysqli_query($idConexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) 
    {
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row["nombre"];
    $apellido1 = $row["apellido1"];
    $apellido2 = $row["apellido2"];
    $fechanacimiento = $row["fechanacimiento"];

    echo "<h1>Tus datos personales:</h1>";
    echo "Nombre: ". $nombre;
    echo "<br>";
    echo "Apelidos ". $apellido1. " " .$apellido2;
    echo "<br>";
    echo "Fecho nacimiento ". $fechanacimiento;
    } else 
    {
        echo "<br><br>No estás registrado o la contraseña es incorrecta.";
    }
    mysqli_close($idConexion);
} else 
{
   echo "<br><br>Introduce tus datos";
}
    mysqli_close($idConexion);
?>
</body>
</html>