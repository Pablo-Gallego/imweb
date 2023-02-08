<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>formulario</title>
</head>
<body align="center">
<h1>formulario para crear usuarios</h1>
    <form action="borrar.php" method="post">
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
    <input type="submit"  name="Guardar" value="Guardar">
</form>
<h1>formulario para borrar</h1>
    <form action="borrar.php" method="post">
    <label for="telefono">Telefono: </label><br>
    <input type="number" name="telefono" id="telefono" min="0" max="999999999"> <br><br>
    <input type="submit"  name="Borrar" value="Borrar">
</form>
<?php
if (isset($_POST["Guardar"])) 
{
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $edad = $_POST["edad"];
    $altura = $_POST["altura"];
    
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
} else if (isset($_POST["Borrar"]))
{
    $telefono = $_POST["telefono"];
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

    $borrar = mysqli_query($Conexion, "DELETE FROM agenda WHERE telefono = '$telefono'");

    $registros_borrados = mysqli_affected_rows($Conexion);
    if ($registros_borrados == 0) {
        echo "No se ha eliminado ninguna fila";
    } elseif ($registros_borrados == 1){
        echo "Se ha eliminado ". $registros_borrados . " fila";
    }else {
        echo "Se han eliminado ". $registros_borrados . " filas";
    }
    mysqli_close($Conexion);
}
?>
</body>
</html>