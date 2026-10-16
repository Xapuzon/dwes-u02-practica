<?php
function obtenerBaraja(): array
{
    $palos = [
        'corazones' => 'cor',
        'treboles' => 'tre',
        'picas' => 'pic',
        'rombos' => 'rom',
    ];

    $nombresFiguras = [
        11 => 'j',
        12 => 'q',
        13 => 'k',
    ];

    $baraja = [];

    foreach ($palos as $palo => $prefijo) {
        for ($valor = 1; $valor <= 13; $valor++) {
            $nombre = $nombresFiguras[$valor] ?? $valor;

            $baraja[] = [
                'palo' => $palo,
                'valor' => $valor,
                'imagen' => $prefijo . '_' . $nombre . '.png',
            ];
        }
    }

    for ($numero = 1; $numero <= 2; $numero++) {
        $baraja[] = [
            'palo' => 'comodin',
            'valor' => 0,
            'imagen' => 'comodin_' . $numero . '.png',
        ];
    }

    return $baraja;
}