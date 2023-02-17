<!DOCTYPE html>
<html>
<head>
    <title>Consulta</title>
</head>
<body align="center">
<?php
error_reporting(0)
?>
   <h1 style="text-decoration: underline;">filtrar</h1>
   <form method='POST' action='filtrar.php'>
       nombre: <input type='text' name='nombre'> <br><br>
       <input type='submit' name='Consultar' value='Consultar'>
       </form>
       <br>

<?php
// funcion
    function filtrardb($usuario, $basedatos){
    $idConexion = mysqli_connect( "localhost", $usuario , "" );
    if (!$idConexion) 
    {
         die('No se puede conectar' );
    }

    $seleccionada = mysqli_select_db($idConexion,$basedatos);
    if (!$seleccionada) 
    {
        die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
    }
}

// Lamar a la función
filtrardb("root","login");


if (isset($_POST["Consultar"])) 
{
    $nombre = $_POST["nombre"];

    
    
    $consulta = "SELECT nombre, apellido1, apellido2, fechanacimiento, email FROM usuarios WHERE nombre LIKE '$nombre%";
    $resultado = mysqli_query($idConexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) 
    {
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row["nombre"];
    $apellido1 = $row["apellido1"];
    $apellido2 = $row["apellido2"];
    $fechanacimiento = $row["fechanacimiento"];

    echo "<table>
    
    </table>";
    } else 
    {
        echo "<br><br>No se han encontrado resultados.";
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