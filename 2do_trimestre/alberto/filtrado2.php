<form method="POST">
    Nombre<input type="text" name="letra"><br>
    Contraseña<input type="password" name="contrasenia"><br>
    <input type="submit" name="Enviar" value="Enviar">
</form>
<?php
require("funciones2.php");
if (isset($_POST['Enviar'])) {
    

    mysqli_free_result($resultado);
    mysqli_close($idConexion);
}
?>