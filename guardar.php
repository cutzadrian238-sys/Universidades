<?php
//Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "universidades";

//Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);


//Verificar conexión 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 

//Obtener datos del formulario
$nombre = $_POST['nombre'];
$universidad = $_POST['universidad'];
$edad = $_POST['edad'];

//Insertar datos
$sql = "INSERT INTO universidad_1 (nombre, universidad, edad) VALUES ('$nombre', '$universidad', '$edad')";
if ($conn->query($sql) === TRUE) {
    echo "Datos guardados correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
<br>
<br>
<br>
<button><a href="./index.php">UNIVERSIDAD</a></button>