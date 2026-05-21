<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Consulta - Restaurante</title>
    <style>     
        body{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        } 
        .contenedor{
            width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0px 10px rgba(0,0,0,0.2);
        }
        h2{
            text-align: center;
        }
        label{
            fonts-weight: bold;
        }
        input, select{
            width: 100%;
            padding: 8px;
            margin: 8px 0 15px 0; 
            border-radius: 5px;
            border: 1px solid #ccc;
        }
            input[type="submit"]{
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #218838;
        }
.logo-principal {
    position: fixed; 
    top: 20px;
    right: 30px;
    width: 100px;
    z-index: 1000;
}
    </style>
</head>
<body>

<img src="img/logo2.png" class="logo-principal">

<div class="contenedor">

<div class="contenedor">
    <h2>Busqueda de Universidad</h2>
      
    <form action="" method="POST">
   
       <label for="Cupo">Nombre del reservante del cupo:</label>
       <input type="text" name="cupo" id="cupo" required>
        
       <label for="horario">Horario:</label>
       <input type="time" name="horario" id="horario" required>
        
       <label for="ubicación">Tipo de Universidad:</label>
       <select name="universidad" id="universidad" required>
           <option value"">Seleccione una opción</option>
           <option value"Pública">Pública</option>
           <option value"Privada">Privada</option>
       </select>

       <input type="submit" value="Enviar Cupo">

   </form>

   <?php
   if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cupo = $_POST["cupo"];
        $horario = $_POST["horario"];
        $universidad = $_POST["universidad"];

        echo "<h3>Datos recibidos:</h3>";
        echo "Cupo a nombre de: <b>$cupo</b><br>";
        echo "Horario seleccionado: <b>$horario</b><br>";
        echo "Tipo de universidad: <b>$universidad</b><br>";

    }
    ?>
</div>
<br>
<br>
</body>
</html>
<button><a href="./inicio.php"> INICIO DE BUSQUEDA</a></button>
</body>
</html>