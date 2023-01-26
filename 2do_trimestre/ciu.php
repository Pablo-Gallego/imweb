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
    $ID = $_POST["ID"];
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
echo "<form method='POST' action cui.php> <table border='1px' align='center'>
        <tr>
        <th>ID</th>
        <th>Ciudad</th>
        <th>País</th>
        <th>Habitantes</th>
        <th>superficie</th>
        <th>Metro</th>
        <th>Selecionar</th>
        </tr>
        <tr>"; 
            for ($x = 0; $x < mysqli_num_rows($result); $x++)
            {echo "<tr>";
            for ($i = 0; $i < 6; $i++) // 6 son el número de columnas que hay
            {echo "<td>$row[$i]</td>";}
            echo "<td><input type='radio' name='borrar' value='$ID'
            </td>
            </tr>";
            $row = mysqli_fetch_array($result);
            } 
        echo "    
        </tr>
    </table>
    <input type='submit' name='Borrar' value='Borrar'>
    </form>";
mysqli_free_result($result);
?>

<?php
if (isset($_POST["Borrar"])) 
{
    $ID = $_POST["ID"];
    $Ciudad = $_POST["Ciudad"];
    $altura = $_POST["altura"];
    $Habitantes = $_POST["Habitantes"];
    $superficie = $_POST["superficie"];
    $Selecionar = $_POST["Selecionar"];
    $j = $_POST["ID"];

    $idConexion = mysqli_connect( "localhost", "root" , "" );
    if (!$idConexion) {
        die('No se puede conectar' );
    }
    
    $seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
    if (!$seleccionada) {
     die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
    }
    
    $result = mysqli_query( $idConexion, "DELETE FROM ciudades WHERE '$j' = '$ID'");
    if (!$result) {
        die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
    }
    
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
<!-- Por si peta 
INSERT INTO `ciudades` 
(`id`, `ciudad`, `pais`, `habitantes`, `superficie`, `tieneMetro`) VALUES (1, 'México D.F.', 'México', 555666, 23434.34, 1), 
(2, 'Barcelona', 'España', 444333, 1111.11, 0), (3, 'Buenos Aires', 'Argentina', 888111, 333.33, 1), 
(4, 'Medellín', 'Colombia', 999222, 888.88, 0), (5, 'Lima', 'Perú', 999111, 222.22, 0), 
(6, 'Caracas', 'Venezuela', 111222, 111.11, 1), (7, 'Santiago', 'Chile', 777666, 222.22, 1), 
(8, 'Antigua', 'Guatemala', 444222, 877.33, 0), (9, 'Quito', 'Ecuador', 333111, 999.11, 1), 
(10, 'La Habana', 'Cuba', 11122, 333.11, 0); -->
</body>
</html>