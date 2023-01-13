<!DOCTYPE html>
<html>
<head>
    <title>Zona de prueba de bombas</title>
</head>
<body align="center">
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
$result = mysqli_query( $idConexion , "SELECT * FROM agenda" );
if (!$result) {
    die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
   }

//Obtener fila en concreto
$row = mysqli_data_seek($result,2);

//Obtener fila en formato array
$row = mysqli_fetch_array($result);

// Mostramos los datos en la pagina
echo $row["nombre"]." ". $row["apellidos"].", vive en ". $row["direccion"].", su numero de telefono es ". 
$row["telefono"]." tiene ". $row["edad"]." años y mide ". $row["altura"] . "<br>";

// Segunda
$row = mysqli_fetch_array($result);
echo $row["nombre"]." ". $row["apellidos"].", vive en ". $row["direccion"].", su numero de telefono es ". 
$row["telefono"]." tiene ". $row["edad"]." años y mide ". $row["altura"];

//---------------------------------------
//Mostrar datos de todas las personas
//---------------------------------------
echo "<br><h1>Datos de todas las personas</h1><br>";
//Obtener fila en concreto
$row = mysqli_data_seek($result,0);

$row = mysqli_fetch_array($result);

while ($row != false) {
    echo $row["nombre"]. $row["apellidos"].", vive en ". $row["direccion"].", su numero de telefono es ". 
    $row["telefono"]." tiene ". $row["edad"]." años y mide ". $row["altura"] . "<br>";
    $row = mysqli_fetch_array($result);
}

echo "<br><h1>Tabla</h1><br>";

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
            for ($x = 0; $x < 4; $x++)
            {echo "<tr>";
            for ($i = 0; $i < 6; $i++)
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