<?php
require __DIR__ . '/getdeck.php';
require __DIR__ . '/includes/funciones.inc.php';
    

$baraja = obtenerBaraja();
array_pop($baraja);
array_pop($baraja);
shuffle($baraja);

$manos = [[], [], [], [], [], []];

for ($ronda = 0; $ronda < 2; $ronda++) {
    for ($participante = 0; $participante < 6; $participante++) {
        $manos[$participante][] = array_pop($baraja);
    }
}

for ($participante = 0; $participante < 6; $participante++) {
    while (calcularPuntuacion($manos[$participante]) < 14) {
        $manos[$participante][] = array_pop($baraja);
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
                    <?php if ($puntosBanca > 21) { ?>
                        <span class="se-pasa">se pasa</span>
                    <?php } ?>
                </p>
            </section>

            <div class="asientos">
                <?php for ($jugador = 1; $jugador <= 5; $jugador++) {
                    $puntosJugador = calcularPuntuacion($manos[$jugador]);

                    if ($puntosJugador > 21) {
                        $resultado = 'PIERDE';
                    } elseif ($puntosBanca > 21) {
                        $resultado = 'GANA';
                    } elseif ($puntosJugador > $puntosBanca) {
                        $resultado = 'GANA';
                    } elseif ($puntosJugador < $puntosBanca) {
                        $resultado = 'PIERDE';
                    } else {
                        $resultado = 'EMPATA';
                    }
                ?>
                    <section class="participante">
                        <h3>Jugador <?= $jugador ?></h3>
                        <div class="mano">
                            <?= mostrarMano($manos[$jugador]) ?>
                        </div>
                        <p class="puntos">
                            <?= $puntosJugador ?>
                            <?php if ($puntosJugador > 21) { ?>
                                <span class="se-pasa">se pasa</span>
                            <?php } ?>
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