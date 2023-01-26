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
if (!$idConexion) 
{
    die('No se puede conectar' );
}
$seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
if (!$seleccionada) 
{
 die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
}
$result = mysqli_query( $idConexion , "SELECT * FROM ciudades" );
if (!$result) 
{
    die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
}
$row = mysqli_data_seek($result,0);
$row = mysqli_fetch_array($result);
echo "<br><h1>Tabla</h1>";
echo "<form method='POST' action='ciudades.php'> <table border='1px' align='center'>
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
            {
            echo "<tr>";
            for ($i = 0; $i < 6; $i++) // 6 son el número de columnas que hay
            {echo "<td>$row[$i]</td>";}
            echo "<td><input type=\"radio\" name=\"seleccion\" value=" . $row ["id"] . ">
            </td>
            </tr>";
            $row = mysqli_fetch_array($result);
            } 
        echo "    
        </tr>
    </table><br>
    <input type='submit' name='Borrar' value='Borrar'>
    </form>";
mysqli_free_result($result);
if (isset($_POST["Borrar"])) 
{
    $seleccion = $_POST["seleccion"];
    $idConexion = mysqli_connect( "localhost", "root" , "" );
    if (!$idConexion) 
    {
        die('No se puede conectar' );
    }
    $seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
    if (!$seleccionada) 
    {
     die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
    }
    $result = mysqli_query( $idConexion, "DELETE FROM ciudades WHERE '$seleccion' = ID");
    if (!$result) 
    {
        die ("No se puede realizar la consulta ". mysqli_error($idConexion)); 
    }
        mysqli_close($idConexion);
} else 
{
    echo "No se hizo nada";
}
?>
<br><h1>Insertar datos</h1>
<form method='POST' action='ciudades.php'>
    <p>ID:</p>
    <input type='number' name='ID'>
    <p>Ciudad:</p>
    <input type='text' name='Ciudad'>
    <p>Pais:</p>
    <input type='text' name='Pais'>
    <p>Habitantes:</p>
    <input type='number' name='Habitantes'>
    <p>Superficie:</p>
    <input type='number' name='superficie'> <br><br>
    <label for='metro'>¿Tiene metro?</label>
    <select id='Selecionar' name='Selecionar'>
        <option value='1'>Sí</option>
        <option value='0'>No</option>
    </select>  
    <br><br>
    <input type='submit' name='Enviar' value='Agregar registro'>
    </form>
<?php
if (isset($_POST["Enviar"])) 
{
    $ID = $_POST["ID"];
    $Ciudad = $_POST["Ciudad"];
    $Pais = $_POST["Pais"];
    $Habitantes = $_POST["Habitantes"];
    $superficie = $_POST["superficie"];
    $Selecionar = $_POST["Selecionar"];
    $datos = array("ID" => $ID, "Ciudad" => $Ciudad, "Pais" => $Pais,
     "Habitantes" => $Habitantes, "superficie" => $superficie, "Selecionar" => $Selecionar);
    $idConexion = mysqli_connect( "localhost", "root" , "" );
    if (!$idConexion) 
    {
        die('No se puede conectar' );
    }
    $seleccionada = mysqli_select_db($idConexion,"apuntesBD1");
    if (!$seleccionada) 
    {
     die ("No se puede usar la base de datos: ". mysqli_error($idConexion)); 
    }
    $result = mysqli_query($idConexion, "INSERT INTO ciudades VALUES ('$ID', '$Ciudad', '$Pais', '$Habitantes', '$superficie', '$Selecionar');");
    mysqli_close($idConexion);
} else 
{
    echo "No se hizo nada";
}
mysqli_close($idConexion);
?>
</body>
</html>