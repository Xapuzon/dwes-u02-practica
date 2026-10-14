<?php
function repartir(array &$baraja, int $numeroJugadores, int $cartasPorJugador): array
{
    $manos = array_fill(0, $numeroJugadores, []);

    for ($ronda = 0; $ronda < $cartasPorJugador; $ronda++) {
        for ($jugador = 0; $jugador < $numeroJugadores; $jugador++) {
            $manos[$jugador][] = array_pop($baraja);
        }
    }

    return $manos;
}

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