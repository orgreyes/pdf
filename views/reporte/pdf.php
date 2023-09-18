<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: #FFFFFF;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #FFFFFF;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #0074D9;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            font-size: 18px;
            margin: 0;
        }

        .copyright {
            text-align: center;
            background-color: #333;
            color: #FFFFFF;
            padding: 10px;
            position: fixed; /* Cambiado a 'fixed' */
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Reporte de Ventas</h1>
    </header>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?= $venta->fecha ?></td>
                    <td><?= $venta->cantidad ?></td>
                    <td><?= $venta->producto ?></td>
                    <td><?= $venta->cliente ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="copyright">
        <p>&copy; <?= date("Y") ?> Comando Informática y Tecnología | Todos los derechos reservados</p>
    </div>
</body>
</html>
