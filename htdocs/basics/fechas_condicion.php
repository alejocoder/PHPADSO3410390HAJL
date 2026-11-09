<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionales</title>
</head>

<body>
    <?php
    $dia = date("d");
    echo "Día: " . $dia;
    $diaLetras = date("D");
    echo "<br>Día en letras: " . $diaLetras; // Concatenación con punto
    $diaSemana = date("N");
    echo "<br>Número Día: $diaSemana"; // Concatenación con comillas
    echo '<br>Número Día: $diaSemana'; // No se concatena la variable 
    // Mostrar Miércoles
    $diasVector = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
    echo "<br><hr>Día semana" . $diasVector[$diaSemana - 1];
    echo "<br>Día semana {$diasVector[$diaSemana - 1]}"; // Interpolación
    /************************************ */
    $mesesVector = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $mesNumero = date("n");
    echo "<br><hr>Mes: {$mesesVector[$mesNumero - 1]}";
    /************************************ */
    // Condicionales en PHP
    if ($diaSemana <= 15 && $mesNumero <= 11) {
        echo "<br><hr>Ahorrando para Black Friday";
    } else {
        echo "<br><hr>Gastandome el dinero en Black Friday";
    }
    /************************************ */
    $numAleatorio = rand(1, 3000);
    echo "<hr>Número aleatorio: $numAleatorio<br>";
    if($numAleatorio < 1000){
        echo "EL número es menor a 1000";
    }elseif($numAleatorio <= 1500){
        echo "El número está entre 1000 y 1500";
    }elseif($numAleatorio <= 2000){
        echo "El número está entre 1501 y 2000";
    }else{
        echo "El número es mayor a 2000";
    }
    ?>
</body>

</html>