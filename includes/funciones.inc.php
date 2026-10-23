<?php
function mostrarCarta(array $carta): string
{
    return '<img class="carta" src="img/' . $carta['imagen'] . '" alt="' . $carta['palo'] . ' ' . $carta['valor'] . '">';
}

function mostrarMano(array $mano): string
{
    $html = '';

    foreach ($mano as $carta) {
        $html .= mostrarCarta($carta);
    }

    return $html;
}

function calcularPuntuacion(array $mano): int
{
    $puntos = 0;
    $ases = 0;

    foreach ($mano as $carta) {
        if ($carta['valor'] === 1) {
            $ases++;
            $puntos += 1;
        } elseif ($carta['valor'] > 10) {
            $puntos += 10;
        } else {
            $puntos += $carta['valor'];
        }
    }

    if ($ases > 0 && $puntos + 10 <= 21) {
        $puntos += 10;
    }

    return $puntos;
}