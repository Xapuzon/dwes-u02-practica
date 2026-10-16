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
    <main class="contenedor">
        <h2 class="titulo-mesa">Mesa de Blackjack</h2>

        <div class="mesa">
            <section class="banca">
                <h3>Banca</h3>
                <div class="mano">
                    <?= mostrarMano($manos[0]) ?>
                </div>
                <p class="puntos">
                    <?= $puntosBanca ?>
                    <?= $puntosBanca > 21 ? '<span class="se-pasa">se pasa</span>' : '' ?>
                </p>
            </section>

            <div class="asientos">
                <?php for ($jugador = 1; $jugador <= 5; $jugador++) { ?>
                    <?php
                    $puntosJugador = calcularPuntuacion($manos[$jugador]);
                    $resultado = resultadoContraBanca($puntosJugador, $puntosBanca);
                    ?>
                    <section class="participante">
                        <h3>Jugador <?= $jugador ?></h3>
                        <div class="mano">
                            <?= mostrarMano($manos[$jugador]) ?>
                        </div>
                        <p class="puntos">
                            <?= $puntosJugador ?>
                            <?= $puntosJugador > 21 ? '<span class="se-pasa">se pasa</span>' : '' ?>
                        </p>
                        <p class="resultado <?= strtolower($resultado) ?>"><?= $resultado ?></p>
                    </section>
                <?php } ?>
            </div>
        </div>

        <p class="accion">
            <a class="boton" href="blackjackXapuzon.php">Repartir de nuevo</a>
        </p>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';