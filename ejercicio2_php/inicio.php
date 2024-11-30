<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Calculo de Descuento</title>
</head>
<body>

<h1>Calculo de Descuento</h1>

<form action="inicio.php" method="POST">
    <label for="nombre">Nombre del producto:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="categoria">Categoría:</label>
    <input type="text" id="categoria" name="categoria" required>

    <label for="precioUnitario">Precio unitario:</label>
    <input type="number" id="precioUnitario" name="precioUnitario" step="0.01" required>

    <label for="unidades">Unidades:</label>
    <input type="number" id="unidades" name="unidades" required>

    <button type="submit">Calcular Descuento</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $categoria = strtoupper($_POST['categoria']);
    $precioUnitario = (float)$_POST['precioUnitario'];
    $unidades = (int)$_POST['unidades'];

    $precio = $precioUnitario * $unidades;

    $descuento = 0;
    if ($categoria == "A") {
        if ($unidades >= 1 && $unidades <= 10) {
            $descuento = 0.01; 
        } elseif ($unidades >= 11 && $unidades <= 20) {
            $descuento = 0.015;
        } elseif ($unidades > 20) {
            $descuento = 0.02;
        }
    } elseif ($categoria == "B") {
        if ($unidades >= 1 && $unidades <= 10) {
            $descuento = 0.012;
        } elseif ($unidades >= 11 && $unidades <= 20) {
            $descuento = 0.02;
        } elseif ($unidades > 20) {
            $descuento = 0.03;
        }
    } elseif ($categoria == "C") {
        if ($unidades >= 1 && $unidades <= 10) {
            $descuento = 0;
        } elseif ($unidades >= 11 && $unidades <= 20) {
            $descuento = 0.005;
        } elseif ($unidades > 20) {
            $descuento = 0.01;
        }
    }

    $valorDescuento = $precio * $descuento;
    $total = $precio - $valorDescuento;

    if ($categoria == "A") {
        $categoriaMensaje = "<p style='color: black'>$categoria</p>";
    } elseif ($categoria == "B") {
        $categoriaMensaje = "<p style='color: green'>$categoria</p>";
    } elseif ($categoria == "C") {
        $categoriaMensaje = "<p style='color: blue'>$categoria</p>'>";
    }

    echo "
    <div class='result'>
        <p><strong>Nombre del producto:</strong> $nombre</p>
        <p><strong>Categoría:</strong>$categoriaMensaje</p>
        <p><strong>Unidades:</strong> $unidades</p>
        <p><strong>Precio unitario:</strong> $" . number_format($precioUnitario, 2) . "</p>
        <p><strong>Precio (precio unitario x unidades):</strong> $" . number_format($precio, 2) . "</p>
        <p><strong>Descuento (%):</strong> " . ($descuento * 100) . "%</p>
        <p><strong>Valor del descuento:</strong> $" . number_format($valorDescuento, 2) . "</p>
        <p><strong>Total:</strong> $" . number_format($total, 2) . "</p>
    </div>";
}
?>

</body>
</html>