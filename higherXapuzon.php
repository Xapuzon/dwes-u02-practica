<?php
require __DIR__ . '/getdeck.php';
require __DIR__ . '/includes/funciones.inc.php';

$baraja = obtenerBaraja();
shuffle($baraja);

$manos = [[], []];

for ($ronda = 0; $ronda < 10; $ronda++) {
    $manos[0][] = array_pop($baraja);
    $manos[1][] = array_pop($baraja);
}

$puntosJugador1 = 0;
$puntosJugador2 = 0;

$tituloPagina = 'Higher';

require __DIR__ . '/includes/header.inc.php';
require __DIR__ . '/includes/menu.inc.php';
?>
    <main class="contenedor">
        <h2 class="titulo-mesa">Higher</h2>

        <table border="1">
            <tr>
                <th>Ronda</th>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
                <th>Resultado</th>
            </tr>
            <?php for ($ronda = 0; $ronda < 10; $ronda++) {
                $carta1 = $manos[0][$ronda];
                $carta2 = $manos[1][$ronda];

                if ($carta1['palo'] === 'comodin' && $carta2['palo'] === 'comodin') {
                    $puntosJugador1 -= 2;
                    $puntosJugador2 -= 2;
                    $resultado = 'Los dos tienen comodín';
                } elseif ($carta1['palo'] === 'comodin') {
                    $puntosJugador1 += 2;
                    $puntosJugador2 -= 1;
                    $resultado = 'Comodín del jugador 1';
                } elseif ($carta2['palo'] === 'comodin') {
                    $puntosJugador1 -= 1;
                    $puntosJugador2 += 2;
                    $resultado = 'Comodín del jugador 2';
                } elseif ($carta1['valor'] === $carta2['valor']) {
                    $puntosJugador1 += 1;
                    $puntosJugador2 += 1;
                    $resultado = 'Empate';
                } elseif ($carta1['valor'] > $carta2['valor']) {
                    $puntosJugador1 += 2;
                    $resultado = 'Gana el jugador 1';
                } else {
                    $puntosJugador2 += 2;
                    $resultado = 'Gana el jugador 2';
                }
            ?>
                <tr>
                    <td><?= $ronda + 1 ?></td>
                    <td><?= mostrarCarta($carta1) ?></td>
                    <td><?= mostrarCarta($carta2) ?></td>
                    <td><?= $resultado ?></td>
                </tr>
            <?php } ?>
        </table>

        <h3>Puntuación total</h3>
        <p>Jugador 1: <?= $puntosJugador1 ?></p>
        <p>Jugador 2: <?= $puntosJugador2 ?></p>

        <?php
        if ($puntosJugador1 > $puntosJugador2) {
            echo '<h3>Gana el jugador 1</h3>';
        } elseif ($puntosJugador2 > $puntosJugador1) {
            echo '<h3>Gana el jugador 2</h3>';
        } else {
            echo '<h3>Empate</h3>';
        }
        ?>
    </main>

<?php
require __DIR__ . '/includes/footer.inc.php';