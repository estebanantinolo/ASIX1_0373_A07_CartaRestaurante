<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Esteban Restaurant</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>

<!-- Importación del XML -->
<?php
if (file_exists('./XML/carta.xml')){
        $menu = simplexml_load_file('./XML/carta.xml');
} else {
    exit('Error abriendo el archivo de datos');
}

?>

<header class="banner" id="inicio_boton">
    <h1>Restaurante de Esteban</h1>
</header>

<div class="carta">

<?php
$tipos = [];

foreach($menu->plato as $plato){
    $tipo = (string)$plato['tipo'];

    if(!in_array($tipo, $tipos)){
        if(!empty($tipos)){
            echo '</div></div>'; 
        }

        echo '<div class="seccion">';
        echo '<h2>'.strtoupper($tipo).'</h2>';
        echo '<div class="elementos">';

        array_push($tipos, $tipo);
    }

    echo '<div class="item">';
    
    // Nombre y precio
    echo '<div class="fila">';
    echo '<span class="nombre">'.$plato->nombre.'</span>';
    echo '<span class="precio">'.$plato->precio.'€</span>';
    echo '</div>';

    // Descripción
    echo '<div class="descripcion">'.$plato->descripcion.'</div>';

    // Calorías
    echo '<div class="calorias">Calorías: '.$plato->calorias.' kcal</div>';

    // Iconos
    echo '<div class="iconos">';
    foreach($plato->ingredientes->categoria as $cat){
        echo '<img src="'.$cat['icono'].'" alt="'.$cat.'" class="icono">';
    }
    echo '</div>';

    echo '</div>';
}

echo '</div></div>'; // cerrar 
?>

</div>

<a href="#inicio_boton" class="boton">Volver al inicio</a>

<footer class="footer">
  <p>Restaurante de Esteban</p>
  <p>Dirección: Calle Barcelona 123, Sant Vicenç</p>
  <p>Reservas: 600 123 456</p>
</footer>

</body>
</html>