
<?php
include("conexion.php");

  $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $carrera1 = $_POST['carrera1'];
    $carrera2 = $_POST['carrera2'];
    $carrera3 = $_POST['carrera3'];
    $fecha_registro = $_POST['fecha_registro'];

    $sql = "INSERT INTO registro_estudiantes 
    (nombre, edad, carrera1, carrera2, carrera3, fecha_registro)
    VALUES 
    ('$nombre', '$edad', '$carrera1', '$carrera2', '$carrera3', '$fecha_registro')";

    if($conexion->query($sql) === TRUE){
        echo "<p>Registro guardado correctamente</p>";
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

