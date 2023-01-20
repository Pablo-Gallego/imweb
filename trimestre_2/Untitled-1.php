<!DOCTYPE html>
<html>
<head>
    <title>Ciudades</title>
</head>
<body align="center">
<?php
error_reporting(0)
?>
<?php 
$idConexion = mysqli_connect( "localhost", "root" , "" );
if (!$idConexion) {
    die('No se puede conectar' );
}

$seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
if (!$seleccionada) {
 die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
}

$result = mysqli_query( $idConexion , "SELECT * FROM ciudades" );
if (!$result) {
    die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
}

$row = mysqli_data_seek($result,0);
$row = mysqli_fetch_array($result);

echo "<br><h1>Tabla</h1><br>";
echo "<table border='1px' align='center'>
        <tr>
        <th>ID</th>
        <th>Ciudad</th>
        <th>País</th>
        <th>Habitantes</th>
        <th>superficie</th>
        <th>Selecionar</th>
        </tr>
        <tr>"; 
            for ($x = 0; $x < mysqli_num_rows($result); $x++)
            {echo "<tr>";
            for ($i = 0; $i < 6; $i++) // 6 son el número de columnas que hay
            {echo "<td>$row[$i]</td>";}
            echo "</tr>";
            $row = mysqli_fetch_array($result);
            }"
        </tr>
    </table>";
mysqli_free_result($result);
?>
</body>
</html>