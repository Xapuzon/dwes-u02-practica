<?php
require __DIR__ . '/getdeck.php';
require __DIR__ . '/includes/funciones.inc.php';

function calcularPuntuacion(array $mano): int
{
    $puntos = 0;
    $ases = 0;

    foreach ($mano as $carta) {
        if ($carta['valor'] === 1) {
            $ases++;
            $puntos += 1;
        } else {
            $puntos += $carta['valor'] > 10 ? 10 : $carta['valor'];
        }
    }

    for ($indice = 0; $indice < $ases; $indice++) {
        if ($puntos + 10 <= 21) {
            $puntos += 10;
        }
    }

    return $puntos;
}

function resultadoContraBanca(int $puntosJugador, int $puntosBanca): string
{
    if ($puntosJugador > 21) {
        return 'PIERDE';
    }

    if ($puntosBanca > 21) {
        return 'GANA';
    }

    if ($puntosJugador > $puntosBanca) {
        return 'GANA';
    }

    if ($puntosJugador < $puntosBanca) {
        return 'PIERDE';
    }

    return 'EMPATA';
}

$baraja = obtenerBaraja();
array_pop($baraja);
array_pop($baraja);
shuffle($baraja);

$manos = repartir($baraja, 6, 2);

foreach ($manos as $indice => $mano) {
    while (calcularPuntuacion($manos[$indice]) < 14) {
        $manos[$indice][] = array_pop($baraja);
    }
}

$puntosBanca = calcularPuntuacion($manos[0]);

$tituloPagina = 'Blackjack';

require __DIR__ . '/includes/header.inc.php';
require __DIR__ . '/includes/menu.inc.php';
?>
    <main>
        <h2>Blackjack</h2>

        <section class="participante">
            <h3>Banca</h3>
            <?= mostrarMano($manos[0]) ?>
            <p>Puntuación: <?= $puntosBanca ?></p>
        </section>

        <?php for ($jugador = 1; $jugador <= 5; $jugador++) { ?>
            <?php $puntosJugador = calcularPuntuacion($manos[$jugador]); ?>
            <section class="participante">
                <h3>Jugador <?= $jugador ?></h3>
                <?= mostrarMano($manos[$jugador]) ?>
                <p>Puntuación: <?= $puntosJugador ?></p>
                <p><strong><?= resultadoContraBanca($puntosJugador, $puntosBanca) ?></strong></p>
            </section>
        <?php } ?>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';