<?php
$conexion = new mysqli("localhost", "root", "", "universidades");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensaje = "";

if(isset($_POST['guardar'])){

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $carrera1 = $_POST['carrera1'];
    $carrera2 = $_POST['carrera2'];
    $carrera3 = $_POST['carrera3'];
    $fecha = isset($_POST["fecha_registro"]) ? $_POST["fecha_registro"] : "";

    $sql = "INSERT INTO registro_estudiantes 
    (nombre, edad, carrera1, carrera2, carrera3, Fecha_registro)
    VALUES ('$nombre','$edad','$carrera1','$carrera2','$carrera3','$fecha')";

    if($conexion->query($sql)){
        $mensaje = "Registro guardado correctamente";
    } else{
        $mensaje = "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Explorador de Universidades en Línea</title>
<link rel="stylesheet" href="css/estilos.css">

<link rel="stylesheet" href="css/estilos.css">

<style>
header {
    position: relative;
}

.logo-principal {
    position: absolute;
    top: 20px;
    right: 30px;
    width: 120px;
    z-index: 1000;
    filter: drop-shadow(0 0 5px rgba(0,0,0,0.5));
}
</style>

</head>

<body>

<header>

<img src="img/UniField.png" class="logo-principal">

<section class="portada">
<div class="overlay">


<h1>Explorador de Universidades en Línea</h1>
<p>Consulta programas, requisitos y ubicación de las mejores universidades.</p>

<div class="buscador">

<input type="text" id="buscarInput" placeholder="Buscar universidad...">

<div class="filtros">
<button class="btn-filtro activo" data-filtro="todas">Todas</button>
<button class="btn-filtro" data-filtro="publica">Públicas</button>
<button class="btn-filtro" data-filtro="privada">Privadas</button>
</div>

</div>

</div>
</section>
</header>


<!-- FORMULARIOS -->
<div class="formularios-container">


<!-- FORMULARIO REGISTRO -->
<div class="form-card">

<h2>Registro de Estudiante</h2>

<form method="POST">

<input type="text" name="nombre" placeholder="Nombre" required>

<input type="number" name="edad" placeholder="Edad" required>

<input type="text" name="carrera1" placeholder="Carrera de interés 1" required>

<input type="text" name="carrera2" placeholder="Carrera de interés 2" required>

<input type="text" name="carrera3" placeholder="Carrera de interés 3" required>

<input type="date" name="fecha_registro">

<button type="submit" name="guardar">Enviar</button>

</form>

<?php if($mensaje != ""){ ?>
<p class="mensaje"><?php echo $mensaje; ?></p>
<?php } ?>

<br>

<button>
<a href="./formulario.php">Universidad</a>
</button>

</div>


<!-- FORMULARIO CONSULTA -->
<div class="form-card">

<h2>Consulta de Programas</h2>

<form method="GET">

<input type="text" name="buscar" placeholder="Buscar programa académico">

<button type="submit">Buscar</button>

</form>

<div class="resultados">

<?php
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

<?php
if(isset($_POST['consultar_uni'])){

$nombre_usuario = $_POST['nombre_usuario'];
$universidad_id = $_POST['universidad_id'];

$sql = "INSERT INTO usuarios (nombre, universidad_id)
VALUES ('$nombre_usuario','$universidad_id')";

$sql2 = "SELECT * FROM universidades WHERE id = '$universidad_id'";
$resultado = $conexion->query($sql2);

if($resultado->num_rows > 0){

$fila = $resultado->fetch_assoc();

echo "<div class='tarjeta'>";
echo "<h2>".$fila['nombre']."</h2>";
echo "<img class='campus' src='".$fila['imagen']."'>";

echo "<p><strong>Categoría:</strong> ".$fila['categoria']."</p>";
echo "<p><strong>Carreras:</strong> ".$fila['carreras']."</p>";
echo "<p><strong>Costos:</strong> ".$fila['costos']."</p>";
echo "<p><strong>Requisitos:</strong> ".$fila['requisitos']."</p>";

echo "</div>";

}

}
?>

<div class="form-card">
<h2>Registro y Consulta de Universidad</h2>

<form method="POST">

<input type="text" name="nombre_usuario" placeholder="Tu nombre" required>

<select name="universidad_id" required>
<option value="">Selecciona una universidad</option>

<?php
$sql_uni = "SELECT id, nombre FROM universidades";
$res_uni = $conexion->query($sql_uni);

while($uni = $res_uni->fetch_assoc()){
echo "<option value='".$uni['id']."'>".$uni['nombre']."</option>";
}
?>

</select>

<button type="submit" name="consultar_uni">Consultar Universidad</button>

</form>
</div>
</div>

</div>

</div>

<!-- UNIVERSIDADES -->

<div class="tarjetas-container">

<!-- TARJETA 1 -->
<div class="tarjeta publica-card aparecer">
<h2>Universidad Nacional Autónoma de México (UNAM)</h2>
<img class="logo" src="https://images.seeklogo.com/logo-png/38/1/universidad-nacional-autonoma-de-mexico-unam-logo-png_seeklogo-387361.png">
<div class="img-wrapper">
    <img class="campus" src="https://media.gettyimages.com/id/536042874/es/foto/mural-in-mexico.jpg?s=612x612&w=0&k=20&c=0OZyD8hIvJ15oCV34ISzshkBXUS5ycZyZ1NolCdBZtU=">
</div>
<p class="categoria publica">Categoría: Pública</p>
<p><strong>Programas:</strong> Medicina, Derecho, Ingeniería, Arquitectura, Psicología.</p>
<iframe src="https://maps.google.com/maps?q=UNAM&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<!-- TARJETA 2 -->
<div class="tarjeta publica-card aparecer">
<h2>Instituto Politécnico Nacional (IPN)</h2>
<img class="logo" src="https://universidadesdemexico.mx/logos/original/logo-instituto-politecnico-nacional.webp">
<div class="img-wrapper">
    <img class="campus" src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Biblioteca_Nacional_de_Ciencia_y_Tecnolog%C3%ADa.jpg">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Ingeniería, Ciencias Biológicas, Administración, Computación.</p>
<iframe src="https://maps.google.com/maps?q=IPN%20Zacatenco&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<!-- TARJETA 3 -->
<div class="tarjeta privada-card aparecer">
<h2>Tecnológico de Monterrey</h2>
<img class="logo" src="https://www.freelogovectors.net/wp-content/uploads/2020/01/tecnologico-de-monterrey-logo.png">
<div class="img-wrapper">
    <img class="campus" src="https://tec.mx/sites/default/files/styles/16_9_campus/public/repositorio/Campus/Ciudad%20de%20Mexico/JA/edificio-campus-ciudad-mexico-tec-monterrey.jpg.webp?itok=Qp4WY4OO">
</div>
<p class="categoria privada">Categoría: Privada</p>
<p><strong>Programas:</strong> Ingeniería, Negocios, Diseño, Medicina.</p>
<iframe src="https://maps.google.com/maps?q=Tecnologico%20de%20Monterrey&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<!-- TARJETAS 4 - 12 (Estructura repetida con diferentes universidades) -->

<div class="tarjeta publica-card aparecer">
<h2>Universidad de Guadalajara (UDG)</h2>
<img class="logo" src="https://yachay.digital/wp-content/uploads/2021/03/UDG.png">
<div class="img-wrapper">
    <img class="campus" src="https://web.gcompostela.org/wp-content/uploads/2019/05/University-of-Guadalajara-provisional.jpg">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Derecho, Medicina, Artes, Ingeniería.</p>
<iframe src="https://maps.google.com/maps?q=Universidad%20de%20Guadalajara&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta publica-card aparecer">
<h2>Universidad Autónoma de Nuevo León (UANL)</h2>
<img class="logo" src="https://www.grupolarabida.org/wp-content/uploads/2020/10/Mexico_UniversidadAutonomadeNuevoLeon_UANL_83_.jpg">
<div class="img-wrapper">
    <img class="campus" src="https://www.uanl.mx/wp-content/uploads/2019/03/unidad-academica-linares-uanl.jpg">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Medicina, Ingeniería, Administración.</p>
<iframe src="https://maps.google.com/maps?q=UANL&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta privada-card aparecer">
<h2>Universidad Anáhuac</h2>
<img class="logo" src="https://images.seeklogo.com/logo-png/14/2/universidad-anahuac-logo-png_seeklogo-145637.png">
<div class="img-wrapper">
    <img class="campus" src="https://puebla.anahuac.mx/hs-fs/hubfs/Instalaciones-23-redes-005_11zon.webp?width=1940&height=1800&name=Instalaciones-23-redes-005_11zon.webp">
</div>
<p class="categoria">Categoría: Privada</p>
<p><strong>Programas:</strong> Negocios, Derecho, Psicología, Arquitectura.</p>
<iframe src="https://maps.google.com/maps?q=Universidad%20Anahuac&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta privada-card aparecer">
<h2>Universidad Iberoamericana</h2>
<img class="logo" src="https://www.iberoleon.mx/ibero-system/assets/logos/ibero-main.svg">
<div class="img-wrapper">
    <img class="campus" src="https://euniversidadesprivadas.com/wp-content/uploads/2021/01/Universidad-Iberoamerciana-de-Mexico-Universidades-Privadas-de-Mexico-2.jpg">
</div>
<p class="categoria">Categoría: Privada</p>
<p><strong>Programas:</strong> Comunicación, Ingeniería, Derecho.</p>
<iframe src="https://maps.google.com/maps?q=Universidad%20Iberoamericana&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta publica-card aparecer">
<h2>Benemérita Universidad Autónoma de Puebla (BUAP)</h2>
<img class="logo" src="https://universidadesdemexico.mx/logos/original/logo-benemerita-universidad-autonoma-de-puebla.webp">
<div class="img-wrapper">
    <img class="campus" src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2024/02/buap-as-900x600.jpg">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Medicina, Ingeniería, Derecho.</p>
<iframe src="https://maps.google.com/maps?q=BUAP&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta publica-card aparecer">
<h2>Universidad Autónoma Metropolitana (UAM)</h2>
<img class="logo" src="https://www.pngkey.com/png/full/898-8981951_logo-uam-universidad-autnoma-metropolitana.png">
<div class="img-wrapper">
    <img class="campus" src="https://www.mexicoescultura.com/galerias/espacios/principal/universidad_autonoma_metropolitana_-uam-xochimilco_2.png">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Ingeniería, Diseño, Ciencias Sociales.</p>
<iframe src="https://maps.google.com/maps?q=UAM&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta privada-card aparecer">
<h2>Universidad Panamericana</h2>
<img class="logo" src="https://images.seeklogo.com/logo-png/14/1/universidad-panamericana-logo-png_seeklogo-145772.png">
<div class="img-wrapper">
    <img class="campus" src="https://www.estudiamas.com.mx/wp-content/uploads/2023/03/CampusPanamericana.png">
</div>
<p class="categoria">Categoría: Privada</p>
<p><strong>Programas:</strong> Derecho, Administración, Ingeniería.</p>
<iframe src="https://maps.google.com/maps?q=Universidad%20Panamericana&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta publica-card aparecer">
<h2>Universidad Autónoma de Yucatán (UADY)</h2>
<img class="logo" src="https://universidadesdemexico.mx/logos/original/logo-universidad-autonoma-de-yucatan.webp">
<div class="img-wrapper">
    <img class="campus" src="https://static.wixstatic.com/media/a6900c_70ae1ee42dc147fe8519630c51272e0b~mv2.jpg/v1/fit/w_980,h_653,q_80,enc_avif,quality_auto/a6900c_70ae1ee42dc147fe8519630c51272e0b~mv2.jpg">
</div>
<p class="categoria">Categoría: Pública</p>
<p><strong>Programas:</strong> Medicina, Veterinaria, Ingeniería.</p>
<iframe src="https://maps.google.com/maps?q=UADY&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjeta privada-card aparecer">
<h2>Universidad del Valle de México (UVM)</h2>
<img class="logo" src="https://www.emagister.com.mx/assets/mx/logos/centro/id/53578/size/l.jpg">
<div class="img-wrapper">
    <img class="campus" src="https://uvm.mx/storage/app/uploads/public/5ed/3fb/a76/5ed3fba7628f0313965105.jpg">
</div>
<p class="categoria">Categoría: Privada</p>
<p><strong>Programas:</strong> Medicina, Negocios, Ingeniería.</p>
<iframe src="https://maps.google.com/maps?q=UVM&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
</div>

<div class="tarjetas-container">

</div>


<footer>
© 2026 Explorador de Universidades en Línea
</footer>

<script src="script.js"></script>
<script src="java/app.js"></script>

</body>
</html>
