<!DOCTYPE html>
<html>
<head>
    <title>Consulta</title>
</head>
<?php
error_reporting(0)
?>
<body align="center">
   <h1 style="text-decoration: underline;">Filtrar</h1>
   <form method='POST' action='filtrar.php'>
       nombre: <input type='text' name='nombre'> <br><br>
       <input type='submit' name='Consultar' value='Consultar'>
       </form>
       <br>

<?php
if (isset($_POST["Consultar"])) 
{
    $nombre = $_POST["nombre"];

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
    
    
    $consulta = "SELECT nombre, apellido1, apellido2, fechanacimiento, email FROM usuarios WHERE nombre LIKE '$nombre%'";
    $resultado = mysqli_query($idConexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) 
    {
    $row = mysqli_fetch_assoc($resultado);
    $nombre = $row["nombre"];
    $apellido1 = $row["apellido1"];
    $apellido2 = $row["apellido2"];
    $fechanacimiento = $row["fechanacimiento"];
    $email = $row["email"];

    echo "<table align='center' border=1px>
    <tr>
    <th>nombre</th>
    <th>apellido1</th>
    <th>apellido2</th>
    <th>fechanacimiento</th>
    <th>email</th>
    </tr>
    <tr>
    <td>$nombre</td>
    <td>$apellido1</td>
    <td>$apellido2</td>
    <td>$fechanacimiento</td>
    <td>$email</td>
    </tr>
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