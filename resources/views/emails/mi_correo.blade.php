<!DOCTYPE html>
<html>
<head>
    <title>Notificación de Nueva Cuota</title>
</head>
<body>
    <h2>Hola, {{ $data['nombre'] }}</h2>
    <p>Se ha generado una nueva cuota en tu cuenta con el siguiente detalle:</p>

    <ul>
        <li><strong>Concepto:</strong> {{ $data['concepto'] }}</li>
        <li><strong>Importe:</strong> {{ $data['importe'] }}</li>
        <li><strong>Fecha de Emisión:</strong> {{ $data['fecha_emision'] }}</li>
    </ul>

    <p>Por favor, revisa tu cuenta para más detalles.</p>
    <p>Gracias por confiar en nosotros.</p>

    <p>Atentamente,<br>Tu empresa</p>
</body>
</html>
