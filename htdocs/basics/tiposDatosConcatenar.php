<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // TIPOS DE VARIABLES
    // En PHP no es necesario declarar el tipo de Datos
    $dia = 4; // Tipo INT
    $salario = 2000000.50; // Tipo DOUBLE
    $nombre = "Ana"; // Tipo STRING
    $estado = true; // Tipo BOOLEAN

    // Impresión de Vbles
    echo "<br>Vble tipo entero: $dia";
    echo "<br>Vble tipo double: ".$salario;
    echo "<br>Vble tipo string: ".$nombre;
    echo "<br>Vble tipo boolean: ".$estado;
    echo "<hr>";

    echo "{$nombre} gana \$$salario"; // Interpolación y escape de caracteres
    echo "<br>";
    $texto = sprintf("Hoy es %d",$dia);
    echo $texto;
    $peras = 3;
    $manzanas = 5;
    $mangos = 4;
    $precioFrutas = 25500.30;
    
    // Uso de sprintf
    $texto = sprintf("Soy %s y tengo %d peras, %d manzanas y %d mangos y costaron $%.2f", $nombre, $peras, $manzanas, $mangos, $precioFrutas);
    echo "<br>".$texto;

    // Uso de Heredoc
    echo "<hr>";
    $titulo = "Programa de Formación";
    $texto = "Análisis y Desarrollo de Software";
    $html = <<<HTML
        <div class="card">
            <h2>$titulo</h2>
            <p>$texto</p>
        </div>
    HTML;
    echo $html;
    ?>
</body>

</html>