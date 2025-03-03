<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuota #{{ $cuota->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        h1 { text-align: center; margin-bottom: 20px; }
        p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Detalles de la Cuota</h1>

    <p><strong>Cliente:</strong> {{ $cuota->cliente->name }}</p>
    <p><strong>Concepto:</strong> {{ $cuota->concepto }}</p>
    <p><strong>Fecha de Emisión:</strong> {{ $cuota->fecha_emision->format('d/m/Y') }}</p>
    <p><strong>Importe:</strong> {{ number_format($cuota->importe, 2) }} EUR</p>
    <p><strong>Pagada:</strong> {{ $cuota->pagada ? 'Sí' : 'No' }}</p>
    <p><strong>Notas:</strong> {{ $cuota->notas ?? 'Sin notas' }}</p>

</body>
</html>
