
<?php
include("conexion.php");

if(isset($_GET['buscar'])){

    $buscar = $_GET['buscar'];

    $sql = "SELECT * FROM programas 
            WHERE programa_academico LIKE '%$buscar%'";

    $resultado = $conexion->query($sql);

    if($resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            echo "<div class='card'>";
            echo "<h3>".$fila['programa_academico']."</h3>";
            echo "<p><strong>Costos:</strong> ".$fila['costos']."</p>";
            echo "<p><strong>Requisitos:</strong> ".$fila['requisitos']."</p>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}
?>
