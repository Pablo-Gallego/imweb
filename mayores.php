<!DOCTYPE html>
<html>
<head>
    <title>Mayores</title>
</head>
<body align="center">
<?php
error_reporting(0)
?>
<?php 
echo "hola mundo <br>";
$idConexion = mysqli_connect( "localhost", "root" , "" );
if (!$idConexion) {
    die('No se puede conectar' );
}

// Seleccionamos una base de datos
$seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
if (!$seleccionada) {
 die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
}
// Ejecuta sentencia SQL --> resultados en crudo
$result = mysqli_query( $idConexion , "SELECT * FROM agenda where edad > 22" );
if (!$result) 
{
    die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
}
$row = mysqli_data_seek($result,0);
$row = mysqli_fetch_array($result);
echo "<table border='1px' align='center'>
        <tr>
        <th>Nombre</th>
        <th>apellidos</th>
        <th>direccion</th>
        <th>telefono</th>
        <th>edad</th>
        <th>altura</th>
        </tr>
        <tr>"; 
            for ($x = 0; $x < mysqli_num_rows( $result); $x++)
            {echo "<tr>";
            for ($i = 0; $i < 6; $i++)
            {echo "<td>$row[$i]</td>";}
            echo "</tr>";
            $row = mysqli_fetch_array($result);
            }"
        </tr>
    </table>";
    mysqli_free_result($result);

    mysqli_close($idConexion)
?>