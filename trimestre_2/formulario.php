<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>formulario</title>
</head>
<body align="center">
<h1>formulario</h1>
    <form action="formulario.php" method="post">
    <label for="nombre">Nombre: </label><br>
    <input type="text" name="nombre" id="nombre"> <br><br>
    <label for="apellidos">Apellidos: </label><br>
    <input type="text" name="apellidos" id="apellidos"> <br><br>
    <label for="nombre">Direccion: </label><br>
    <input type="text" name="direccion" id="direccion"> <br><br>
    <label for="telefono">Telefono: </label><br>
    <input type="number" name="telefono" id="telefono" min="0" max="999999999"> <br><br>
    <label for="edad">Edad: </label><br>
    <input type="number" name="edad" id="edad" min="0" max="100"> <br><br>
    <label for="altura">Altura en m: EJ:(1.80) </label><br>
    <input type="decimal" name="altura" id="altura" min="0"> <br><br>
    <br><br>
    <input type="submit"  name="enviar" value="Enviar">
</form>
<h1>Comprobación</h1>
<?php
if (isset($_POST["enviar"])) 
{
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $edad = $_POST["edad"];
    $altura = $_POST["altura"];
    $datos = array("nombre" => $nombre, "apellidos" => $apellidos, "direccion" => $direccion,
     "telefono" => $telefono, "edad" => $edad, "altura" => $altura);
    
    $Conexion = mysqli_connect( "localhost", "root" , "" );
    if (!$Conexion) 
    {
        die('No se puede conectar' );
    }

    $seleccionar = mysqli_select_db($Conexion,"apuntesBD1");
    if (!$seleccionar) 
    {
        die ("No se puede usar: ". mysqli_error($Conexion)); 
    }

    $insertar = mysqli_query($Conexion, "INSERT INTO agenda VALUES ('$nombre', '$apellidos', '$direccion', '$telefono', '$edad', '$altura')");

    mysqli_close($Conexion);
}
?>
</body>
</html>