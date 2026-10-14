<?php
function obtenerBaraja(): array
{
    $palos = [
        'corazones' => 'cor',
        'treboles' => 'tre',
        'picas' => 'pic',
        'rombos' => 'rom',
    ];

    $baraja = [];

    foreach ($palos as $palo => $prefijo) {
        for ($valor = 1; $valor <= 13; $valor++) {
            $baraja[] = [
                'palo' => $palo,
                'valor' => $valor,
                'imagen' => $prefijo . '_' . $valor . '.png',
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